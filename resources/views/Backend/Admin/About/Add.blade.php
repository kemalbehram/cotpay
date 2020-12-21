@extends('Backend.Admin.Master.Master')
@section('title','Manager account admin')
@section('account_admin','active')
@section('in_admin','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tạo tài khoản admin</h1>
    </div>
</div>
<div class="row">
    @if (session('danger'))
        <p>{{ session('danger') }}</p>
    @endif
    <form action="{{ route('post.add.account.admin') }}" method="POST">
        @csrf
    <div class="col-md-6">
        <div class="form-group">
            <label>Họ Tên</label>
            <input class="form-control @error('name') has-error @enderror" value="{{ old('name') }}" name="name" placeholder="Họ tên">
            @if($errors->has('name'))
            <div class="error-city">
                <p class="error-input">{{ $errors->first('name') }}</p>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Email</label>
            <input class="form-control @error('email') has-error @enderror" value="{{ old('email') }}" name="email" placeholder="email">
            @if($errors->has('email'))
            <div class="error-city">
                <p class="error-input">{{ $errors->first('email') }}</p>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Số điện thoại</label>
            <input class="form-control @error('phone') has-error @enderror" value="{{ old('phone') }}" name="phone" placeholder="Số điện thoại">
            @if($errors->has('phone'))
            <div class="error-city">
                <p class="error-input">{{ $errors->first('phone') }}</p>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Địa chỉ</label>
            <input class="form-control @error('address') has-error @enderror" value="{{ old('address') }}" name="address" placeholder="Enter text">
            @if($errors->has('address'))
            <div class="error-city">
                <p class="error-input">{{ $errors->first('address') }}</p>
            </div>
            @endif
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Chọn Tỉnh/Thành phố</label>
            <select class="form-control js-location @error('city') has-error @enderror" id="input-city"
                data-type="city" name="city">
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
        </div>
        <div class="form-group">
            <label>Chọn Quận/Huyện</label>
            <select class="form-control js-location @error('district') has-error @enderror" name="district"
                id="district" data-type="district">
                <option value="">Chọn Quận/Huyện</option>
            </select>
            @if($errors->has('district'))
            <div class="error-district">
                <p class="error-input">{{ $errors->first('district') }}</p>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Chọn Xã/Phường</label>
            <select class="form-control @error('ward') has-error @enderror" id="wards" name="ward" data-type="wards">
                <option value="">Chọn Xã/Phường</option>
            </select>
            @if($errors->has('ward'))
            <div class="error-ward">
                <p class="error-input">{{ $errors->first('ward') }}</p>
            </div>
            @endif
        </div>
        <div class="form-group">
            <label>Chọn Quyền</label>
            @if($errors->has('roles'))
            <div class="error-roles">
                <p class="error-input">{{ $errors->first('roles') }}</p>
            </div>
            @endif
            <div class="row">
                @foreach ($roles as $item)
                  <div class="col-sm-4">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"  name="roles[]" value="{{ $item->id }}"> {{ $item->name }}
                        </label>
                      </div>
                  </div>
                @endforeach
              </div>
        </div>
    </div>
    <div class="form-group" style="margin-left: 15px">
        <button type="submit" class="btn btn-primary">Đồng ý</button>
    </div>
    </form>
</div>
@endsection

