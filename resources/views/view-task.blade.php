@extends('stafflayout')
@section('content')
<div class="container my-4">
	<h3 class="mb-3">View Task </h3>

	<div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Task Name</th>
                                            <th>status</th>
                                            <th>Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($staff_tasks)
                                        @php $i =0 ; @endphp
                                            @foreach($staff_tasks as $d)
                                            @php $i ++; @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$d->description}}</td>
                                                <td>{{$d->status}}</td>
                                                <td><a href="/new/{{$d->id}}">Update</a></td>
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>

</div>
@endsection