<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagementTransactionController extends Controller
{
    public function getManagementSell()
    {
        return view('Backend.Admin.Transaction.Management_Transaction_Sell');
    }
}
