<?php

namespace App\Http\Controllers\Backend\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function getIndexCustomer()
    {
        return view('Backend.Customer.Index-Customer');
    }
}
