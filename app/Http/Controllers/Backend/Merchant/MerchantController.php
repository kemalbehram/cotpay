<?php

namespace App\Http\Controllers\Backend\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MerchantController extends Controller
{
    public function getIndexMerchant()
    {
        return view('Backend.Merchant.Index-Merchant');
    }
}
