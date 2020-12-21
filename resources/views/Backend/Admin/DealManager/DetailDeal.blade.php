@extends('Backend.Admin.Master.Master')
@section('title','List Detail')
@section('contact','active')
@section('in_deal','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách chi tiết giao dịch</h1> <span style="float: left;">User ID: {{$order->id}}</span> 
    <div>
        <h4><a href="{{route('list.deal.than.10t')}}" style="float: right ;display:inline-block;margin-left:5%;" class="btn btn-primary">Danh sách giao dịch > 10 triệu</a></h4>
        <h4><a href="{{route('list.deal.under.10t')}}" style="float: right" class="btn btn-primary">Danh sách giao dịch < 10 triệu</a></h4>
    </div>
    </div>
</div>
<div class="order-detail">
    <div class="row mt-2">
        <div class="col-md-3 col-sm-6 col-12 ">
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Mã vận đơn
                </p>
                <p class="text-danger d-inline-block">
                    {{ $order->code_deal }}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Ngày tạo
                </p>
                <p class="text-danger d-inline-block">
                    {{ Carbon\Carbon::parse($order->created_at )->format('d-m-Y  h:i:s')}}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Trang thái
                </p>
                <p class="text-danger d-inline-block">
                    @if($order->status == 1)
                        {{ 'Chờ duyệt' }}
                    @elseif($order->status == 2)
                        {{ 'Chờ lấy hàng' }}
                    @elseif($order->status == 3)
                        {{ 'Đang vận chuyển' }}
                    @elseif($order->status == 4)
                        {{ 'Đang giao hàng' }}
                    @elseif($order->status == 5)
                        {{ 'Giao thành công' }}
                    @elseif($order->status == 6)
                        {{ 'Chờ duyệt hoàn' }}
                    @elseif($order->status == 7)
                        {{ 'Duyệt hoàn' }}
                    @elseif($order->status == 8)
                        {{ 'Hoàn thành công' }}
                    @endif
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Dịch vụ
                </p>
                <p class="text-danger d-inline-block">
                    @if($order->service == 1)
                        {{ 'Giao thường' }}
                    @elseif($order->service == 2)
                        {{ 'Giao nhanh' }}
                    @elseif($order->service == 3)
                        {{ 'Hỏa tốc' }}
                        @endif
                </p>
            </div>
            <hr>
            <label for="" style="margin-bottom:15px">Hàng hóa</label>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Tên hàng
                </p>
                <p class="text-danger d-inline-block">
                    {{ $order->content }}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Số lượng
                </p>
                <p class="text-danger d-inline-block">
                     {{ $order->qty }}
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Giá trị
                </p>
                <p class="text-danger d-inline-block">
                    {{ number_format($order->money_value) }}<sup>đ</sup>
                </p>
            </div>
            <div class="d-flex justify-content-between">
                <p class="d-inline-block">
                    Trọng lượng
                </p>
                <p class="text-danger d-inline-block">
                    {{ $order->weight }}
                </p>
            </div>
        </div>
        <div class="col-md-4 mx-2 col-sm-5 col-12" style="margin : 1rem;">
            <div>
                <label for="" style="margin-bottom:15px">Người gửi</label>
                <p>{{ $order->user->name }} - {{ $order->user->phone }}</p>
                <p>Địa chỉ: {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}</p>
            </div>
            <hr>
            <div>
                <label for="" style="margin-bottom:15px">Người Nhận</label>
                <p>{{ $order->name_receiver }} - {{ $order->phone_receiver }}</p>
                <p>Địa chỉ: {{ $order->ward }}, {{ $order->district }}, {{ $order->city }}</p>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 col-12 free-collection">
            <div>
                <label for="" style="margin-bottom:20px">Phí và tiền thu hộ</label>
                <div class="d-flex justify-content-between">
                    <p class="d-inline-block">
                        Phí COT
                    </p>
                    <p class="text-danger d-inline-block">
                        {{ number_format($order->cotpay_fee) }}<sup>đ</sup>
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="d-inline-block">
                        Phí vận chuyển
                    </p>
                    <p class="text-danger d-inline-block">
                        {{ number_format($order->ship_fee) }}<sup>đ</sup>
                    </p>
                </div>

                <div class="d-flex justify-content-between">
                    <p class="d-inline-block">
                        Tổng cước
                        (
                            @if ($order->collection == 1)
                                Người gửi trả cước
                            @else
                                Người nhận trả cước
                            @endif
                        )
                    </p>
                    <p class="text-danger d-inline-block">
                        {{ number_format($order->ship_fee) }}<sup>đ</sup>
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="d-inline-block">
                        Tiền thu hộ
                    </p>
                    <p class="text-danger d-inline-block">
                        {{ number_format($order->money_value) }}<sup>đ</sup>
                    </p>
                </div>
                <div class="d-flex justify-content-between">
                    <p class="d-inline-block">
                        Tiền thu người nhận
                    </p>
                    <p class="text-danger d-inline-block">
                        @if ($order->collection == 1)
                            {{ number_format($order->money_value) }}<sup>đ</sup>
                        @else
                        {{ number_format($order->money_value + $order->ship_fee) }}<sup>đ</sup>
                        @endif

                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- /.col-lg-12 -->
</div>
@endsection