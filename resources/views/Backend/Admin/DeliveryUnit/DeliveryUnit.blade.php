@extends('Backend.Admin.Master.Master')
@section('title','Delivery Unit')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thông Tin Về Giao Nhận</h1>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
            
            </div>
            <!-- /.panel-heading -->
          
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Tên đơn vị giao nhận </th>
								<th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveryunit as $deliveryunit)
                                <tr>
                                    <td ><b>{{$deliveryunit->name}}</b></td>
                                        <td>
                                            @if($deliveryunit->status == 1)
                                                {{'active'}}
                                            @else
                                                {{'unActive'}}
                                            
                                            @endif
                                        </td>
                                        <td>
                                            @if ($deliveryunit->status == 1)
                                                <a href="{{ route('get.lock.ship',['id' => $deliveryunit->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-lock fa-fw"></i> Lock ship</a>
                                            @else
                                                <a href="{{ route('get.unlock.ship',['id' => $deliveryunit->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-unlock fa-fw"></i> Unlock ship</a>
                                            @endif
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