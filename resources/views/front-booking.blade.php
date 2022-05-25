@extends('frontlayout')
@section('content')
<div class="container my-4">
	<h3 class="mb-3"><i class="bi bi-bar-chart-steps"></i> Choose the Booking Date</h3>


    <form action="/checkDate">
        <input name="start" type="date"  class="form-control" />
        <br>
        <input name="end" type="date" class="form-control" />
        <button type="submit" class="mt-2">Search</button>
    </form>
    

@endsection