<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Backend\Order\Order;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ExportOrder implements FromView,ShouldAutoSize,WithHeadings
{
	use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public function __construct(string $_id, string $_start, string $_end, string $_sell_buy)
    {
        $this->id = $_id;
        $this->start_date = $_start;
        $this->end_date = $_end;
        $this->sell_buy = $_sell_buy;
    }

    public function view(): View
    {
    	$reverse = ($this->sell_buy == 1) ? 2 : 1;
    	$sell_buy = $this->sell_buy;
    	$start = $this->start_date;
    	$end = $this->end_date;
    	$id = $this->id;

        return view('Backend.Pages.ExportExcelExample', [
            'orders' => Order::where(function ($query) use ($sell_buy, $start, $end, $id) {
                $query->where('sell_buy', $sell_buy)->where('user_id', $id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end);
            })->orWhere(function ($query) use ($reverse, $start, $end, $id) {
                $query->where('sell_buy', $reverse)->where('user_id_receiver', $id)->whereDate('created_at','>=',$start)->whereDate('created_at','<=',$end);
            })->orderBy('id','desc')->get()
        ]);
    }

    public function headings(): array
    {
        return [
			'Mã đơn',
			'GT đơn',
			'Phí CotPay',
			'Hàng hóa',
			'Ví',
			'SĐT người nhận',
			'Tên Shop/Cty',
			'Người gửi',
			'Người nhận',
			'Địa chỉ người nhận',
			'Tỉnh/Thành phố',
			'Quận/Huyện',
			'Phường/Xã',
			'Đơn vị vẫn chuyển',
			'Thu hộ',
			'Dịch vụ',
			'Trọng lượng',
			'Phí ship',
			'Nội dung',
			'Trạng thái',
			'Số lượng',
			'Ngày tạo',
        ];
    }
}
