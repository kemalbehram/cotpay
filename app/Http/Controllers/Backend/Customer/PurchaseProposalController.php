<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use Illuminate\Support\Facades\Auth;

class PurchaseProposalController extends Controller
{

    public function getListProposal()
    {
        // lấy tháng hiện tại và lọc danh sách theo tháng
        $month = date('m');
        $data['orders'] = Order::where('user_id_receiver',Auth::user()->id)->where('status', 1)->whereMonth('created_at', $month)->orderBy('id','desc')->get();
        return view('Backend.Customer.Shopping_Proposal', $data);
        // dd($data['orders']);
    }
}
