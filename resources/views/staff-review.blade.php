@extends('frontlayout')
@section('content')
<div class="container my-4">
	<h3 class="mb-3">Add Review</h3>
	@if(Session::has('success'))
	<p class="text-success">{{session('success')}}</p>
	@endif
	<form method="post" action="{{url('/staff-review-submit')}}">
		@csrf
		<table class="table table-bordered">
            <tr>
				<th>Custmer<span class="text-danger">*</span></th>
				<td>
                    <select name="custmer_id" required>
                        <option >please select</option>
                        @if($allcus)
                        @foreach($allcus as $cus)
                        <option value="{{$cus->id}}">{{$cus->full_name}} </option>
                        @endforeach
                        @endif
                    </select>
                </td>
			</tr>
			<tr>
				<th>Review<span class="text-danger">*</span></th>
				<td><textarea name="review" class="form-control" rows="8"></textarea></td>
			</tr>
			<tr>
				<td colspan="2"><input type="submit" class="btn btn-primary" /></td>
			</tr>
		</table>
	</form>
</div>
@endsection