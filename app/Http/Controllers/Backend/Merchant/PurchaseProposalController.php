<?php

namespace App\Http\Controllers\Backend\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Order\Order;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Backend\Admin\Bonus;
use Illuminate\Support\Facades\Mail;

class PurchaseProposalController extends Controller
{
    public function getListProposal()
    {
        // lấy tháng hiện tại và lọc danh sách theo tháng
        $month = date('m');

        $data['orders'] = Order::where('user_id_receiver',Auth::user()->id)->where('status', 1)->whereMonth('created_at', $month)->orderBy('id','desc')->get();

        return view('Backend.Merchant.Shopping_Proposal', $data);
    }
}
