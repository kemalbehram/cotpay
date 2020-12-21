@extends('Backend.Master.Master')
@section('title', 'Change Password')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Đổi mật khẩu </h1>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-xs-12 col-md-12 col-lg-12">
        <form action="{{ route('post.change.password') }}" method="post">
            @csrf
            <div class="main-menu">
                <div class="form-group" style="position: relative;">
                    <label for="password_old">Mật khẩu cũ:</label>
                    <input type="password" class="form-control @error('password_old') is-invalid @enderror"
                        id="password_old" placeholder="Enter password" name="password_old"
                        value="{{old('password_old')}}">
                    <a style="position: absolute;top: 33px;right: 14px;" href="javascript:;void(0)"><i
                            class="fa fa-eye"></i></a>
                    @if($errors->has('password_old'))
                    <div class="error-password-old">
                        <p class="error-input">{{ $errors->first('password_old') }}</p>
                    </div>
                    @endif
                </div>
                <div class="form-group" style="position: relative;">
                    <label for="password">Mật khẩu mới:</label>
                    <input type="password" class="form-control @error('password_old') is-invalid @enderror"
                        id="password" placeholder="Enter password" name="password">
                    <a style="position: absolute;top: 33px;right: 14px;" href="javascript:;void(0)"><i
                            class="fa fa-eye"></i></a>
                    @if($errors->has('password'))
                    <div class="error-password">
                        <p class="error-input">{{ $errors->first('password') }}</p>
                    </div>
                    @endif
                </div>
                <div class="form-group" style="position: relative;">
                    <label for="passwordConfirmation">Nhập lại mật khẩu:</label>
                    <input type="password" class="form-control @error('password_old') is-invalid @enderror"
                        id="passwordConfirmation" placeholder="Comfirm password" name="passwordConfirmation">
                    <a style="position: absolute;top: 33px;right: 14px;" href="javascript:;void(0)"><i
                            class="fa fa-eye"></i></a>
                    @if($errors->has('passwordConfirmation'))
                    <div class="error-passwordConfirmation">
                        <p class="error-input">{{ $errors->first('passwordConfirmation') }}</p>
                    </div>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">OK</button>
            </div>
        </form>
    </div>
</div>

{{--end main--}}
@endsection
@section('script')
<script>
    $(document).ready(function () {
        $('#password_old').click(function () {
            $(this).removeClass('is-invalid');
            $('.error-password_old').addClass('d-none');
        });

        $('#password').click(function () {
            $(this).removeClass('is-invalid');
            $('.error-password').addClass('d-none');
        });

        $('#passwordConfirmation').click(function () {
            $(this).removeClass('is-invalid');
            $('.error-passwordConfirmation').addClass('d-none');
        });
    });



    $(function () {
        $(".form-group a").click(function () {
            let $this = $(this);
            if ($this.hasClass('active')) {
                $this.parents('.form-group').find('input').attr('type', 'password');
                $this.removeClass('active');
            } else {
                $this.parents('.form-group').find('input').attr('type', 'text');
                $this.addClass('active');
            }

        });
    });

</script>
@endsection
