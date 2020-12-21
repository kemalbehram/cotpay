<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Backend\Admin\{AddRoleRequest, EditRoleRequest};
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;


use Illuminate\Support\Facades\Auth;


class PermissionController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['role:supper-admin']);
    // }
    //dánh sách vai trò
    public function getListRole()
    {
        // dd(Auth::guard('admin')->user()->getAllPermissions());
        $data['roles'] = Role::all();
        return view('Backend.Admin.Permission.List_Role', $data);
    }

    //thêm vai trò
    public function getAddRole()
    {
        $data['permissions'] = Permission::all();
        return view('Backend.Admin.Permission.Add_Role', $data);
    }
    public function postAddRole(AddRoleRequest $request)
    {
       $role = Role::create(['guard_name' => $request->guard, 'name' => $request->role]);
       $role->givePermissionTo([$request->permissions]);
        return redirect(route('get.list.role'))->with('success', 'Thêm vai trò thành công')->withInput();
    }

    //sửa vai trò
    public function getEditRole($id)
    {
        $data['role'] = Role::find($id);
        $data['permissions'] = Permission::all();
        $data['role_of_permission'] = DB::table('role_has_permissions')->where('role_id',$id)->pluck('permission_id');
        // dd($data);
        return view('Backend.Admin.Permission.Edit_Role', $data);
    }

    public function postEditRole(EditRoleRequest $request, $id)
    {
        $role = Role::find($id);
        $role->name = $request->role;
        $role->guard_name = $request->guard;
        $role->save();
        $role->syncPermissions([$request->permissions]);
        return redirect(route('get.list.role'))->with('success', 'Edit role succes');
    }

    //xóa vai trò
    public function deleteRole($id)
    {
        Role::destroy($id);
        return redirect()->back()->with('success', 'Delete role success')->withInput();
    }
}


