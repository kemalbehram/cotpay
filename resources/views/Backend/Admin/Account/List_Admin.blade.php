@extends('Backend.Admin.Master.Master')
@section('title','Manager account admin')
@section('account_admin','active')
@section('in_admin','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý tài khoản admin</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách tài khoản <a href="{{ route('get.add.account.admin') }}">Thêm tài khoản</a>
            </div>
            
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>STT</th>
								<th>Họ tên</th>
								<th>Email</th>
								<th>Số điện thoại</th>
								<th>Địa chỉ</th>
								<th>Phường/Xã</th>
								<th>Quận/Huyện</th>
                                <th>Tỉnh/Thành phố</th>
                                <th>Vai trò</th>
								<th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($admins as $key => $item)
                            
								<tr>
									<td>{{ $key + 1}}</td>
									<td>{{ $item->name }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->phone }}</td>
                                    <td>{{ $item->address }}</td>
                                    {{-- @dd(App\Models\Cities::where('code', $item->ward)->first()['name']) --}}
									<td>{{ App\Models\Cities::where('code', $item->ward)->first()['name'] }}</td>
									<td>{{ App\Models\Cities::where('code', $item->district)->first()['name'] }}</td>
                                    <td>{{ App\Models\Cities::where('code', $item->city)->first()['name'] }}</td>

                                    <td>
                                    @php
										$resultstr = array();
									@endphp
                                    @foreach ($item->getRoleNames() as $value)
									@php
										$resultstr[] = $value
									@endphp
                                    @endforeach
									{{  implode(", ",$resultstr) }}</td>
									<td>
                                        <a href="{{ route('get.edit.account.admin', ['id' => $item->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-edit"></i> Edit</a>
                                        <a href="{{ route('get.delete.account.admin', ['id' => $item->id]) }}" onclick="return confirm('Delete account ? Do you want continue !')"  class="btn btn-sm btn-link" data-button-type="delete"><i class="fa fa-trash"></i> Delete</a>
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