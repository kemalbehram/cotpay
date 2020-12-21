<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\About;

class AboutController extends Controller
{
    function show() {
        $data['about']=About::find(1);
        $data['about2']=About::skip(1)->limit(4)->get();
        $data['about6']=About::find(6);
        return view('Frontend.Pages.About',$data);
    }
}
