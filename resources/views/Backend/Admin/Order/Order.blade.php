@extends('Backend.Admin.Master.Master')
@section('title','Order')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Các đề nghị mua hàng </h1>
    </div>
</div>

<div>
    từ ngày: <input type="date" id="start-date" class="btn btn-default"> đến ngày <input type="date" id="end-date" class="btn btn-default"> <button id="fill" class="btn btn-default">Lọc</button>
</div>
<div class="row mt-5">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                DataTables Advanced Tables
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table style="font-size: 12px;" class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>STT</th>
								<th>Mã GD</th>
								<th>Người gửi</th>
								<th>Người nhận</th>
								<th>Hàng hóa</th>
								<th>Mua & bán</th>
								<th>GT đơn</th>
								<th>Phí Ship</th>
								<th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_order">
                            @foreach ($orders as $key =>$item)
							<tr>
								<td>{{ $key + 1 }}</td>
								<td style="color:#007a6e">
									<b>{{ $item->code_deal }}</b><br>
									<a style="font-size: 12px;" href="{{ route('order.detail',$item->id) }}">Xem chi tiết</a>
								</td>
								<td><b>{{ $item->name_sender }}</b></td>
								<td>
									<b>{{ $item->name_receiver }}</b><br>
									{{ $item->phone_receiver }}
								</td>
								<td>{{ $item->content }}</td>
								<td>{{ ($item->sell_buy == 1) ? 'Bán' : 'Mua' }}</td>

                                <td style="color:#007a6e">
                                    @if ($item->collection == 1)
                                        {{ number_format($item->money_value) }}
                                    @else
                                    {{ number_format($item->money_value + $item->ship_fee) }}
                                    @endif
                                    
                                    <sup>đ</sup></td>
                                <td style="color:#007a6e">{{ number_format($item->ship_fee) }}<sup>đ</sup></td>
                                <td>
                                    @if($item->status == 8)
                                        <a href="{{ route('admin.order.receive',$item->id) }}" class="btn btn-sm btn-link"><i class="fa fa-check"></i> Khách nhận đơn</a>
                                        <a href="{{ route('admin.order.boom',$item->id) }}" onclick="return confirm('Bạn muốn bom đơn hàng {{ $item->code_deal }}?')"  class="btn btn-sm btn-link" ><i class="fa fa-close"></i> Bom hàng</a>
                                        <a href="{{ route('admin.order.re_order',$item->id) }}" onclick="return confirm('Bạn muốn hoàn lại đơn hàng này?')"  class="btn btn-sm btn-link" ><i class="fa fa-refresh"></i> Hoàn đơn</a>
                                    @else
                                        <a href="{{ route('admin.order.delivery',$item->id) }}" class="btn btn-sm btn-link" ><i class="fa fa-truck "></i> Vận chuyển hàng</a>   
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
@section('script')
<script type="text/javascript">

    $('#fill').click(function () {
        var start = $('#start-date').val();
        var end = $('#end-date').val();
        if (start != "" && end != "") {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "{{ route('order.proposal.date') }}",
                data: {
                    start: start,
                    end: end,
                },
            }).done(function (data) {
                $('#tbody_proposal').html('');
                    $.each(data.orders, function (key, value) {
                        $('#tbody_proposal').append(  `<tr>
                            <td>${ key +1 }</td>
                            <td style="color:#007a6e">
                                <b>${ value.code_deal }</b><br>
                                <a style="font-size: 12px;" href="">Xem chi tiết</a>
                            </td>
                            <td><b>${ value.name_sender }</b></td>
                            <td>
                                <b>${ value.name_receiver }</b><br>
                                ${ value.phone_receiver }
                            </td>
                            <td>${ value.content }</td>
                            <td>${ moment(value.created_at).format('DD-MM-YYYY') }</td>
                            <td style="color:#007a6e">${ number_formats(value.money_value) }<sup>đ</sup></td>
                            <td style="color:#007a6e">${ number_formats(value.ship_fee  ) }<sup>đ</sup></td>
                            <td>
                                <a href="" class="btn btn-sm btn-link"><i class="fa fa-check"></i> Xác nhận </a>
                                <a href="" onclick="return confirm('Bạn muốn từ chối đơn hàng ${ value.code_deal } ?')"  class="btn btn-sm btn-link" data-button-type="delete"><i class="fa fa-close"></i> Delete</a>
                            </td>
                        </tr>`)
                        });
            }).fail(function (argument) {
                console.log(argument);
            })
        }        
    })

</script>
@endsection