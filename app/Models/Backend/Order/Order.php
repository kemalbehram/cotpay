<?php

namespace App\Models\Backend\Order;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id',
		'user_id',
		'user_id_receiver',
		'code_deal',
		'sell_buy',
		'money_value',
		'cotpay_fee',
		'content',
		'wallet_id',
		'phone_receiver',
		'name_user',
		'name_sender',
		'name_receiver',
		'address_receiver',
		'city',
		'district',
		'ward',
		'shipping_unit',
		'wide',
		'long',
		'height',
		'collection',
		'service',
		'weight',
		'ship_fee',
		'note',
		'status',
		'qty',
		'created_at',
		'updated_at',
    ];
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
