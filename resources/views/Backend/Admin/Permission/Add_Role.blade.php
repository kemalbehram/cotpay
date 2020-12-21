@extends('Backend.Admin.Master.Master')
@section('title','Add Role')
@section('role','active')
@section('in_role','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thêm vai trò</h1>
    </div>
</div>
<div class="row">
  <form action="" method="POST">
    @csrf
    <div class="col-md-6">
       <div  class="form-group">
            <label for="">Tên <span style="color:red">*</span></label>
            <input class="form-control @error('role') has-error @enderror" value="{{ old('role') }}" name="role" type="text">
            @if($errors->has('role'))
            <div class="error-role">
                <p class="error-input">{{ $errors->first('role') }}</p>
            </div>
            @endif
       </div>

        <div class="form-group">
            <label for="">Guard Type</label>
            <select class="form-control" name="guard" id="">
                <option value="admin">admin</option>
                <option value="web">web</option>
                <option value="api">api</option>
            </select>
        </div>

        <label for="">Quyền hạn <span style="color:red">*</span></label>
        @if($errors->has('permissions'))
          <div class="error-permissions">
              <p class="error-input">{{ $errors->first('permissions') }}</p>
          </div>
        @endif
        <div class="row">
          @foreach ($permissions as $item)
            <div class="col-sm-4">
                <div class="checkbox">
                  <label>
                    <input type="checkbox" name="permissions[]"  value="{{ $item->id }}"> {{ $item->name }}
                  </label>
                </div>
            </div>
          @endforeach
        </div>
        <button type="submit" class="btn btn-primary">Lưu lại</button>
    </div>
    <div class="col-md-6">
      <h3>Tên quyền</h3>
      
      <p>C00 xem tất cả giao dịch</p>
      <p>C11 xử lý tài khoản đối tác </p>
      <p>C12 xử lý giao dịch nhỏ hơn 10tr </p>
      <p>C13 xử lý giao dịch từ 10tr trở lên </p>
      <p>C14 xử lý giao dịch doang nghiệp </p>
      <p>C15 xử lý ví bonus </p>
      <p>C16 xử lý hệ thống các ví </p>
      <p>C17 Báo cáo tài chính</p>
      <p>C18 Xem tài khoản admin</p>
      
    </div>
  </form>
</div>
@endsection