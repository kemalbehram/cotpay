@extends('Backend.Admin.Master.Master')
@section('title','Bonus')
@section('bonus','active')
@section('bonus_in','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Tổng tiền</h1>
    </div>
</div>
<div>
    
    Tổng tiền giao dịch: {{ number_format($bonus->bonus) }} <sup>đ</sup>
</div>
@endsection