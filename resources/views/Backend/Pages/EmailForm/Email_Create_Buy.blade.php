@extends('Backend.Pages.EmailForm.Master_Email')
@section('title')
    Thư từ chối
@endsection

@section('content')
    <h1 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#333333;font-size:18px;font-weight:400;line-height:1.4;margin:0;padding:0"
    align="center">Xin chào {{ $name_receiver }}</h1>
    <p>Bạn có 1 yêu cầu mua hàng với thông tin như sau:</p>
    <p>Người gửi: {{ $name_sender }}</p>
    <p>Địa chỉ : {{ $address_sender }}-{{ $ward_sender }}-{{ $district_sender }}-{{ $city_sender }}</p>
    <p>Nội dung hàng: {{ $content }}</p>
    <p>Giá trị hàng: {{ $money_value }} <sub>đ</sub></p>
    <p>Người nhận: {{ $name_receiver }}</p>
    <p>Địa chỉ người nhận: {{ $address_receiver }}-{{ $ward }}-{{ $district }}-{{ $city }}</p>
    <p>Vui lòng đăng nhập Cotpay.web88.vn để tạo đơn hàng</p>
@endsection