@extends('Backend.Master.Master')
@section('title','Index-Business')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h5 class="page-headers">
            <a href="{{ route('merchant.index') }}">Trang chủ</a> >> Tổng quan
        </h5>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <div class="main-menu">
            <div class="menu-label-span ml-3">
                <label for="">Mã khách hàng:</label> {{ Auth::user()->code_user }} <br>
                <label for="">Tên shop/công ty:</label> {{ Auth::user()->name_user }} <br>
                <label for="">Bonus:</label> {{ number_format(Auth::user()->money_bonus) }}<sup>đ</sup> <br>
                <label for="">Đánh giá:</label> {{ Auth::user()->star_rate }} <i class="glyphicon glyphicon-star"></i><br>
                <label for="">Tỉ lệ hoàn đơn:</label> {{ Auth::user()->percent_returned }} % <br>
                {{-- <span>S12345678889</span>
                <span>Business</span>
                <span>5%</span>
                <span><i class="fa fa-star"></i> 4.86</span>
                <span>Bonus: 1.250.000</span> --}}
            </div>
            <div class="menu-setting mt-3">
                <ul style="    margin: 15px;">
                    <li>Hướng dẫn khách hàng tạo đơn</li>
                    <li>Hướng dẫn quản lý giao dịch </li>
                    <li>Hướng dẫn Merchant cách thuyết phục người dùng sử dụng dịch vụ giao dịch qua COT </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection