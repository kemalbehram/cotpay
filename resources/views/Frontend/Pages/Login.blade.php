@extends('Frontend.Layouts.Master')
@section('title')
	Login
@endsection
@section('content')
	<form  method="post" action="{{ route('post.login') }}" id="myForm">
		@csrf
		<div class="choose-wallet form-login" style="border: 1px solid #00000040;">
			<div class="title-complete background-login">
				<a href="#" title>
					<img class="img-logo" src="asset/images/cot1.png">
				</a>
			</div>
			<p id="noty"></p>
			<div class="content">
				<input class="form-control @error('phone') is-invalid @enderror" id="input-phone" type="text"  name="phone" placeholder="Phone ..." style="width: 100%">
				@if($errors->has('phone'))
					<div class="error-phone">
						<p  style="text-align: left;margin-bottom: 10px;color: red;font-size: 15px;font-style: italic;padding-left: 10px;">{{ $errors->first('phone') }}</p>
					</div>
				@endif
				<input class="form-control @error('password') is-invalid @enderror" id="input-password" type="password" name="password" placeholder="Password ..." style="width: 100%">
				@if($errors->has('password'))
					<div class="error-password">
						<p  style="text-align: left;margin-bottom: 10px;color: red;font-size: 15px;font-style: italic;padding-left: 10px;">{{ $errors->first('password') }}</p>
					</div>
				@endif
				<div class="forgot-password">
					<a style="cursor: pointer;" data-toggle="modal" data-target="#forgotModal">Forgot password?</a>
				</div>
			</div>
			<div class="connect" style="margin-top: 20px;">
				<a title><button style="color: #ffffff; background: none; border: none" type="submit">Login</button></a>
			</div>
			<div class="no-account">
				<p>You no account?<span><a href="#" title> Register</a></span></p>
			</div>
		</div>
	</form>
	{{-- modal forgot --}}
	<div class="modal fade" data-keyboard="true" tabindex="-1" id="forgotModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Forgot Password</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">
					<div id="success-msg" class="d-none">
						<div class="alert alert-info alert-dismissible fade in" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
							<strong>Success!</strong> Check your mail for login confirmation!!
						</div>
					</div>
					<form action="" method="post" id="formEmail">
						@csrf
						<div class="form-group">
							<label for="createEmail">Address email <span style="color: #d70000;">*</span></label>
							<input type="email" name="email" class="form-control" id="createEmail">
							<p style="font-size: 15px;font-style: italic;color: red;margin-top: 10px;"
							   id="emailError"></p>
							<button type="submit" id="btnForgotPassword" class="btn btn-primary">Send Mail</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('script')
	<script type="text/javascript">
		$(document).ready(function () {
			$("#btnForgotPassword").click(function (e) {
				e.preventDefault();
				var _token = $("input[name='_token']").val();
				var email = $("input[name='email']").val();
				$('emailError').addClass('d-none');
				$.ajax({
					type: 'post',
					url: '{{route('post.forgot.password.user')}}',
					data: {_token: _token, email: email},
					success: function (data) {
						console.log(data.danger);
						if (data.danger) {
							$('#emailError').text(data.danger);
							$('#createemail').css('border', '1px solid red');
						} else {
							$('#forgotModal').modal('hide');
							$('#noty').text('Thanh công');
						}
					},
					error: function (data) {
						$('#createEmail').css('border', '1px solid red');
						// console.log(data);
						var errors = data.responseJSON;
						if ($.isEmptyObject(errors) == false) {
							$.each(errors.errors, function (key, value) {
								var ErrorID = '#' + key + 'Error';
								$(ErrorID).removeClass('d-none');
								$(ErrorID).text(value);
							});
						}
					}
				});
			});
		});

		$('#input-phone').click(function(){
			$(this).removeClass('is-invalid');
			$('.error-phone').addClass('d-none');
		});
		$('#input-password').click(function(){
			$(this).removeClass('is-invalid');
			$('.error-password').addClass('d-none');
		});
	</script>

@endsection
