<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\RoomType;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Discount;
use App\Models\Payment;
use App\Models\Voucher;
use DateTime;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Stripe;


// use Stripe\Stripe;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        return view('booking.index', ['data' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::all();
        return view('booking.create', ['data' => $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'customer_id' => 'required',
            'room_id' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'total_adults' => 'required',
            'roomprice' => 'required',
        ]);


        if ($request->ref == 'front') {
            $sessionData = [
                'customer_id' => $request->customer_id,
                'room_id' => $request->room_id,
                'checkin_date' => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'total_adults' => $request->total_adults,
                'total_children' => $request->total_children,
                'roomprice' => $request->roomprice,
                'ref' => $request->ref
            ];

            //   ///check if he has more than 3 point 



            //     ///check if the admin can have discount
                $checkdate=Discount::whereBetween('discount_date',[$request->checkin_date,$request->checkout_date])->get();

               foreach($checkdate as $date)
               if($checkdate){
                    $newPrice=$request->roomprice-$date->amount; 
                } else{
                $newPrice=$request->roomprice;
                } 
                ///view message for 
                 $data=Voucher::where('values',$request->input('voucher'))->get();
                 $point=Payment::where('customer_id',Auth::user()->id)->count();
                 foreach($data as $item)

                 if($data)
                  {
                    $newPrice=$request->roomprice-$item->discount;
                  }
                   elseif($data &&  $checkdate){

                    $newPrice=$request->roomprice-$item->discount-$date->amount; 

                   } 
                   elseif($data && $point>=3){

                    $newPrice=$request->roomprice-$item->discount-10; 
                   }
                   if($point>=3)
                   {
                     $newPrice=$request->roomprice-10; 
                   } 
                  if( $checkdate && $point>=3){

                    $newPrice=$request->roomprice-$date->amount-10; 

                   } 
                  else
                  {
                    $newPrice=$request->roomprice;
                  }

            //AI implementation
            $dateHasDiscount = Discount::whereBetween('discount_date', [$request->checkin_date, $request->checkout_date])->get();
            if ($dateHasDiscount != null) {
                $datediscount = 1;
            } else {
                $datediscount = 0;
            }
            $hasVoucher = Voucher::where('values', $request->input('voucher'))->get();
            if ($hasVoucher != null) {
                $voucherFound = 1;
            } else {
                $voucherFound = 0;
            }
            $sumOfPayments = Payment::where('customer_id', Auth::user()->id)->sum('roomprice');
            $currentMonth = Carbon::now('m');
            //dd($currentMonth);
            if (($currentMonth=="01") || ($currentMonth=="02") || ($currentMonth=="03")) {
                $season = 0;
            } elseif (($currentMonth=="04") || ($currentMonth=="05") || ($currentMonth=="06")) {
                $season = 0.66;
            } elseif (($currentMonth=="07") || ($currentMonth=="08") || ($currentMonth=="09")) {
                $season = 1;
            } else {
                $season = 0.33;
            }

            $userPayments = Payment::where('customer_id', Auth::user()->id)->get();
            $numOfDaysStayed = 0;
            if ($userPayments != null) {
                foreach ($userPayments as $userpayment) {
                    $checkInDate = $userpayment->checkin_date;
                    $checkOutDate = $userpayment->checkout_date;
                    $startCheckIn = new DateTime($checkInDate);
                    $endCheckout = new DateTime($checkOutDate);
                    $interval = $startCheckIn->diff($endCheckout);
                    $numOfDaysStayed += $interval->format('%a');
                }
            } else {
                $numOfDaysStayed = 0;
            }
            $wPayment = -0.0787;
            $wSeason = 0.0152;
            $wNumOfDays = -0.0578;
            $wDate = 0.0528;
            $wVoucher = 0.0302;
            $bias = 0.5049;

            $ANN = ($datediscount * $wDate) + ($wPayment * $sumOfPayments) + ($wSeason * $season) +
                ($wVoucher * $voucherFound) + ($wNumOfDays * $numOfDaysStayed) + $bias;
        
            $activationFunc = (1 / (1 + exp(-1*$ANN)));
            
            if (($activationFunc >= 0) && ($activationFunc <= 0.33)) {
                $discountApply = 10;
            } elseif (($activationFunc > 0.33) && ($activationFunc < 0.66)) {
                $discountApply = 15;
            } elseif (($activationFunc > 0.66) && ($activationFunc < 1)) {
                $discountApply = 20;
            } else {
                $discountApply = 0;
            }
           // dd($discountApply);



            $room = Room::where('id', $request->room_id)->first();
            $roomType = RoomType::where('id', $room->room_type_id)->first();
            $roomstypes = $room->title . '-' . $roomType->title;

            $startCheckIn = new DateTime($request->checkin_date);
            $endCheckout = new DateTime($request->checkout_date);
            $interval = $startCheckIn->diff($endCheckout);
            $days = $interval->format('%a');
            $amount = ($request->roomprice * $days);
            ///  $amount_discount = (($request->roomprice*$request->total_adults)*$request->discount)/100; 
            //$discount = $newPrice;

            $disocuntprice = (($amount) - (($amount * $discountApply) / 100));

            session($sessionData);
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $session = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'inr',
                            'product_data' => [
                                'name' => $roomstypes,
                                'description' => 'Before discount :' .$amount ,
                            ],
                            'unit_amount' => $disocuntprice * 100,
                        ],
                        'quantity' => 1,

                    ]
                ],
                'mode' => 'payment',
                'success_url' => 'http://127.0.0.1:8000/booking/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'http://127.0.0.1:8000/laravel-apps/hotelManage/booking/fail',
            ]);
            $payment = new Payment();
            $payment->customer_id = $request->customer_id;
            $payment->room_id = $request->room_id;
            $payment->checkin_date = $request->checkin_date;
            $payment->checkout_date = $request->checkout_date;
            $payment->total_adults = $request->total_adults;
            $payment->roomprice = $disocuntprice;
            $payment->save();

            ///update the room 
            Room::where('id', $request->input('room_id'))->update(array('available' => 'false'));

            return redirect($session->url);
        } else {
            $data = new Booking;
            $data->customer_id = $request->customer_id;
            $data->room_id = $request->room_id;
            $data->checkin_date = $request->checkin_date;
            $data->checkout_date = $request->checkout_date;
            $data->total_adults = $request->total_adults;
            $data->total_children = $request->total_children;
            if ($request->ref == 'front') {
                $data->ref = 'front';
            } else {
                $data->ref = 'admin';
            }
            $data->save();


            return redirect('admin/booking/create')->with('success', 'Data has been added.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::where('id', $id)->delete();
        return redirect('admin/booking')->with('success', 'Data has been deleted.');
    }


    // Check Avaiable rooms
    function available_rooms(Request $request, $checkin_date)
    {
        $arooms = DB::SELECT("SELECT * FROM rooms WHERE id NOT IN (SELECT room_id FROM bookings WHERE '$checkin_date' BETWEEN checkin_date AND checkout_date)");

        $data = [];
        foreach ($arooms as $room) {
            $roomTypes = RoomType::find($room->room_type_id);
            $data[] = ['room' => $room, 'roomtype' => $roomTypes];
        }

        return response()->json(['data' => $data]);
    }

    public function front_booking()
    {
        return view('front-booking');
    }

    function booking_payment_success(Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_51KrcRwSGMeYATvGRc5KteDyJkkt1sYV2HfoyPV10M5HOu5SwFlV5K2uqgIErLfTq4R8eD8aS8BCHf6XpgW77baWV00XFDQhca1');
        $session = \Stripe\Checkout\Session::retrieve($request->get('session_id'));
        $customer = \Stripe\Customer::retrieve($session->customer);
        if ($session->payment_status == 'paid') {
            // dd(session('customer_id'));
            $data = new Booking;
            $data->customer_id = session('customer_id');
            $data->room_id = session('room_id');
            $data->checkin_date = session('checkin_date');
            $data->checkout_date = session('checkout_date');
            $data->total_adults = session('total_adults');
            $data->total_children = session('total_children');
            if (session('ref') == 'front') {
                $data->ref = 'front';
            } else {
                $data->ref = 'admin';
            }
            $data->save();
            return view('booking.success');
        }
    }

    function booking_payment_fail(Request $request)
    {
        return view('booking.failure');
    }


    public function searchDate(Request $request)
    {
        $start = $request->input('start');

        $end = $request->input('end');
        $result = Room::whereBetween('Created_at', [$start, $end])->where('available', 'true')->get();
        return view('book-result', ['result' => $result, 'start' => $start, 'end' => $end]);
    }
}
