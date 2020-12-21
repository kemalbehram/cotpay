@extends('Backend.Master.Master')
@section('title','Management-Buy')
@section('management.buy','active')
@section('management.in','in')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h5 class="page-headers">
            <a href="{{ route('merchant.index') }}">Trang chủ</a> >> Quản lý giao dịch mua
        </h5>
    </div>
</div>
<form action="{{ route('order.export.excel2')}}" method="POST" class="row" style="margin-bottom:10px">
	@csrf
	<div class="col-md-3 col-sm-5" style="margin-bottom:10px">
		Từ ngày:<input type="date" id="start-date" class="form-control" name="start">
	</div>
	<div  class="col-md-3 col-sm-5" style="margin-bottom:10px">
		Đến ngày:<input type="date" id="end-date" class="form-control" name="end">
	</div>
	<input type="text" name="sellBuy" value="2" hidden>
	<div class="col-md-3 col-sm-3" style="margin-top: 20px;">
		<button type="button" onclick="filterOrder(2)" class="btn btn-default">Tìm kiếm</button>
	</div>
	<div class="col-md-3 col-sm-3" style="margin-top: 20px;">
		<button type="submit" class="btn btn-primary btn-sm">
			<i class="fa fa-cloud-download"></i>Xuất File Excel
		</button>
		{{-- <button type="button" onclick="importOrder(1)" class="btn btn-primary btn-sm">
			<i class="fa fa-cloud-upload"></i>Nhập File Excel
		</button>	 --}}
	</div>
</form>
<div>
	<p style="font-size:8px">
		<button style="font-size: 11px;" type="button" onclick="filterOrder(2)" class="btn btn-default all-orders">Tất cả({{ count($orders) }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(1,2)" class="btn btn-default request-deal">Đơn yêu cầu({{ $status_request_deal }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(2,2)" class="btn btn-default pending">Chờ lấy hàng({{ $status_pending }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(8,2)" class="btn btn-default delivery">Đang vận chuyển({{ $status_delivery }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(3,2)" class="btn btn-default received">Đã nhận({{ $status_received }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(4,2)" class="btn btn-default canceled">Giao dịch hủy({{ $status_cenceled }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(5,2)" class="btn btn-default re-receive">Nhận lại hàng({{ $status_re_receive }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(7,2)" class="btn btn-default re-received">Đơn đã nhận lại({{ $status_re_received }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(99,2)" class="btn btn-default payment-success">Thanh toán thành công({{ $status_payment_success }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(6,2)" class="btn btn-default boom">Boom({{ $status_boom }})</button>
		<button style="font-size: 11px;" type="button" onclick="orderByStatus(10,2)" class="btn btn-default declined">Đã từ chối({{ $status_declined }})</button>
	</p>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataTables Advanced Tables
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="font-size: 12px;" class="table table-striped table-bordered table-hover"
                        id="dataTables-example">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Mã GD</th>
                                <th>Người nhận</th>
                                <th>Hàng hóa</th>
                                <th>Ngày tạo</th>
                                <th>GT đơn</th>
                                <th>Phí COT</th>
                                <th>Phí Ship</th>
                                <th>Mã đơn hàng</th>
                                <th>Ngày nhận hàng</th>
                                <th>Ngày gửi hàng</th>
                                <th>Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_data">
                            @foreach ($orders as $key =>$item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td style="color:#007a6e">
                                    <b>{{ $item->code_deal }}</b><br>
                                    <a style="font-size: 12px;" href="{{ route('order.detail',$item->id) }}">Xem chi
                                        tiết</a>
                                </td>
                                {{-- <td><b>{{ $item->name_sender }}</b></td> --}}
                                <td>
                                    <b>{{ $item->name_receiver }}</b><br>
                                    {{ $item->phone_receiver }}
                                </td>
                                <td>{{ $item->content }}</td>

                                <td>{{ Carbon\Carbon::parse($item->created_at )->format('d-m-Y')}}</td>
                                <td style="color:#007a6e">{{ number_format($item->money_value) }}<sup>đ</sup></td>
                                <td style="color:#007a6e">
                                    @if($item->collection = 1)
                                    {{ number_format($item->cotpay_fee) }}
                                    @else
                                    -
                                    @endif
                                    <sup>đ</sup>
                                </td>
                                <td style="color:#007a6e">{{ number_format($item->ship_fee) }}<sup>đ</sup></td>
                                <td>
                                    @if($item->code_bill !=null)
                                    {{$item->code_bill}}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if($item->date_ship_receive !=null)
                                    {{ Carbon\Carbon::parse($item->date_ship_receive )->format('d-m-Y')}}
                                    @else
                                    --:--:----
                                    @endif
                                </td>
                                <td>
                                    @if($item->date_ship_success !=null)
                                    {{ Carbon\Carbon::parse($item->date_ship_success )->format('d-m-Y')}}
                                    @else
                                    --:--:----
                                    @endif
                                </td>
                                <td>
                                    @switch($item->status)
                                    @case(1)
                                    {{ 'Đơn yêu cầu' }}<br>
                                    <a href="{{ route('button.order.canceled', $item->id) }}"
                                        style="font-size: 12px;color:red">Hủy đơn</a>
                                    @break
                                    @case(2)
                                    {{ 'Chờ lấy hàng' }}
                                    <br><a href='{{ route('button.status.request_return_order', $item->id) }}' style='font-size: 12px;color:red'>Đề nghị trả hàng</a>
                                    @break
                                    @case(3)
                                    {{ 'Đã nhận' }}
                                    <br><a href="{{ route('button.status.payment', $item->id) }}"
                                        style="font-size: 12px;color:green">Thanh toán</a>
                                    @break
                                    @case(4)
                                    {{ 'Giao dịch hủy' }}
                                    @break
                                    @case(5)
                                    {{ 'Nhận lại hàng' }}
                                    <br><a href="{{ route('button.status.request_return_money', $item->id) }}"
                                        style="font-size: 12px;color:blue">Đề nghị hoàn tiền</a>
                                    @break
                                    @case(6)
                                    {{ 'Boom hàng' }}
                                    @break
                                    @case(7)
                                    {{ 'Đã nhận lại đơn' }}
                                    @break
                                    @case(8)
                                    {{ 'Đang vận chuyển'}}
                                    <br><a href='{{ route('button.status.request_return_order', $item->id) }}' style='font-size: 12px;color:red'>Đề nghị trả hàng</a>
                                    @break
                                    @case(10)
                                    {{ 'Đã từ chối'}}
                                    @break
                                    @case(99)
                                    {{ 'Thanh toán thành công' }}
                                    @break
                                    @default
                                    #404
                                    @endswitch
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

@section('script')
	<script src="admin-template/js/cotpat-free.js"></script>
@endsection
