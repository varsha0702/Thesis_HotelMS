@extends('layout')
@section('content')
<!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Add Staff
                            </h6>
                        </div>
                        <div class="card-body">
                            @if(Session::has('success'))
                            <p class="text-success">{{session('success')}}</p>
                            @endif
                            <div class="table-responsive">
                                <form enctype="multipart/form-data" method="post" action="{{url('admin/assigntask')}}">
                                    @csrf
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Select Staff</th>
                                            <td>
                                                <select name="title" class="form-control" required>
                                                    <option value="0">--- Select ---</option>
                                                    @foreach($Staffs as $Staff)
                                                    <option value="{{$Staff->id}}">{{$Staff->full_name}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Assign Task</th>
                                            <td><input name="description" class="form-control" type="text" required/></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="submit" class="btn btn-primary" />
                                            </td> 
                                        </tr>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

@endsection