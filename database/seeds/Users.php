<?php

use Illuminate\Database\Seeder;

class Users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        DB::table('users')->insert([
            ['id' => 1, 'name_user' => 'Nguyễn văn Khang', 'code_tax' => '0', 'is_active' => 1, 'level' => 1, 'code_user' => '0987654321', 'name' => 'Nguyễn Văn Khang', 'email' => 'khang@gmail.com', 'phone' => '0987654321', 'password' => bcrypt('123456789'), 'address' => '18 phạm văn đồng', 'city'=>'64','district'=>'635','ward'=>'24022'],
            ['id' => 2, 'name_user' => 'Gia dụng shop', 'code_tax' => '1', 'is_active' => 1, 'level' => 2, 'code_user' => 'S123456', 'name' => 'Nguyễn Thị Chi', 'email' => 'chi@gmail.com', 'phone' => '0987654322', 'password' => bcrypt('123456789'), 'address' => '18 trúc bạch', 'city'=>'01','district'=>'269','ward'=>'09613'],
            ['id' => 3, 'name_user' => 'Công ty Gia Dụng', 'code_tax' => '0123456789', 'is_active' => 1, 'level' => 3, 'code_user' => 'B0123456789', 'name' => 'Nguyễn Quỳnh Vân', 'email' => 'van@gmail.com', 'phone' => '0987654323', 'password' => bcrypt('123456789'), 'address' => '18 cổ nhuế', 'city'=>'01','district'=>'269','ward'=>'09610'],
        ]);
    }
}
