<?php

use Illuminate\Database\Seeder;

class Admins extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->delete();
        DB::table('admins')->insert([
            ['id' => 1, 'name' => 'Nguyễn Văn Khánh', 'email' => 'khanh@gmail.com', 'phone' => '0987654321', 'password' => bcrypt('123456789'), 'address' => '18 trường chinh', 'image' => '','city'=>'64','district'=>'635','ward'=>'24022'],
            ['id' => 2, 'name' => 'Nguyễn Văn Quân', 'email' => 'quan@gmail.com', 'phone' => '0987654322', 'password' => bcrypt('123456789'), 'address' => '18 giáp bát', 'image' => '','city'=>'01','district'=>'269','ward'=>'09613'],
            ['id' => 3, 'name' => 'Nguyễn Quang Hà', 'email' => 'ha@gmail.com', 'phone' => '0987654323', 'password' => bcrypt('123456789'), 'address' => '18 láng hạ', 'image' => '','city'=>'01','district'=>'269','ward'=>'09610'],
            ['id' => 4, 'name' => 'Nguyễn Thị Yến', 'email' => 'yen@gmail.com', 'phone' => '0987654324', 'password' => bcrypt('123456789'), 'address' => '18 láng hạ', 'image' => '','city'=>'01','district'=>'269','ward'=>'09610'],
            ['id' => 5, 'name' => 'Phạm Văn Hiến', 'email' => 'hien@gmail.com', 'phone' => '0987654325', 'password' => bcrypt('123456789'), 'address' => '18 láng hạ', 'image' => '','city'=>'01','district'=>'269','ward'=>'09610'],
            ['id' => 6, 'name' => 'Nguyễn Thị Hải', 'email' => 'hai@gmail.com', 'phone' => '0987654326', 'password' => bcrypt('123456789'), 'address' => '18 láng hạ', 'image' => '','city'=>'01','district'=>'269','ward'=>'09610'],
        ]);
    }
}
