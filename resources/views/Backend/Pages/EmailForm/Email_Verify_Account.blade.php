@extends('Backend.Pages.EmailForm.Master_Email')
@section('title')
	Xác nhận tài khoản
@endsection

@section('content')
	<h1 style="font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;color:#333333;font-size:18px;font-weight:400;line-height:1.4;margin:0;padding:0" align="center">Cảm ơn bạn đã sử dụng phần mềm Moki !</h1>
    <p>
    	Để bắt đầu, hãy kiểm tra thông tin đăng ký của bạn.
    </p>
    <p style="text-align:justify"> <b>- Họ Tên:</b> {{  $name  }}</p>
    <p style="text-align:justify"> <b>- Số Điện Thoại:</b> {{ $phone }} </p>
    <p style="text-align:justify"> <b>- Địa Chỉ:</b> {{ $address }} </p>
    <p style="text-align:justify"> <b>- Email:</b> {{ $email }}</p>
    <p style="text-align:justify"> <b>- Mật Khẩu:</b> {{ $password }} </p>
    <div>
        Click vào đây để đăng nhập <a href="http://cotpay.web88.vn"  style="color:#3777b0;text-decoration:none" target="_blank">cotpay.web88.vn</a>
    </div>
@endsection