@extends('Backend.Pages.EmailForm.Master_Email')
@section('title')
	Đề nghị hoàn tiền
@endsection

@section('content_email')
	<h1 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#333333;font-size:18px;font-weight:400;line-height:1.4;margin:0;padding:0"
	align="center">Xin chào anh/chị {{ $name_sender }}</h1>
	<p>Anh/Chị {{ $name_receiver }} yêu cầu hoàn lại tiền cho đơn hàng #{{ $code_deal }} của anh/chị</p>
	<b>Thông tin đơn hàng:</b>
	<p>Nội dung hàng: {{ $content }}</p>
	<p>Giá trị hàng: {{ $money_value }} <sub>đ</sub></p>
	<p>Người nhận: {{ $name_receiver }}</p>
	<p>Địa chỉ người nhận: {{ $address_receiver }}-{{ $ward }}-{{ $district }}-{{ $city }}</p>
	<p>Vui lòng đăng nhập Cotpay.web88.vn để tạo đơn hàng</p>
@endsection

