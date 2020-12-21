<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Admin\Bonus;

class IndexController extends Controller
{
    //trang chủ
    public function getIndex() {
        return view('Backend.Admin.Index');
    }

    //Ví bonus
    public function getBonus() {
        $data['bonus'] = Bonus::find(1);
     
        return view('Backend.Admin.Bonus.Bonus', $data);
    }


}
