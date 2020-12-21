@extends('Frontend.Layouts.Master')
@section('title')
Register Account Customer
@endsection
@section('content')
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-3"></div>
            <div class="content-info col-md-6">
                <h1 style="text-align:center">Tạo tài khoản Customer</h1>
                <form action="{{route('register.customer.post')}}" method="post">
                    @csrf
                    <input class="form-control @error('name') is-invalid @enderror"  id="input-name" type="text" name="name" placeholder="Họ tên" value="{{old('name')}}">
                    @if($errors->has('name'))
                        <div class="error-name">
                            <p  class="error-input">{{ $errors->first('name') }}</p>
                        </div>
				    @endif
                    <input class="form-control @error('email') is-invalid @enderror" id="input-email" type="email" name="email" placeholder="Email" value="{{old('email')}}">
                    @if($errors->has('email'))
                        <div class="error-email">
                            <p  class="error-input">{{ $errors->first('email') }}</p>
                        </div>
				    @endif
                    <input class="form-control @error('phone') is-invalid @enderror" id="input-phone" type="text" name="phone" placeholder="Số điện thoại" value="{{old('phone')}}">
                    @if($errors->has('phone'))
                        <div class="error-phone">
                            <p  class="error-input">{{ $errors->first('phone') }}</p>
                        </div>
                     @endif
                    <input class="form-control @error('password') is-invalid @enderror" id="input-password" type="password" name="password" placeholder="Mật khẩu">
                    @if($errors->has('password'))
                        <div class="error-password">
                            <p  class="error-input">{{ $errors->first('password') }}</p>
                        </div>
                    @endif
                    <input class="form-control @error('passwordConfirmation') is-invalid @enderror" id="input-passwordConfirmation" type="password" name="passwordConfirmation" placeholder="Xác nhận mật khẩu">
                    @if($errors->has('passwordConfirmation'))
                        <div class="error-passwordConfirmation">
                            <p  class="error-input">{{ $errors->first('passwordConfirmation') }}</p>
                        </div>
                    @endif
                    <input class="form-control @error('address') is-invalid @enderror" id="input-address" type="text" name="address" placeholder="Địa chỉ"  value="{{old('address')}}">
                    @if($errors->has('address'))
                        <div class="error-address">
                            <p  class="error-input">{{ $errors->first('address') }}</p>
                        </div>
                    @endif
                    <select  class="form-control js-location @error('city') is-invalid @enderror" id="input-city" data-type="city" name="city">
                        <option value="">Chọn Tỉnh/Thành phố</option>
                        @foreach($cities as $city)
                            <option value="{{$city->code}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city'))
                        <div class="error-city">
                            <p class="error-input">{{ $errors->first('city') }}</p>
                        </div>
                    @endif
                    <select class="form-control js-location @error('district') is-invalid @enderror"  name="district" id="district" data-type="district">
                        <option value="">Chọn Quận/Huyện</option>
                    </select>
                    @if($errors->has('district'))
                        <div class="error-district">
                            <p class="error-input">{{ $errors->first('district') }}</p>
                        </div>
                    @endif
                    <select class="form-control @error('ward') is-invalid @enderror" id="wards" name="ward" data-type="wards">
                        <option value="">Chọn Xã/Phường</option>
                    </select>
                    @if($errors->has('ward'))
                        <div class="error-ward">
                            <p class="error-input">{{ $errors->first('ward') }}</p>
                        </div>
                    @endif
                    <div >
                        <label class="container">Tôi đồng ý với tất cả điều khoản và điều kiện
                            <input id="input-agree" type="checkbox" name="agree" @if(old('agree')) checked @endif>
                            <span class="checkmark"></span>
                        </label>
                    @if($errors->has('agree'))
                        <div class="error-agree">
                            <p class="error-input">{{ $errors->first('agree') }}</p>
                        </div>
                    @endif
                    </div>
                    <div class="agree-create-account">
                        <a title>
                            <button style="background: none; border: none; color: #ffffff" type="submit">Đồng ý và tạo
                                tài khoản
                            </button>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#input-name').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-name').addClass('d-none');
		    });

            $('#input-email').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-email').addClass('d-none');
		    });

            $('#input-phone').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-phone').addClass('d-none');
		    });

            $('#input-password').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-password').addClass('d-none');
		    });

            $('#input-passwordConfirmation').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-passwordConfirmation').addClass('d-none');
		    });

            $('#input-address').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-address').addClass('d-none');
		    });

            $('#input-city').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-city').addClass('d-none');
		    });

            $('#district').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-district').addClass('d-none');
		    });

            $('#wards').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-ward').addClass('d-none');
		    });

            $('#input-agree').click(function(){
                $(this).removeClass('is-invalid');
                $('.error-agree').addClass('d-none');
		    });
        });
    </script>
@endsection
