@extends('Backend.Admin.Master.Master')
@section('title','Role')
@section('role','active')
@section('in_role','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Vai trò</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách vai trò <a href="{{ route('get.add.role') }}">Thêm vai trò</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Name</th>
								<th>Guard Type</th>
								<th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($roles as $key => $item)
								<tr>
									<td>{{ $key + 1 }}</td>
									<td>{{ $item->name }}</td>
									<td>{{ $item->guard_name }}</td>
									<td>
                                        <a href="{{ route('get.edit.role', ['id' => $item->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ route('del.role', ['id' => $item->id]) }}" onclick="return confirm('Delete role ? Do you want continue !')"  class="btn btn-sm btn-link" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a>
									</td>
								</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
             
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
@endsection