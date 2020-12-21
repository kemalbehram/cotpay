<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Export Excel</title>
</head>
<body>
	<table>
	    <thead>
	        <tr>
	            <th>STT</th>
				<th>Mã GD</th>
				<th>Người gửi</th>
				<th>Người nhận</th>
				<th>Hàng hóa</th>
				<th>Trạng thái</th>
				<th>Ngày tạo</th>
				<th>GT đơn</th>
				<th>Phí COT</th>
				<th>Phí Ship</th>
	        </tr>
	    </thead>
	    <tbody>
			@foreach ($orders as $key =>$item)
			<tr>
				<td>{{ $key + 1 }}</td>
				<td>
					<b>{{ $item->code_deal }}</b><br>
				</td>
				<td><b>{{ $item->name_sender }}</b></td>
				<td>
					<b>{{ $item->name_receiver }}</b><br>
					{{ $item->phone_receiver }}
				</td>
				<td>{{ $item->content }}</td>
				<td>
					@switch($item->status)
					    @case(1)
					        {{ 'Đơn yêu cầu' }}<br>
					        @break
					    @case(2)
					        {{ 'Chờ lấy hàng' }}
					        @break
					    @case(3)
					        {{ 'Đã nhận' }}
					        @break
					    @case(4)
					        {{ 'Giao dịch hủy' }}
					        @break
					    @case(5)
					        {{ 'Nhận lại hàng' }}
					        @break
					    @case(6)
					        {{ 'Boom hàng' }}
					        @break
					    @case(7)
					        {{ 'Đã nhận lại đơn' }}
					        @break
					    @case(8)
					        {{ 'Đang vận chuyển'}}
					        @break
					    @case(10)
					        {{ 'Đã từ chối'}}
					        @break
					    @case(99)
					        {{ 'Thanh toán thành công' }}
					        @break
					@endswitch
				</td>
				<td>{{ $item->created_at }}</td>
				<td>{{ $item->money_value }}<sup>đ</sup></td>
				<td>{{ $item->cotpay_fee }}<sup>đ</sup>
				</td>
				<td>{{ $item->ship_fee }}<sup>đ</sup></td>
			</tr>
			@endforeach
	    </tbody>
	</table>
</body>
</html>