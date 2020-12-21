<?php

namespace App\Imports;

use App\Models\Backend\Order\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportCreateOrder implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'sell_buy'  => $row['Mua&Bán'],
            'money_value'  => $row['GT đơn'],
            'cotpay_fee'  => $row['Phí CotPay'],
            'content'  => $row['Hàng hóa'],
            'wallet_id'  => $row['Ví'],
            'phone_receiver'  => $row['SĐT Người nhận'],
            'name_user'  => $row['Tên Shop/Cty'],
            'name_sender'  => $row['Người gửi'],
            'name_receiver'  => $row['Người nhận'],
            'address_receiver'  => $row['Địa chỉ người nhận'],
            'city'  => $row['Tỉnh/Thành phố'],
            'district'  => $row['Quận/Huyện'],
            'ward'  => $row['Phường/Xã'],
            'shipping_unit'  => $row['Đơn vị vẫn chuyển'],
            'note'  => $row['Nội dung'],
            'qty'  => $row['Số lượng'],
            'wide'  => $row['Dài'],
            'long'  => $row['Rộng'],
            'height'  => $row['Cao'],
            'collection'  => $row['Thu hộ'],
            'service'  => $row['Dịch vụ'],
            'weight'  => $row['Trọng lượng'],
            'ship_fee'  => $row['Phí ship'],
        ]);
    }

    public function headingRow(): int
    {
        return 2;
    }

    /*  Người vô tình cho ta hi vọng
                Ta đa tình tính đến chuyện trăm năm... */
}
