@extends('frontlayout')
@section('content')
<link href="{{ asset('/bs5/bootstrap.min.css') }}" rel="stylesheet" />
<script type="text/javascript" src="{{ asset('/vendor/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('/bs5/bootstrap.bundle.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
    integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
    integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
</script>
<div class="container mt-5">
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">checkin_date</th>
            <th scope="col">checkout_date</th>
            <th scope="col">total_adults</th>
            <th scope="col">Price</th>
            <th scope="col">Room title</th>
            <th scope="col">Room details</th>
          </tr>
        </thead>
        <tbody>
            @forelse ($history as $item)
            <tr>
                <th scope="row">1</th>
                <td>{{$item->checkin_date}}</td>
                <td>{{$item->checkout_date}}</td>
                <td>{{$item->total_adults}}</td>
                <td>{{$item->roomprice}}</td>
                <td>{{$item->roomtype->title}}</td>
                <td>{{$item->roomtype->detail}}</td>
              </tr>
            @empty
                
            @endforelse
         
         
        </tbody>
      </table>
</div>
@endsection