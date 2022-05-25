@extends('layout')
@section('content')
@php
use App\Models\Customer;
use App\Models\Staff;
@endphp
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                       
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Custmer name</th>
                                            <th>Staff Name</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if($data)
                                            @foreach($data as $d)
                                            @php $c_row =Customer::where('id',$d->c_id)->first();
                                            $s_row =Staff::where('id',$d->s_id)->first();
                                            @endphp
                                            <tr>
                                                <td>{{$c_row->full_name}}</td>
                                                <td>{{$s_row->full_name}}</td>
                                                <td>{{$d->review}}</td>
                                               
                                            </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@section('scripts')
<!-- Custom styles for this page -->
<link href="/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<!-- Page level plugins -->
<script src="/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/js/demo/datatables-demo.js"></script>

@endsection

@endsection