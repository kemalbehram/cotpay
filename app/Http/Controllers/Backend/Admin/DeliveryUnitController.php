<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingUnit;

class DeliveryUnitController extends Controller
{
    //GET Delivery Unit
    public function getDeliveryUnit() {
        $data['deliveryunit'] = ShippingUnit::all();
        return view('Backend.Admin.DeliveryUnit.DeliveryUnit', $data);
    }
    public function getLockShip($id)
   {
      $delivery = ShippingUnit::find($id);
      $delivery->status = 2;
      $delivery->save();
      return redirect()->back()->with('success' ,'Lock delivery success')->withInput();
   }

    //mở khóa tài khoản người dùng
    public function getUnlockShip($id)
    {
        $delivery = ShippingUnit::find($id);
        $delivery->status = 1;
        $delivery->save();
        return redirect()->back()->with('success' ,'Unlock delivery success')->withInput();
    }


}
