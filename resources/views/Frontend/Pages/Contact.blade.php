@extends('Frontend.Layouts.Master')
@section('title')
    Vài điều về chúng tôi
@endsection
@section('content')
    <div class="container">
        <div class="row contact-us">
            <div class="col-md-4">
                <h1>Cho chúng tôi biết vấn đề bạn đang gặp phải</h1>
                <h2>Những vấn đề thường gặp</h2>
                <p class="title-content">lorem lpsum simply dummy</p>
                <p>hen an unknow printer took a galley of type</p>
                <p class="title-content">lorem lpsum simply dummy</p>
                <p>hen an unknow printer took a galley of type</p>
                <p class="title-content">lorem lpsum simply dummy</p>
                <p>hen an unknow printer took a galley of type</p>
            </div>
            <div class="col-md-8">
                <h2>Cách khác để liên hệ hỗ trợ</h2>
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <div class="icon-contact">
                            <div class="icon">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                            </div>
                            <h3>Gửi email</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="icon-contact">
                            <div class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </div>
                            <h3>Trung tâm hỗ trợ</h3>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="icon-contact">
                            <div class="icon">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                            </div>
                            <h3>Đường dây nóng</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <form action="{{route('post.contact')}}" method="post" >
                            @csrf
                            <div class="input-info mt-3" style="padding-right: 30px;border-right: 1px solid #0000004f;">
                                <input type="text" name="phone" value="{{ old('phone') }}" placeholder="Số điện thoại hoặc email...">
                                 <p class="help is-danger" style="color: red">{{ $errors->first('phone') }}</p>
                                <p><strong>Vấn đề bạn gặp phải</strong></p>
                                <input class="problem" type="text" name="question" value="{{ old('question') }}" placeholder="Nhập vào vấn đề của bạn...">
                                 <p class="help is-danger" style="color: red">{{ $errors->first('question') }}</p>
                                <div class="sent">
                                    <button type="submit" class="btn btn-primary">Gửi</button>
                                </div>
                                @if(session('thongbao'))
                                <div class="alert alert-success">
                                    {{session('thongbao')}}
                                </div>
                                @endif
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="input-info mt-3">
                            <p>Đội ngũ chăm sóc khách hàng của chúng tôi sẽ phản hồi bạn ngay khi có thể</p>
                            <p>Nếu không thấy phản hồi bạn có thể liên hệ đường dây nóng:</p>
                            <p><span>0542-846-536</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
