@extends('layout')
@section('content')
@php  use App\Models\staff_task; @endphp
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                           
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                            <p class="text-success">{{session('success')}}</p>
                            @endif
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Staff Name</th>
                                            <th>Task Name</th>
                                        </tr>
                                    </thead>
                                   
                                    <tbody>
                                        @if($allstaff)
                                            @foreach($allstaff as $d)
                                            <tr>
                                                @php $staff_tasks= staff_task::where('staff_id',$d->id)->get(); @endphp
                                                <td>{{$d->full_name}}</td>
                                                <td>
                                                    @php $i =0; @endphp
                                                    @foreach($staff_tasks as $task)
                                                    @php $i++; @endphp 
                                                    <p>Task no . ({{$i}} ) . {{$task->task_name}} <p> Task complete  :  @if($task->flag == 0) No @else Yes @endif</p><hr/></p> 
                                                   
                                                    @endforeach
                                                </td> 
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