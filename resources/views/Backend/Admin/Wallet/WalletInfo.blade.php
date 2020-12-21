@extends('Backend.Admin.Master.Master')
@section('title','wallet')

@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Thông Tin Về Ví</h1>
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
                                <th>Tên ví </th>
								<th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Wallet as $Wallet)
                                <tr>
                                    <td ><b>{{$Wallet->name}}</b></td>
                                        <td>
                                            @if($Wallet->status == 1)
                                                {{'active'}}
                                            @else
                                                {{'unActive'}}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($Wallet->status == 1)
                                                <a href="{{ route('get.lock.wallet',['id' => $Wallet->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-lock fa-fw"></i> Lock Wallet</a>
                                            @else
                                                <a href="{{ route('get.unlock.wallet',['id' => $Wallet->id]) }}" class="btn btn-sm btn-link"><i class="fa fa-unlock fa-fw"></i> Unlock Wallet</a>
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