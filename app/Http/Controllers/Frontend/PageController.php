<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Merchant\StoreMerchantAccountRequest;
use App\Http\Requests\Backend\Business\StoreBusinessAccountRequest;
use App\Http\Requests\Backend\Customer\StroreCustomerAccountRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\User;
use App\Models\Backend\Contact\Contact;
use App\Http\Requests\Backend\Contact\ContactRequest;
use Carbon\Carbon;
use App\Models\Backend\Order\Order;


class PageController extends Controller
{
    public function index()
    {
         
        $data = Order::all();
        return view('Frontend.Pages.Home',compact('data'));
    }
    
    public function getAccountSteps()
    {
        return view('Frontend.Pages.Create_Account_Steps');
    }

     // Tạo tài khoản merchant
     public function getMerchantAccount()
     {
         
         return view('Frontend.Merchant.Create_Account_Merchant');
     }


    public function postMerchantAccount(StoreMerchantAccountRequest $request)
    {
        $merchant = new User;
        $merchant->name = $request->name;
        $merchant->email = $request->email;
        $merchant->name_user = $request->name_merchant;
        $merchant->code_user = 'S' . mt_rand(1000000, 9999999);
        $merchant->phone = $request->phone;
        $merchant->password = bcrypt($request->password);
        $merchant->address = $request->address;
        $merchant->city = $request->city;
        $merchant->district = $request->district;
        $merchant->ward = $request->ward;
        $merchant->level = 2;
        $merchant->lock = 1;
        $merchant->save();

        //gửi mail xác nhận
        $email = $merchant->email;
        $code = bcrypt(time().$email);
        $url = route('get.verify.account',['id'=>$merchant->id,'code'=>$code]);
        $merchant->code =$code;
        $merchant->time_code =Carbon::now();
        $merchant->save();
        $data=[
            'route' => $url,
        ] ;

        Mail::send('Frontend.Pages.Verify_Account', $data, function($message) use ($email){
            $message->to($email, 'Verify Account')->subject('Link Verify Account !');
        });
        return redirect('login')->with('success','Registration successful please login email to confirm your account !')->withInput();

    }




    // Tạo tài khoản customer
    public function getCustomerAccount()
    {
        return view('Frontend.Customer.Create_Account_Customer');
    }
    public function postCustomerAccount(StroreCustomerAccountRequest $request)
    {
        //dd($request->all());
        $customer = new User;
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->phone = $request->phone;
        $customer->password = bcrypt($request->password);
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->district = $request->district;
        $customer->ward = $request->ward;
        $customer->code_user = $request->phone;
        $customer->level = 1;
        $customer->lock = 1;
        $customer->save();


        //gửi mail xác nhận
        $email = $customer->email;
        $code = bcrypt(time().$email);
        $url = route('get.verify.account',['id'=>$customer->id,'code'=>$code]);
        $customer->code =$code;
        $customer->time_code =Carbon::now();
        $customer->save();
        $data=[
            'route' => $url,
        ] ;

        Mail::send('Frontend.Pages.Verify_Account', $data, function($message) use ($email){
            $message->to($email, 'Verify Account')->subject('Link Verify Account !');
        });
        return redirect('login')->with('success','Registration successful please login email to confirm your account !')->withInput();

    }




   


   // Tạo tài khoản business
    public function getBusinessAccount()
    {
        return view('Frontend.Business.Create_Account_Business');
    }


    public function postBusinessAccount(StoreBusinessAccountRequest $request)
    {
        // dd($request->all());
        $business = new User;
        $business->name_user = $request->name_business;
        $business->name = $request->name;
        $business->code_tax = $request->code_tax;
        $business->email = $request->email;
        $business->code_user = 'B' . $request->code_tax;
        $business->phone = $request->phone;
        $business->password = bcrypt($request->password);
        $business->address = $request->address;
        $business->city = $request->city;
        $business->district = $request->district;
        $business->ward = $request->ward;
        $business->level = 3;
        $business->lock = 1;
        $business->save();

        //gửi mail xác nhận
        $email = $business->email;
        $code = bcrypt(time().$email);
        $url = route('get.verify.account',['id'=>$business->id,'code'=>$code]);
        $business->code =$code;
        $business->time_code =Carbon::now();
        $business->save();
        $data=[
            'route' => $url,
        ] ;
        Mail::send('Frontend.Pages.Verify_Account', $data, function($message) use ($email){
            $message->to($email, 'Verify Account')->subject('Link Verify Account !');
        });

        return redirect('login')->with('success','Registration successful please login email to confirm your account !')->withInput();
    }

    public function getContact(){
        $contact = Contact::all();
        return view('Frontend.Pages.Contact',compact('contact'));
    }
    public function postContact(ContactRequest $req){
        $contact = new Contact;
        $contact->phone = $req->phone;
        $contact->question = $req->question;
        $contact->status = 1;
        $contact->save();
        return redirect()->back()->with('thongbao','Gửi thành công');
    }



    // load quan huyen
    public function getLocation(Request $request)
    {
        $parentID = $request->parent;
        if ($parentID) {
            $location = DB::table('city')->where('parent_id', $parentID)->get();

            return response(['data' => $location]);
        }
    }
    
    public function search(Request $request){
        $code = $request->content;
        if ($code == '') {
            return;
        }
        $search = Order::select('code_deal', 'code_bill', 'name_sender', 'name_receiver', 'phone_receiver', 'address_receiver', 'weight')->where('code_deal', 'like', '%'.$code.'%')->orWhere('code_bill', 'like', '%'.$code.'%')->get();
        return $search;
    }
   
}
