<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;
use App\Models\Backend\Admin\Admin;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('roles')->delete();
        DB::table('permissions')->delete();


        
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $user1 = Admin::find(1);
        $user2 = Admin::find(2);
        $user3 = Admin::find(3);
        $user4 = Admin::find(4);
        $user5 = Admin::find(5);
        $user6 = Admin::find(6);

        
        Permission::create(['guard_name' => 'admin', 'name' => 'C00']);// C0 xem tất cả giao dịch
        
        Permission::create(['guard_name' => 'admin', 'name' => 'C11']);// C11 xử lý tài khoản đối tác 
        Permission::create(['guard_name' => 'admin', 'name' => 'C12']);// C12 xử lý giao dịch nhỏ hơn 10tr 
        Permission::create(['guard_name' => 'admin', 'name' => 'C13']);// C13 xử lý giao dịch từ 10tr trở lên 
        Permission::create(['guard_name' => 'admin', 'name' => 'C14']);// C14 xử lý giao dịch doang nghiệp 
        Permission::create(['guard_name' => 'admin', 'name' => 'C15']);// C15 xử lý ví bonus 
        Permission::create(['guard_name' => 'admin', 'name' => 'C16']);// C16 xử lý hệ thống các ví 
        Permission::create(['guard_name' => 'admin', 'name' => 'C17']);// C17 xử lý tài chính 
        Permission::create(['guard_name' => 'admin', 'name' => 'C18']);// C18 xem tài khoản admin

        // Permission::create(['guard_name' => 'admin', 'name' => 'C21']);// C21 xử lý tài khoản đối tác khu vực miền nam
        // Permission::create(['guard_name' => 'admin', 'name' => 'C22']);// C22 xử lý giao dịch nhỏ hơn 10tr miền nam
        // Permission::create(['guard_name' => 'admin', 'name' => 'C23']);// C23 xử lý giao dịch từ 10tr trở lên miền nam
        // Permission::create(['guard_name' => 'admin', 'name' => 'C24']);// C24 xử lý tài khoản đối tác miền nam
        // Permission::create(['guard_name' => 'admin', 'name' => 'C25']);// C25 xử lý ví bonus miền nam
        // Permission::create(['guard_name' => 'admin', 'name' => 'C26']);// C26 xử lý hệ thống các ví miền nam

        // Permission::create(['guard_name' => 'admin', 'name' => 'C31']);// C31 xử lý tài khoản đối tác khu vực miền trung
        // Permission::create(['guard_name' => 'admin', 'name' => 'C32']);// C32 xử lý giao dịch nhỏ hơn 10tr miền trung
        // Permission::create(['guard_name' => 'admin', 'name' => 'C33']);// C33 xử lý giao dịch từ 10tr trở lên miền trung
        // Permission::create(['guard_name' => 'admin', 'name' => 'C34']);// C34 xử lý giao dịch doang nghiệp miền trung
        // Permission::create(['guard_name' => 'admin', 'name' => 'C35']);// C35 xử lý ví bonus miền trung
        // Permission::create(['guard_name' => 'admin', 'name' => 'C36']);// C36 xử lý hệ thống các ví miền trung



        // Permission::create(['guard_name' => 'admin', 'name' => 'C41']);// C41 Báo cáo tài chính


        $role1 = Role::create(['guard_name' => 'admin', 'name' => 'supper-admin']);
        $role1->givePermissionTo(Permission::all());

        $role2 = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        $role2->givePermissionTo('C00');

        
        $role3 = Role::create(['guard_name' => 'admin', 'name' => 'C1']);//nhóm quản lý miền bắc
        $role3->givePermissionTo('C11');
        $role3->givePermissionTo('C12');
  


        $role4 = Role::create(['guard_name' => 'admin', 'name' => 'C2']);//nhóm quản lý miền nam
        $role4->givePermissionTo('C13');
        $role4->givePermissionTo('C14');
        $role4->givePermissionTo('C15');
        // $role4->givePermissionTo('C16');
        // $role4->givePermissionTo('C23');
        // $role4->givePermissionTo('C24');
        // $role4->givePermissionTo('C25');
        // $role4->givePermissionTo('C26');


        $role5 = Role::create(['guard_name' => 'admin', 'name' => 'C3']);//nhóm quản lý miền trung
        $role5->givePermissionTo('C16');
        // $role5->givePermissionTo('C32');
        // $role5->givePermissionTo('C33');
        // $role5->givePermissionTo('C34');
        // $role5->givePermissionTo('C35');
        // $role5->givePermissionTo('C36');

        $role6 = Role::create(['guard_name' => 'admin', 'name' => 'C4']);//nhóm quản lý báo cáo tài chính
        $role6->givePermissionTo('C17');



        $user1->assignRole('supper-admin');

        $user2->assignRole('admin');

        $user3->assignRole('C1');

        $user4->assignRole('C2');

        $user5->assignRole('C3');

        $user6->assignRole('C4');



        

        



    }
}
