@extends('Backend.Admin.Master.Master')
@section('title','Manager account admin')
{{-- @section('account_admin','active') --}}
{{-- @section('in_admin','in') --}}
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"> Danh mục sửa đổi About</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh mục sửa đổi 
            </div>
            <!-- /.panel-heading -->
          
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>  Danh mục sửa đổi </th>
								<th>Nội Dung</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($about as $item)
                                <tr>
                                    <td ><b>{{$item->name}}</b></td>
                                        <td>{{$item->content}}</td>
                                        <td>
                                            <a href="admin/about/edit/{{$item->id}}" class="btn btn-sm btn-link"><i class="fa fa-edit"></i> Edit</a>
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