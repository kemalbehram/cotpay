<?php

namespace App\Http\Controllers\Backend\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function getIndexBusiness()
    {
        return view('Backend.Business.Index-Business');
    }
}
