@extends('Backend.Admin.Master.Master')
@section('title')
Info Account
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Profile Admin </h1>
    </div>
</div>
<div class="row" style="margin-top: 15px;">
    <form action="" method="POST">
        @csrf
        <div class="col-xs-6 col-md-6 col-lg-6">
            <div class="main-menu">
                <div class="form-group">
                    <label>Họ tên:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Họ tên" name="name" value="{{ $admin->name }}">
                </div>
                <div class="form-group">
                    <label for="password">Email:</label>
                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="E-mail" name="email" value="{{ $admin->email }}">
                </div>
                <div class="form-group">
                    <label for="passwordConfirmation">Điện thoại:</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                        placeholder="Phone" name="phone" value="{{ $admin->phone }}">
                </div>
            </div>
        </div>
        <div class="col-xs-6 col-md-6 col-lg-6">
            <div class="main-menu">
                <div class="form-group">
                    <label>Địa chỉ:</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                        placeholder="Địa chỉ" name="address" value="{{ $admin->address }}">
                </div>
                <div class="form-group">
                    <label>Chọn Tỉnh/Thành phố</label>
                    <select class="form-control js-location @error('city') has-error @enderror" id="input-city"
                        data-type="city" name="city">
                        <option value="{{ $city_city->code }}">{{ $city_city->name }}</option>
                        @foreach($cities as $city)
                        <option value="{{$city->code}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                    @if($errors->has('city'))
                    <div class="error-city">
                        <p class="error-input">{{ $errors->first('city') }}</p>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Chọn Quận/Huyện</label>
                    <select class="form-control js-location @error('district') has-error @enderror" name="district"
                        id="district" data-type="district">
                        <option value="{{ $city_district->code }}">{{ $city_district->name }}</option>
                    </select>
                    @if($errors->has('district'))
                    <div class="error-district">
                        <p class="error-input">{{ $errors->first('district') }}</p>
                    </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Chọn Xã/Phường</label>
                    <select class="form-control @error('ward') has-error @enderror" id="wards" name="ward"
                        data-type="wards">
                        <option value="{{ $city_ward->code }}">{{ $city_ward->name }}</option>
                    </select>
                    @if($errors->has('ward'))
                    <div class="error-ward">
                        <p class="error-input">{{ $errors->first('ward') }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

</div>
<button type="submit" class="btn btn-primary">Xác nhận</button>
</form>
@endsection