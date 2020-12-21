@extends('Frontend.Layouts.Master')
@section('title','Reset Password')
@section('content')
<div class="container">
    <form action="{{ route('post.reset.password') }}"  method="POST" class="w-50 m-auto py-5">
        @csrf
        <div class="md-form form-sm mb-7" style="margin-top:10px">
            <label data-error="wrong" data-success="right" for="password">Mật khẩu mới <span style="color: #d70000;">*</span></label>
            <input type="password" id="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" placeholder="">
            @if($errors->has('password'))
                <div class="error-password">
                    <p class="error-input" >{{ $errors->first('password') }}</p>
                </div>
            @endif
        </div>
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="code" value="{{ $code }}">
        <div class="md-form form-sm mb-7" style="margin-top:10px">
            <label data-error="wrong" data-success="right" for="password">Nhập lại mật khẩu <span style="color: #d70000;">*</span></label>
            <input type="password" id="password_confirmation" class="form-control form-control-sm @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="">
            @if($errors->has('password_confirmation'))
                <div class="error-password-confirmation">
                    <p class="error-input" >{{ $errors->first('password_confirmation') }}</p>
                </div>
            @endif
        </div>
        <div class="text-center mt-2">
            <button type="submit"  class="btn btn-primary">Xác nhận</button>
        </div>
    </form>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function () {

            $('#password').click(function () {
                $('#password').removeClass('is-invalid');
                $('.error-password').addClass('d-none');
            });

            $('#password_confirmation').click(function () {
                $('#password_confirmation').removeClass('is-invalid');
                $('.error-password-confirmation').addClass('d-none');
            });
        });
    </script>
@endsection
