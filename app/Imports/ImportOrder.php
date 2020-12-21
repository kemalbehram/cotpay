<?php

namespace App\Imports;

use App\Models\Backend\Order\Order;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportOrder implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Order([
            'user_id'  => $row['user_id'],
            'user_id_receiver'  => $row['user_id_receiver'],
            'code_deal'  => $row['code_deal'],
            'sell_buy'  => $row['sell_buy'],
            'money_value'  => $row['money_value'],
            'cotpay_fee'  => $row['cotpay_fee'],
            'content'  => $row['content'],
            'wallet_id'  => $row['wallet_id'],
            'phone_receiver'  => $row['phone_receiver'],
            'name_user'  => $row['name_user'],
            'name_sender'  => $row['name_sender'],
            'name_receiver'  => $row['name_receiver'],
            'address_receiver'  => $row['address_receiver'],
            'city'  => $row['city'],
            'district'  => $row['district'],
            'ward'  => $row['ward'],
            'shipping_unit'  => $row['shipping_unit'],
            'wide'  => $row['wide'],
            'long'  => $row['long'],
            'height'  => $row['height'],
            'collection'  => $row['collection'],
            'service'  => $row['service'],
            'weight'  => $row['weight'],
            'ship_fee'  => $row['ship_fee'],
            'note'  => $row['note'],
            'status'  => $row['status'],
            'qty'  => $row['qty'],
            'created_at'  => $row['created_at'],
            'updated_at'  => $row['updated_at'],
        ]);
    }
}
