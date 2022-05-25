@extends('stafflayout')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="table-responsive">
            <form method="post" action="{{ url('staff/taskupdate/' . $data->id) }}">
                @csrf
                @method('put')
                <table class="table table-bordered">
                    <tr>
                       
                        <td><input value="{{ $data->title }}" name="title" type="hidden" class="form-control" /></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input value="{{ $data->description }}" name="description" type="text" class="form-control" /></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><select name="status" id="">
                        <option value="progress">progress</option>    
                        <option value="done">done</option>    
                        </select></td>
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
    <!-- /.container-fluid -->

@endsection
