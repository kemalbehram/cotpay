@extends('Backend.Master.Master')
@section('title','Order Detail')
@section('sell','active')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h5 class="page-headers">
            <a href="{{ route('merchant.index') }}">Trang chủ</a> >> Chi tiết đơn hàng
        </h5>
    </div>
</div>
<div class="order-detail">
    <div class="row">
        <div class="col-xs-12">
            <div class="invoice-title">
                <h3>Order #{{ $order->code_deal}}</h3>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                    <strong>Người gửi:</strong><br>
                        {{ $order->name_sender }}<br>
                        {{ $order->user->phone }}<br>
                        {{ $order->user->address }}<br>
                        {{ $ward_user }} ,{{ $district_user }}, {{ $city_user }}<br>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                    <strong>Người nhận:</strong><br>
                        {{ $order->name_receiver }}<br>
                        {{ $order->phone_receiver }}<br>
                        {{ $order->address_receiver }}<br>
                        {{ $order->ward }}, {{ $order->district }}, {{ $order->city }} <br>
                    </address>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <address>
                        <strong>Vận chuyển:</strong><br>

                        @if($order->service == 1)
                            {{ 'Giao thường' }}
                        @elseif($order->service == 2)
                            {{ 'Giao nhanh' }}
                        @elseif($order->service == 3)
                            {{ 'Hỏa tốc' }}
                            @endif
                        <br>
                        @if ($order->collection == 1)
                            Người gửi trả cước
                        @else
                            Người nhận trả cước
                        @endif
                        <br>
                    </address>
                </div>
                <div class="col-xs-6 text-right">
                    <address>
                        <strong>Ngày tạo:</strong><br>
                       {{ Carbon\Carbon::parse($order->created_at )->format('d-m-Y  h:i:s')}}<br>
                    </address>
                    <address>
                        <strong>Trạng thái:</strong><br>
                        @switch($order->status)
                            @case(1)
                                {{ 'Đơn yêu cầu' }}<br>
                                @break
                            @case(2)
                                {{ 'Chờ lấy hàng' }}
                                @break
                            @case(3)
                            {{ 'Đã nhận' }}
                                @break
                            @case(4)
                                {{ 'Giao dịch hủy' }}
                                @break
                            @case(5)
                                {{ 'Nhận lại hàng' }}
                                @break
                            @case(6)
                                {{ 'Boom hàng' }}
                                @break
                            @case(7)
                                {{ 'Đã nhận lại đơn' }}
                                @break
                            @case(8)
                                {{ 'Đang vận chuyển'}}
                                @break
                            @case(10)
                                {{ 'Đã từ chối'}}
                                @break
                            @case(99)
                                {{ 'Thanh toán thành công' }}
                                @break
                            @default
                                #404
                                @break
                        @endswitch
                    </address>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Thông tin đơn hàng</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Nội dung</strong></td>
                                    <td class="text-center"><strong>Trọng lượng</strong></td>
                                    <td class="text-right"><strong>Giá trị</strong></td>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <tr>
                                    <td>{{ $order->content }}</td>
                                    <td class="text-center">{{ $order->weight }}g</td>
                                    <td class="text-right">{{ number_format($order->money_value) }}<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Phí COT</strong></td>
                                    <td class="no-line text-right">{{ number_format($order->cotpay_fee) }}<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Phí ship</strong></td>
                                    <td class="no-line text-right">{{ number_format($order->ship_fee) }}<sup>đ</sup></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Thành tiền</strong></td>
                                    <td class="no-line text-right">
                                        {{-- @if ($order->collection == 1) --}}
                                            {{-- {{ number_format($order->money_value) }}<sup>đ</sup> --}}
                                        {{-- @else --}}
                                            {{ number_format($order->money_value + $order->ship_fee + $order->cotpay_fee) }}<sup>đ</sup>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!--end main-->

@endsection

