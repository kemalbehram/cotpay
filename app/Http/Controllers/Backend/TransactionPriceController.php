<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cities;
use App\User;

class TransactionPriceController extends Controller
{
     //tìm kiếm kh khi tạo đơn
     public function postSearchUser(request $request)
     {
         if($request->get('query'))
         {
             $query = $request->get('query');
             
             $data = User::where('code_user', 'LIKE', "$query")->first();
             if($data != null)
             {
                 $city_ward = Cities::where('code', $data->ward)->first();
                 $city_district = Cities::where('code', $data->district)->first();
                 $city_city = Cities::where('code', $data->city)->first();
                 return response()->json([
                     'data' => $data,
                     'city' =>$city_city,
                     'district' =>$city_district,
                     'ward' =>$city_ward
                 ], 200);
             }
             else 
             {
                 return response()->json(['danger' => 'Không tìm thấy khách hàng ']);
             }
             
        }
     }
 
     //tính phí cot
     public function postPriceCot(request $request)
     {
         $query = str_replace(',', '', $request->get('query'));
         // dd($query < 0);
         if($query <= 500000 && $query > 0)
         {
             $cot = 1000;
         }
         elseif($query > 500000 && $query <= 1000000) 
         {
             $cot = 2000;
         }
         elseif($query > 1000000 && $query <= 3000000)
         {
             $cot = 3000;
         }
         elseif($query > 3000000)
         {
             $cot = ($query*1)/100 ;
         }
         elseif($query < 0)
         {
             $cot = 'Giá trị giao dịch phải lớn hơn 0';
         }
         return response()->json([
             'cot' => $cot,
         ], 200);
     }
 
 
 
     //tính phí chuyển phát khi nhập trọng lượng
     public function postPriceShipFee(request $request)
     {
        $service = $request->get('service');
        $query = $request->get('query');
        if($service == 1)
         {
             if($query > 0 && $query <= 500)
             {
                 $ship_fee = 10000;
             }
             elseif($query > 500 && $query <= 1000)
             {
                 $ship_fee = 12000;
             }
             elseif($query > 1000 && $query <= 3000)
             {
                 $ship_fee = 15000;
             }
             elseif($query > 3000 && $query <= 5000)
             {
                 $ship_fee = 15000;
             }
             elseif($query > 5000 && $query <= 10000)
             {
                 $ship_fee = 17000;
             }
             elseif($query > 10000 && $query <= 15000)
             {
                 $ship_fee = 20000;
             }
             elseif($query > 15000 && $query <= 20000)
             {
                 $ship_fee = 22000;
             }
             elseif($query > 20000 && $query <= 25000)
             {
                 $ship_fee = 25000;
             }
             elseif($query > 25000 && $query <= 30000)
             {
                 $ship_fee = 25000;
             }
             elseif($query > 30000 && $query <= 35000)
             {
                 $ship_fee = 27000;
             }
             elseif($query > 35000 && $query <= 40000)
             {
                 $ship_fee = 30000;
             }
             elseif($query > 40000 && $query <= 45000)
             {
                 $ship_fee = 32000;
             }
             elseif($query > 45000 && $query <= 50000)
             {
                 $ship_fee = 35000;
             }
             elseif($query > 50000 && $query <= 55000)
             {
                 $ship_fee = 37000;
             }
             elseif($query > 55000 && $query <= 60000)
             {
                 $ship_fee = 40000;
             }
             elseif($query > 60000 && $query <= 65000)
             {
                 $ship_fee = 42000;
             }
             elseif($query > 65000 && $query <= 70000)
             {
                 $ship_fee = 45000;
             }
             elseif($query > 70000 && $query <= 75000)
             {
                 $ship_fee = 47000;
             }
             elseif($query > 75000 && $query <= 80000)
             {
                 $ship_fee = 50000;
             }
             elseif($query > 80000 && $query <= 85000)
             {
                 $ship_fee = 52000;
             }
             elseif($query > 85000 && $query <= 90000)
             {
                 $ship_fee = 55000;
             }
             elseif($query > 90000 && $query <= 95000)
             {
                 $ship_fee = 57000;
             }
             elseif($query > 95000 && $query <= 100000)
             {
                 $ship_fee = 60000;
             }
             elseif($query > 100000 && $query <= 105000)
             {
                 $ship_fee = 62000;
             }
             elseif($query > 105000 && $query <= 110000)
             {
                 $ship_fee = 65000;
             }
             elseif($query > 110000 && $query <= 115000)
             {
                 $ship_fee = 67000;
             }
             elseif($query > 115000 && $query <= 120000)
             {
                 $ship_fee = 70000;
             }
             elseif($query > 120000 && $query <= 125000)
             {
                 $ship_fee = 72000;
             }
             elseif($query > 125000)
             {
                 $ship_fee = $query*(6/10);
             }
 
         }
         elseif($service == 2)
         {
             if($query > 0 && $query <= 500)
             {
                 $ship_fee = 12000;
             }
             elseif($query > 500 && $query <= 1000)
             {
                 $ship_fee = 15000;
             }
             elseif($query > 1000 && $query <= 3000)
             {
                 $ship_fee = 17000;
             }
             elseif($query > 3000 && $query <= 5000)
             {
                 $ship_fee = 20000;
             }
             elseif($query > 5000 && $query <= 10000)
             {
                 $ship_fee = 22000;
             }
             elseif($query > 10000 && $query <= 15000)
             {
                 $ship_fee = 25000;
             }
             elseif($query > 15000 && $query <= 20000)
             {
                 $ship_fee = 27000;
             }
             elseif($query > 20000 && $query <= 25000)
             {
                 $ship_fee = 30000;
             }
             elseif($query > 25000 && $query <= 30000)
             {
                 $ship_fee = 32000;
             }
             elseif($query > 30000 && $query <= 35000)
             {
                 $ship_fee = 35000;
             }
             elseif($query > 35000 && $query <= 40000)
             {
                 $ship_fee = 37000;
             }
             elseif($query > 40000 && $query <= 45000)
             {
                 $ship_fee = 40000;
             }
             elseif($query > 45000 && $query <= 50000)
             {
                 $ship_fee = 42000;
             }
             elseif($query > 50000 && $query <= 55000)
             {
                 $ship_fee = 45000;
             }
             elseif($query > 55000 && $query <= 60000)
             {
                 $ship_fee = 47000;
             }
             elseif($query > 60000 && $query <= 65000)
             {
                 $ship_fee = 50000;
             }
             elseif($query > 65000 && $query <= 70000)
             {
                 $ship_fee = 52000;
             }
             elseif($query > 70000 && $query <= 75000)
             {
                 $ship_fee = 55000;
             }
             elseif($query > 75000 && $query <= 80000)
             {
                 $ship_fee = 57000;
             }
             elseif($query > 80000 && $query <= 85000)
             {
                 $ship_fee = 60000;
             }
             elseif($query > 85000 && $query <= 90000)
             {
                 $ship_fee = 62000;
             }
             elseif($query > 90000 && $query <= 95000)
             {
                 $ship_fee = 65000;
             }
             elseif($query > 95000 && $query <= 100000)
             {
                 $ship_fee = 67000;
             }
             elseif($query > 100000 && $query <= 105000)
             {
                 $ship_fee = 70000;
             }
             elseif($query > 105000 && $query <= 110000)
             {
                 $ship_fee = 72000;
             }
             elseif($query > 110000 && $query <= 115000)
             {
                 $ship_fee = 75000;
             }
             elseif($query > 115000 && $query <= 120000)
             {
                 $ship_fee = 77000;
             }
             elseif($query > 120000 && $query <= 125000)
             {
                 $ship_fee = 80000;
             }
             elseif($query > 125000)
             {
                 $ship_fee = $query*(9/10);
             }
 
         }
         
         elseif($service == 3)
         {
             if($query > 0 && $query <= 500)
             {
                 $ship_fee = 35000;
             }
             elseif($query > 500 && $query <= 1000)
             {
                 $ship_fee = 55000;
             }
             elseif($query > 1000 && $query <= 3000)
             {
                 $ship_fee = 75000;
             }
             elseif($query > 3000 && $query <= 5000)
             {
                 $ship_fee = 95000;
             }
             elseif($query > 5000 && $query <= 10000)
             {
                 $ship_fee = 115000;
             }
             elseif($query > 10000 && $query <= 15000)
             {
                 $ship_fee = 135000;
             }
             elseif($query > 15000 && $query <= 20000)
             {
                 $ship_fee = 155000;
             }
             elseif($query > 20000 && $query <= 25000)
             {
                 $ship_fee = 175000;
             }
             elseif($query > 25000 && $query <= 30000)
             {
                 $ship_fee = 195000;
             }
             elseif($query > 30000 && $query <= 35000)
             {
                 $ship_fee = 215000;
             }
             elseif($query > 35000 && $query <= 40000)
             {
                 $ship_fee = 235000;
             }
             elseif($query > 40000 && $query <= 45000)
             {
                 $ship_fee = 255000;
             }
             elseif($query > 45000 && $query <= 50000)
             {
                 $ship_fee = 275000;
             }
             elseif($query > 50000 && $query <= 55000)
             {
                 $ship_fee = 295000;
             }
             elseif($query > 55000 && $query <= 60000)
             {
                 $ship_fee = 315000;
             }
             elseif($query > 60000 && $query <= 65000)
             {
                 $ship_fee = 335000;
             }
             elseif($query > 65000 && $query <= 70000)
             {
                 $ship_fee = 355000;
             }
             elseif($query > 70000 && $query <= 75000)
             {
                 $ship_fee = 375000;
             }
             elseif($query > 75000 && $query <= 80000)
             {
                 $ship_fee = 395000;
             }
             elseif($query > 80000 && $query <= 85000)
             {
                 $ship_fee = 415000;
             }
             elseif($query > 85000 && $query <= 90000)
             {
                 $ship_fee = 435000;
             }
             elseif($query > 90000 && $query <= 95000)
             {
                 $ship_fee = 455000;
             }
             elseif($query > 95000 && $query <= 100000)
             {
                 $ship_fee = 475000;
             }
             elseif($query > 100000 && $query <= 105000)
             {
                 $ship_fee = 495000;
             }
             elseif($query > 105000 && $query <= 110000)
             {
                 $ship_fee = 515000;
             }
             elseif($query > 110000 && $query <= 115000)
             {
                 $ship_fee = 535000;
             }
             elseif($query > 115000 && $query <= 120000)
             {
                 $ship_fee = 555000;
             }
             elseif($query > 120000 && $query <= 125000)
             {
                 $ship_fee = 575000;
             }
             elseif($query > 125000)
             {
                 $ship_fee = $query*(3/2);
             }
         }

         return response()->json([
             'ship_fee' => $ship_fee,
         ], 200);
     }
 
 
 
 
 
     // tính phí khi chọn dịch vụ
     public function postPriceService(request $request)
     {
         $service = $request->get('service');
         $query = str_replace(',', '', $request->get('query'));
         
         if($service == 1)
         {
             if($query > 0 && $query <= 500)
             {
                 $ship_fee = 10000;
             }
             elseif($query > 500 && $query <= 1000)
             {
                 $ship_fee = 12000;
             }
             elseif($query > 1000 && $query <= 3000)
             {
                 $ship_fee = 15000;
             }
             elseif($query > 3000 && $query <= 5000)
             {
                 $ship_fee = 15000;
             }
             elseif($query > 5000 && $query <= 10000)
             {
                 $ship_fee = 17000;
             }
             elseif($query > 10000 && $query <= 15000)
             {
                 $ship_fee = 20000;
             }
             elseif($query > 15000 && $query <= 20000)
             {
                 $ship_fee = 22000;
             }
             elseif($query > 20000 && $query <= 25000)
             {
                 $ship_fee = 25000;
             }
             elseif($query > 25000 && $query <= 30000)
             {
                 $ship_fee = 25000;
             }
             elseif($query > 30000 && $query <= 35000)
             {
                 $ship_fee = 27000;
             }
             elseif($query > 35000 && $query <= 40000)
             {
                 $ship_fee = 30000;
             }
             elseif($query > 40000 && $query <= 45000)
             {
                 $ship_fee = 32000;
             }
             elseif($query > 45000 && $query <= 50000)
             {
                 $ship_fee = 35000;
             }
             elseif($query > 50000 && $query <= 55000)
             {
                 $ship_fee = 37000;
             }
             elseif($query > 55000 && $query <= 60000)
             {
                 $ship_fee = 40000;
             }
             elseif($query > 60000 && $query <= 65000)
             {
                 $ship_fee = 42000;
             }
             elseif($query > 65000 && $query <= 70000)
             {
                 $ship_fee = 45000;
             }
             elseif($query > 70000 && $query <= 75000)
             {
                 $ship_fee = 47000;
             }
             elseif($query > 75000 && $query <= 80000)
             {
                 $ship_fee = 50000;
             }
             elseif($query > 80000 && $query <= 85000)
             {
                 $ship_fee = 52000;
             }
             elseif($query > 85000 && $query <= 90000)
             {
                 $ship_fee = 55000;
             }
             elseif($query > 90000 && $query <= 95000)
             {
                 $ship_fee = 57000;
             }
             elseif($query > 95000 && $query <= 100000)
             {
                 $ship_fee = 60000;
             }
             elseif($query > 100000 && $query <= 105000)
             {
                 $ship_fee = 62000;
             }
             elseif($query > 105000 && $query <= 110000)
             {
                 $ship_fee = 65000;
             }
             elseif($query > 110000 && $query <= 115000)
             {
                 $ship_fee = 67000;
             }
             elseif($query > 115000 && $query <= 120000)
             {
                 $ship_fee = 70000;
             }
             elseif($query > 120000 && $query <= 125000)
             {
                 $ship_fee = 72000;
             }
             elseif($query > 125000)
             {
                 $ship_fee = $query*(6/10);
             }
 
         }
         elseif($service == 2)
         {
             if($query > 0 && $query <= 500)
             {
                 $ship_fee = 12000;
             }
             elseif($query > 500 && $query <= 1000)
             {
                 $ship_fee = 15000;
             }
             elseif($query > 1000 && $query <= 3000)
             {
                 $ship_fee = 17000;
             }
             elseif($query > 3000 && $query <= 5000)
             {
                 $ship_fee = 20000;
             }
             elseif($query > 5000 && $query <= 10000)
             {
                 $ship_fee = 22000;
             }
             elseif($query > 10000 && $query <= 15000)
             {
                 $ship_fee = 25000;
             }
             elseif($query > 15000 && $query <= 20000)
             {
                 $ship_fee = 27000;
             }
             elseif($query > 20000 && $query <= 25000)
             {
                 $ship_fee = 30000;
             }
             elseif($query > 25000 && $query <= 30000)
             {
                 $ship_fee = 32000;
             }
             elseif($query > 30000 && $query <= 35000)
             {
                 $ship_fee = 35000;
             }
             elseif($query > 35000 && $query <= 40000)
             {
                 $ship_fee = 37000;
             }
             elseif($query > 40000 && $query <= 45000)
             {
                 $ship_fee = 40000;
             }
             elseif($query > 45000 && $query <= 50000)
             {
                 $ship_fee = 42000;
             }
             elseif($query > 50000 && $query <= 55000)
             {
                 $ship_fee = 45000;
             }
             elseif($query > 55000 && $query <= 60000)
             {
                 $ship_fee = 47000;
             }
             elseif($query > 60000 && $query <= 65000)
             {
                 $ship_fee = 50000;
             }
             elseif($query > 65000 && $query <= 70000)
             {
                 $ship_fee = 52000;
             }
             elseif($query > 70000 && $query <= 75000)
             {
                 $ship_fee = 55000;
             }
             elseif($query > 75000 && $query <= 80000)
             {
                 $ship_fee = 57000;
             }
             elseif($query > 80000 && $query <= 85000)
             {
                 $ship_fee = 60000;
             }
             elseif($query > 85000 && $query <= 90000)
             {
                 $ship_fee = 62000;
             }
             elseif($query > 90000 && $query <= 95000)
             {
                 $ship_fee = 65000;
             }
             elseif($query > 95000 && $query <= 100000)
             {
                 $ship_fee = 67000;
             }
             elseif($query > 100000 && $query <= 105000)
             {
                 $ship_fee = 70000;
             }
             elseif($query > 105000 && $query <= 110000)
             {
                 $ship_fee = 72000;
             }
             elseif($query > 110000 && $query <= 115000)
             {
                 $ship_fee = 75000;
             }
             elseif($query > 115000 && $query <= 120000)
             {
                 $ship_fee = 77000;
             }
             elseif($query > 120000 && $query <= 125000)
             {
                 $ship_fee = 80000;
             }
             elseif($query > 125000)
             {
                 $ship_fee = $query*(9/10);
             }
 
         }
         
         elseif($service == 3)
         {
             if($query > 0 && $query <= 500)
             {
                 $ship_fee = 35000;
             }
             elseif($query > 500 && $query <= 1000)
             {
                 $ship_fee = 55000;
             }
             elseif($query > 1000 && $query <= 3000)
             {
                 $ship_fee = 75000;
             }
             elseif($query > 3000 && $query <= 5000)
             {
                 $ship_fee = 95000;
             }
             elseif($query > 5000 && $query <= 10000)
             {
                 $ship_fee = 115000;
             }
             elseif($query > 10000 && $query <= 15000)
             {
                 $ship_fee = 135000;
             }
             elseif($query > 15000 && $query <= 20000)
             {
                 $ship_fee = 155000;
             }
             elseif($query > 20000 && $query <= 25000)
             {
                 $ship_fee = 175000;
             }
             elseif($query > 25000 && $query <= 30000)
             {
                 $ship_fee = 195000;
             }
             elseif($query > 30000 && $query <= 35000)
             {
                 $ship_fee = 215000;
             }
             elseif($query > 35000 && $query <= 40000)
             {
                 $ship_fee = 235000;
             }
             elseif($query > 40000 && $query <= 45000)
             {
                 $ship_fee = 255000;
             }
             elseif($query > 45000 && $query <= 50000)
             {
                 $ship_fee = 275000;
             }
             elseif($query > 50000 && $query <= 55000)
             {
                 $ship_fee = 295000;
             }
             elseif($query > 55000 && $query <= 60000)
             {
                 $ship_fee = 315000;
             }
             elseif($query > 60000 && $query <= 65000)
             {
                 $ship_fee = 335000;
             }
             elseif($query > 65000 && $query <= 70000)
             {
                 $ship_fee = 355000;
             }
             elseif($query > 70000 && $query <= 75000)
             {
                 $ship_fee = 375000;
             }
             elseif($query > 75000 && $query <= 80000)
             {
                 $ship_fee = 395000;
             }
             elseif($query > 80000 && $query <= 85000)
             {
                 $ship_fee = 415000;
             }
             elseif($query > 85000 && $query <= 90000)
             {
                 $ship_fee = 435000;
             }
             elseif($query > 90000 && $query <= 95000)
             {
                 $ship_fee = 455000;
             }
             elseif($query > 95000 && $query <= 100000)
             {
                 $ship_fee = 475000;
             }
             elseif($query > 100000 && $query <= 105000)
             {
                 $ship_fee = 495000;
             }
             elseif($query > 105000 && $query <= 110000)
             {
                 $ship_fee = 515000;
             }
             elseif($query > 110000 && $query <= 115000)
             {
                 $ship_fee = 535000;
             }
             elseif($query > 115000 && $query <= 120000)
             {
                 $ship_fee = 555000;
             }
             elseif($query > 120000 && $query <= 125000)
             {
                 $ship_fee = 575000;
             }
             elseif($query > 125000)
             {
                 $ship_fee = $query*(3/2);
             }
         }
         return response()->json([
             'ship_fee' => $ship_fee,
         ], 200);
     }
 
}
