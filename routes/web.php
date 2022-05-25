<?php

use App\Models\Banner;
use App\Models\RoomType;
use App\Models\Service;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StaffDepartment;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $banners=Banner::where('publish_status','on')->get();
    $services=Service::all();
    $roomTypes=RoomType::all();
    $testimonials=Testimonial::all();
    return View('home',['roomTypes'=>$roomTypes,'services'=>$services,'testimonials'=>$testimonials,'banners'=>$banners]);

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/service/{id}',[HomeController::class,'service_detail']);
Route::get('page/about-us',[PageController::class,'about_us']);
Route::get('page/contact-us',[PageController::class,'contact_us']);

// Admin Login

// Admin Dashboard

//discount route
Route::get('admin/discount',[DiscountController::class,'index']);
//Route::get('admin/discount/create',[DiscountController::class,'create']);
Route::resource('admin/discount',DiscountController::class);

// Banner Routes
Route::get('admin/banner/{id}/delete',[BannerController::class,'destroy']);
Route::resource('admin/banner',BannerController::class);

// RoomType Routes
Route::get('admin/roomtype/{id}/delete',[RoomtypeController::class,'destroy']);
Route::resource('admin/roomtype',RoomtypeController::class);

// Room
Route::get('admin/rooms/{id}/delete',[RoomController::class,'destroy']);
Route::resource('admin/rooms',RoomController::class);

// Customer
Route::get('admin/customer/{id}/delete',[CustomerController::class,'destroy']);
Route::resource('admin/customer',CustomerController::class);

// Delete Image
Route::get('admin/roomtypeimage/delete/{id}',[RoomtypeController::class,'destroy_image']);

// Department
Route::get('admin/department/{id}/delete',[StaffDepartment::class,'destroy']);
Route::resource('admin/department',StaffDepartment::class);

// Staff Payment
Route::get('admin/staff/payments/{id}',[StaffController::class,'all_payments']);
Route::get('admin/staff/payment/{id}/add',[StaffController::class,'add_payment']);
Route::post('admin/staff/payment/{id}',[StaffController::class,'save_payment']);
Route::get('admin/staff/payment/{id}/{staff_id}/delete',[StaffController::class,'delete_payment']);
// Staff CRUD
Route::get('admin/staff/{id}/delete',[StaffController::class,'destroy']);
Route::resource('admin/staff',StaffController::class);
Route::get('admin/manageStaff',[StaffController::class,'manage_staff']);
Route::get('admin/viewmanageStaff',[TaskController::class,'view_manage_staff']);
Route::post('admin/assigntask',[StaffController::class,'Assign_task']);


// Booking
Route::get('admin/booking/{id}/delete',[BookingController::class,'destroy']);
Route::get('admin/booking/available-rooms/{checkin_date}',[BookingController::class,'available_rooms']);
Route::resource('admin/booking',BookingController::class);

//customer login
Route::post('customer/login',[CustomerController::class,'customer_login']);


//staff
Route::get('staff-login',[StaffController::class,'login']);
Route::post('staff/login',[StaffController::class,'staff_login']);
Route::get('staff/view-task',[StaffController::class,'viewTask']);
Route::get('staff/logout',[StaffController::class,'logout']);
//bookings
Route::get('booking',[BookingController::class,'front_booking'])->middleware('auth');
Route::get('booking/success',[BookingController::class,'booking_payment_success']);
Route::get('booking/fail',[BookingController::class,'booking_payment_fail']);

// Service CRUD
Route::get('admin/service/{id}/delete',[ServiceController::class,'destroy']);
Route::resource('admin/service',ServiceController::class);

// Testimonial
Route::get('customer/add-testimonial',[HomeController::class,'add_testimonial']);
Route::post('customer/save-testimonial',[HomeController::class,'save_testimonial']);
Route::get('admin/testimonial/{id}/delete',[AdminController::class,'destroy_testimonial']);
Route::get('admin/testimonials',[AdminController::class,'testimonials']);
Route::post('save-contactus',[PageController::class,'save_contactus']);



///check the date
Route::get('checkDate',[BookingController::class,'searchDate']);
Route::get('new/{id}',[TaskController::class,'show']);
Route::put('staff/taskupdate/{id}',[TaskController::class,'update']);



//progile profile
Route::get('profile',[UserController::class,'show']);
Route::get('history',[UserController::class,'history']);
Route::get('page/about-us1', function () {
    return view('/about_us1');
});
Route::get('page/contact-us1', function () {
    return view('/contact_us1');
});