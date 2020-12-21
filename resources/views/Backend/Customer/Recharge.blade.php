@extends('Backend.Master.Master')
@section('title','Recharge')
@section('recharge','active')
@section('content')
<!--main-->
<div class="row">
    <div class="col-lg-12">
		<h5 class="page-headers">
            <a href="{{ route('merchant.index') }}">Trang chủ</a> >> Nạp tiền
        </h5>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <div class="col-xs-12 col-md-12 col-lg-12">
		<div class="menu-label-span ml-3" style="margin-bottom:20px">
		
			<span>{{ Auth::user()->code_user }}</span>
            <span>{{ Auth::user()->name_user }}</span>
            <span>5%</span>
            <span><i class="fa fa-star"></i> 4.86</span>
			<span>Bonus: {{ number_format(Auth::user()->money_bonus) }} VNĐ</span>
			
		</div>
		<form action="{{ route('post.merchant.recharge') }}" method="POST">
			@csrf
		<div class="col-md-12">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Nhập tiền:</label>
					@if (session('success'))
						<p>{{ session('success') }}</p>
					@endif
					<input class="form-control @error('money') is-invalid @enderror" name="money" type="text" >
					@error('money')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
				</div>
			</div>
			{{-- <div class="col-md-3">
				<div class="form-group">
					<label for="">Chọn ví:</label>
					<select class="form-control" id="sel1">
						<option>Bonus</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
					  </select>
				</div>
			</div> --}}
		</div>
		<button type="submit" class="btn btn-primary" style="margin-left: 30px;">Nạp tiền</button>
		</form>
	</div>
	
</div>

<!--end main-->

@endsection
