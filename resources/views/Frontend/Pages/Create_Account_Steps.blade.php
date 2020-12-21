@extends('Frontend.Layouts.Master')
@section('title')
    Các bước tạo tài khoản
@endsection
@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <div class="item-step">
                            <div class="number-step">
                                <p>1</p>
                            </div>
                            <h2>Đăng kí tài khoản</h2>
                            <p>Tạo tài khoản COTPAY miễn phí</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-step">
                            <div class="number-step">
                                <p>2</p>
                            </div>
                            <h2>Kết nối ví điện tử</h2>
                            <p>Kết nối tài khoản COTPAY với ví điện tử của bạn</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="item-step">
                            <div class="number-step">
                                <p>3</p>
                            </div>
                            <h2>Bắt đầu mua sắm</h2>
                            <p>Thanh toán nhanh chóng chính xác chỉ bằng click</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <div class="icon-create-account">
                            <i class="fa fa-user fa-3x" aria-hidden="true"></i>
                            <a style="font-size: 12px;" href="{{ route('register.customer.get') }}">Tạo tài khoản cá nhân</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-create-account">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <a style="font-size: 12px;" href="{{ route('register.merchant.get') }}">Tạo tài khoản bán hàng</a>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="icon-create-account">
                            <i class="fa fa-building-o fa-xs" aria-hidden="true"></i>
                            <a style="font-size: 12px;" href="{{ route('register.business.get') }}">Tạo tài khoản doanh nghiệp</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
