<?php

namespace App\Http\Controllers\Backend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Admin\Bonus;

class PurchaseProposalController extends Controller
{
    public function getListProposal()
    {
        // lấy tháng hiện tại và lọc danh sách theo tháng
        $month = date('m');
        $data['orders'] = Order::all();
        // $data['orders'] = Order::where('user_id_receiver',Auth::user()->id)->where('status', 1)->whereMonth('created_at', $month)->orderBy('id','desc')->get();
        // $data['orders'] = Order::where('user_id_receiver',Auth::user()->id)->where('status', 1)->whereMonth('created_at', $month)->orderBy('id','desc')->get();
        return view('Backend.Business.Shopping_Proposal', $data);
        // dd($data['orders']);
    }
}
