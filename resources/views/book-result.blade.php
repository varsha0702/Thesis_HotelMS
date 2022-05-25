@extends('frontlayout')
@section('content')
<div class="container my-4">
	<h3 class="mb-3">Room Booking</h3>
    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="text-danger">{{$error}}</p>
        @endforeach
    @endif

    @if(Session::has('success'))
    <p class="text-success">{{session('success')}}</p>
    @endif
    <div class="table-responsive">
        <form method="post" enctype="multipart/form-data" action="{{url('admin/booking')}}">
            @csrf
            <table class="table table-bordered">
                <tr>
                    <th>CheckIn Date <span class="text-danger"></span></th>
                     <td><input name="checkin_date" type="date" class="form-control checkin-date" value="{{$start}}" /></td>
                </tr>
                <tr>
                    <th>CheckOut Date <span class="text-danger">*</span></th>
                    <td><input name="checkout_date" type="date" value="{{$end}}" class="form-control" /></td>
                </tr>
                <tr>
                    <th>Avaiable Rooms <span class="text-danger">*</span></th>
                    <td>
                        <select class="form-control room-list" name="room_id">
                        @forelse ($result as $item)
                        
                     
                            <option value="{{$item->id}}">{{$item->title}}---{{$item->Roomtype->price}}</option>
                        
                            @empty 
                            no room      @endforelse
                    </select>
                    <input type="hidden" value="{{$item->Roomtype->price}}" name="roomprice">   
                   
                       {{--  @forelse ($result as $item)
                        <select class="form-control room-list" name="room_id">
                     
                        <option value="{{$item->id}}">{{$item->title}}---</option>
                    
                        </select>
                      
                      <input type="hidden" value="{{$item->Roomtype->price}}" name="roomprice">
                        <p name="roomprice">Price:  <span class="show-room-price" name="roomprice">{{$item->Roomtype->price}}</span></p>
                    </td>
                    @empty
                    <p class="text-danger">No room Avaiable</p>
                     @endforelse --}}
                </tr>
                <tr>
                    <th>voucher <span class="text-danger"></span></th>
                    <td>
                        <input type="text" name="voucher" id="">
                    </td>
                </tr>
                <tr>
                    <th>Total Adults <span class="text-danger">*</span></th>
                    <td><input name="total_adults" type="text" class="form-control" /></td>
                </tr>
                <tr>
                    <th>Total Children</th>
                    <td><input name="total_children" type="text" class="form-control" /></td>
                </tr>
                <tr>
                    <td colspan="2">
                       {{--  @if(Session::has('data'))
                    	<input type="hidden" name="customer_id" value="{{session('data')[0]->id}}" />
                        @endif --}}
                        <input type="hidden" name="customer_id" class="room-price" value="{{Auth::user()->id}}" />
                        
                    	<input type="hidden" name="ref" value="front" />
                        
                     
                        <input type="submit" class="btn btn-primary" />
                   
                      
                    </td>  
                </tr>
            </table>
        </form>

        

    </div>               
</div>
@endsection