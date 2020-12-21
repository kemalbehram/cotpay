@extends('Backend.Admin.Master.Master')
@section('title','Manager account admin')
@section('account','active')
@section('account_business','active')
@section('in','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Quản lý tài khoản business</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách tài khoản
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
								<th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach ($business as $key => $item)
								<tr>
									<td>{{ $key +1 }}</td>
									<td>{{ $item->name }}</td>
									<td>{{ $item->email }}</td>
									<td>{{ $item->phone }}</td>
									<td>{{ $item->address }}</td>
									<td>{{ App\Models\Cities::where('code', $item->ward)->first()['name'] }}</td>
									<td>{{ App\Models\Cities::where('code', $item->district)->first()['name'] }}</td>
									<td>{{ App\Models\Cities::where('code', $item->city)->first()['name'] }}</td>
									<td>
                                        @if ($item->lock == 1)
                                            <a href="{{ route('lock.account.user',['id' => $item->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-lock fa-fw"></i> Lock account</a>
                                        @else
                                            <a href="{{ route('unlock.account.user',['id' => $item->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-unlock fa-fw"></i> Unlock account</a>
                                        @endif
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