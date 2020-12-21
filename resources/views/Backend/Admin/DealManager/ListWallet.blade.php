@extends('Backend.Admin.Master.Master')
@section('title','List Wallet')
@section('deal_list_wallet','active')
@section('in_deal','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách liên hệ</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách liên hệ <a href="{{ route('list.processed.contact') }}">Đã xử lý</a>
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Số điện thoại</th>
                                <th>Câu hỏi</th>
                                <th>Ngày gửi</th>
                                <th>Thao tác</th>

                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($contact as $ct)
                           <tr>
                                <td>{{ $ct->id }}</td>
                                <td>{{ $ct->phone }}</td>
                                <td>{{ $ct->question }}</td>
                                <td>{{$ct->created_at }}</td>
                                <td>
                                   <a href="{{ route('post.list.contact', ['id' => $ct->id]) }}" onclick="return confirm('Bạn có muốn xử lý không !')"  class="btn btn-sm btn-link" style="font-size: 18px;padding: 4px;border: 1px solid; color: white;background-color: #286090;border-radius: 5px" data-button-type="" class="btn btn-primary"> Xử lý</a>
                                </td>
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
</div>
@endsection