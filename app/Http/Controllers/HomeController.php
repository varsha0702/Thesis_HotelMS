<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Add Testimonial
    function add_testimonial(){
        return view('add-testimonial');
    }

    // Save Testimonial
    function save_testimonial(Request $request){
        $customerId=session('data')[0]->id;
        $data=new Testimonial;
        $data->customer_id=$customerId;
        $data->testi_cont=$request->testi_cont;
        $data->save();

        return redirect('customer/add-testimonial')->with('success','Data has been added.');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $banners=Banner::where('publish_status','on')->get();
        $services=Service::all();
        $roomTypes=RoomType::all();
        $testimonials=Testimonial::all();
        return View('home',['roomTypes'=>$roomTypes,'services'=>$services,'testimonials'=>$testimonials,'banners'=>$banners]);
   
    }
     // Home Page
     function home(){
        $banners=Banner::where('publish_status','on')->get();
        $services=Service::all();
        $roomTypes=RoomType::all();
        $testimonials=Testimonial::all();
        return View('home',['roomTypes'=>$roomTypes,'services'=>$services,'testimonials'=>$testimonials,'banners'=>$banners]);
    }

    // Service Detail Page
    function service_detail(Request $request, $id){
        $service=Service::find($id);
        return View('servicedetail',['service'=>$service]);
    }

}
