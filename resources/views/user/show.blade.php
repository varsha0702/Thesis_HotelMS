@extends('frontlayout')
@section('content')

<div class="myprofile-main" style="color:rgb(86, 168, 240) ;background-repeat:no-repeat;background-size:cover;">
  
    <div class="container myprofile text-center pt-5 pb-5">
      <h2 class="my-set text-center" >{{ __('My Profile') }} </h2>
      <hr style="border-color:black;">

      <div class="text-center">
        Bonus point <small class="text-danger">{{$point}}</small><br>

        <strong class="text-dark"> More Points means more discounts	&#129297;.</strong>
      
      </div>
    
        <div class="card " style="width:30%;background-color:lightgrey;  margin-left: 35%;">
          <div class=" container ">
        <p>
          
          <br>
          <input class="input" type="hidden" value="{{Auth::user()->id}}" readonly>
        </p>
  
       
  
        <p>
          <b>{{ __('Name') }}</b>
          <br>
          <input class="input" type="text" value="{{Auth::user()->name}}" readonly>
        </p>
        <p>
          <b>{{ __('Surname') }}</b>
          <br>
          <input class="input" type="text" value="{{Auth::user()->surname}}" readonly>
        </p>
  
        <p>
          <b>{{ __('Email') }}</b>
          <br>
          <input class="input" type="text" value="{{Auth::user()->email}}" readonly>
        </p>
        <p>
          <b>{{ __('Address') }}</b>
          <br>
          <input class="input" type="text" value="{{Auth::user()->address}}" readonly>
        </p>
        <p>
          <b>{{ __('Phone') }}</b>
          <br>
          <input class="input" type="number" value="{{Auth::user()->phone}}" readonly>
        </p>
       
       <br>
     
        
      </div>
      </div>
       
     
    </div>
  </div>
  <style>
      p{
          margin-left: 100px;
          margin-top: 10%;
          margin-bottom: 10%;
      }
  </style>
  @endsection