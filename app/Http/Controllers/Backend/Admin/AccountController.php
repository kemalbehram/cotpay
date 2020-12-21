<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Backend\Admin\Admin;
use App\Models\Cities;
use App\Http\Requests\Backend\Admin\{CreateAdminAccountRequest, InfoAccountAdminRequest, EditAccountAdminRequest};
use App\User;
use DB;

class AccountController extends Controller
{
    //danh sách tài khoản customer
    public function getListAccountCustomer()
    {
        $data['customers'] = User::where('level', 1)->get();
        return view('Backend.Admin.Account.List_Customer', $data);
    }

      //danh sách tài khoản merchant
      public function getListAccountMerchant()
      {
          $data['merchants'] = User::where('level', 2)->get();
          return view('Backend.Admin.Account.List_Merchant', $data);
      }

        //danh sách tài khoản business
    public function getListAccountBusiness()
    {
        $data['business'] = User::where('level', 3)->get();
        return view('Backend.Admin.Account.List_Business', $data);
    }



    //danh sách tài khoản admin
   public function getListAccount()
   {
        $data['admins'] = Admin::all();
        return view('Backend.Admin.Account.List_Admin', $data);
   }

   //thêm tài khoản admin
   public function getAddAccountAdmin()
   {
       $data['roles'] = Role::all();
    //    $data['permissions'] = Permission::all();
       return view('Backend.Admin.Account.Add_Admin', $data);
   }
   public function postAddAccountAdmin(CreateAdminAccountRequest $request)
   {
       //dd($request->all());
       
       $admin = new Admin;
       $admin->name = $request->name;
       $admin->email = $request->email;
       $admin->phone = $request->phone;
       $admin->address = $request->address;
       $admin->city = $request->city;
       $admin->district = $request->district;
       $admin->ward = $request->ward;
       $admin->save();


       //$admin->roles()->Attach($request->roles);
       $admin->assignRole([$request->roles]);
    //    $admin->givePermissionTo($request->permissions);

       $password = Str::random(9);
       $admin->password = bcrypt($password);
       $admin->save();
       $email=$admin->email;
       $data=[
            // 'route' => $url,
            'name' => $admin->name,
            'password' =>$password,
            'email' => $email,
            'phone' => $admin->phone,
            'address' => $admin->address,
        ] ;
        Mail::send('Backend.Admin.Account.Email', $data, function($message) use ($email){
            $message->to($email, 'Welcome to cot-pay')->subject('Welcome to cot-pay !');
        });


      return redirect(route('list.account.admin'))->with('success', 'Tạo tài khoản thành công !')->withInput();

   }

   // sửa tài khoản admin
   public function getEditAccountAdmin($id)
   {
       $data['admin'] = Admin::find($id);
       $admin = Admin::find($id);
       $data['admin_has_role'] = DB::table('model_has_roles')->where('model_id',$id)->pluck('role_id');
      // $data['admin_has_permission'] = DB::table('model_has_permissions')->where('model_id',$id)->pluck('permission_id');
       $data['roles'] = Role::all();
      // dd($data);
       //$data['permissions'] = Permission::all();
       $data['city_ward'] = Cities::where('code', $admin->ward)->first();
       $data['city_district'] = Cities::where('code', $admin->district)->first();
       $data['city_city'] = Cities::where('code', $admin->city)->first();
       return view('Backend.Admin.Account.Edit_Admin', $data);
   }
   public function postEditAccountAdmin(EditAccountAdminRequest $request, $id)
   {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->city = $request->city;
        $admin->district = $request->district;
        $admin->ward = $request->ward;
        $admin->save();

        $admin->syncRoles([$request->roles]);
        
        return redirect(route('list.account.admin'))->with('success', 'Sửa tài khoản thành công !')->withInput();
   }





   //xóa tài khoản admin
   public function getDeleteAccountAdmin($id)
   {
       Admin::destroy($id);
       return redirect()->back()->with('success' ,'Delete account success')->withInput();
   }

   //khóa tài khoản người dùng
   public function getLockAccountUser($id)
   {
      $user = User::find($id);
      $user->lock = 2;
      $user->save();
      return redirect()->back()->with('success' ,'Lock account success')->withInput();
   }

    //mở khóa tài khoản người dùng
    public function getUnlockAccountUser($id)
    {
        $user = User::find($id);
        $user->lock = 1;
        $user->save();
        return redirect()->back()->with('success' ,'Unlock account success')->withInput();
    }



    //thông tin tài khoản admin
    public function getInfoAccountAdmin($id)
    {
       $data['admin'] = Admin::find($id);
       $admin = Admin::find($id);
       $data['city_ward'] = Cities::where('code', $admin->ward)->first();
       $data['city_district'] = Cities::where('code', $admin->district)->first();
       $data['city_city'] = Cities::where('code', $admin->city)->first();
       return view('Backend.Admin.Account.Info_Account',$data);
    }


    public function postInfoAccountAdmin(InfoAccountAdminRequest $request, $id)
    {
        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->city = $request->city;
        $admin->district = $request->district;
        $admin->ward = $request->ward;
        $admin->save();
        return redirect()->back()->with('success', 'Update account success')->withInput();
    }
}
