@extends('Backend.Admin.Master.Master')
@section('title','List Processed')
@section('contact_process','active')
@section('inn','in')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Danh sách liên hệ đã xử lý</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách liên hệ <a href="{{ route('list.contact') }}">Chưa xử lý</a>
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
                                <th>Ngày xử lý</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($contact as $ct)
                           <tr>
                                <td>{{$ct->id }}</td>
                                <td>{{$ct->phone }}</td>
                                <td>{{$ct->question }}</td>
                                <td>{{$ct->updated_at }}</td>
                               
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