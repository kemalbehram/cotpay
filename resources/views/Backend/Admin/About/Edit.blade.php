@extends('Backend.Admin.Master.Master')
@section('title','Manager account admin')
@section('account_admin','active')
@section('in_admin','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Sửa About</h1>
    </div>
</div>
<div class="row">
    @if (session('danger'))
        <p>{{ session('danger') }}</p>
    @endif
    <form  method="POST">
        @csrf
       
    <div class="col-md-6">
        <label>Tên</label>
        <input class="form-control" name="name"  value="{{$about->name}}"/>
        @if($errors->has('name'))
        <div class="alert alert-danger" role="alert">
            <strong>{{$errors->first('name')}}  </strong>
        </div>
        @endif
        <div class="form-group">
            <label>Nội Dung Bài Viết</label>
            <textarea name="content" class="form-control" rows="10">{{$about->content}}</textarea>
            @if($errors->has('content'))
            <div class="alert alert-danger" role="alert">
                <strong>{{$errors->first('content')}}  </strong>
            </div>
            @endif
        </div>
        <div class="form-group" style="margin-left: 15px">
            <button type="submit" class="btn btn-primary">Đồng ý</button>
        </div>
       
    </div>
   
    </form>
</div>
@endsection

