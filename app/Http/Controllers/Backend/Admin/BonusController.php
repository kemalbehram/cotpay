<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;

class BonusController extends Controller
{
    //Ví bonus
    public function getBonus() {
        $data['bonus'] = Wallet::all();
        return view('Backend.Admin.Bonus.Bonus', $data);
    }

}
