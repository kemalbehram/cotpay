@extends('Backend.Admin.Master.Master')
@section('title','List  Business')
@section('deal_business','active')
@section('in_deal','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách giao dịch doanh nghiệp</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            {{-- <div class="panel-heading">
                Danh sách liên hệ <a href="{{ route('list.processed.contact') }}">Đã xử lý</a>
            </div> --}}
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Mã giao dịch</th>
                                <th>Bán / Mua</th>
                                <th>Gía trị</th>
                                <th>Mã ví </th>
                                <th>Tên người gửi</th>
                                <th>Tên người nhận</th>
                                <th>Địa chỉ nhận</th>
                                <th>Link chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($business as $bs)
                           <tr>
                               
                                <td>{{ $bs->code_deal }}</td>
                                <td>
                                        @if($bs->sell_buy == 1) {{'Giao dịch bán'}}
                                        @elseif ($bs->sell_buy == 2){{'Giao dịch mua'}}
                                        @endif
                                </td>
                                <td>{{number_format( $bs->money_value) }}</td>
                                <td>{{ $bs->wallet_id }}</td>
                                <td>{{ $bs->name_sender }}</td>
                                <td>{{ $bs->name_receiver }}</td>
                                <td>{{ $bs->address_receiver }}</td>
                                <td><a href="{{route('list.detail',$bs->id)}}"  class="btn btn-sm btn-link">Chi tiết</a></td>
                                {{-- <td>
                                   <a href="{{ route('post.list.contact', ['id' => $ct->id]) }}" onclick="return confirm('Bạn có muốn xử lý không !')"  class="btn btn-sm btn-link" style="font-size: 18px;padding: 4px;border: 1px solid; color: white;background-color: #286090;border-radius: 5px" data-button-type="" class="btn btn-primary"> Xử lý</a>
                                </td> --}}
                            </tr>
                       @endforeach
                   </tbody>
               </table>
           </div>
       </div>
       <!-- /.panel-body -->
   </div>
   <!-- /.panel -->
</div>
<!-- /.col-lg-12 -->

@endsection