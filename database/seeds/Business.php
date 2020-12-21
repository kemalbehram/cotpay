<?php

use Illuminate\Database\Seeder;

class Business extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('business')->delete();
        DB::table('business')->insert([
            ['id' => 1, 'is_active' => 1, 'code_business' => 'B12345678', 'name_company' => 'Công ty TNHH Hà An', 'name_represent' => 'Nguyễn Thị Nhung', 'email' => 'nhung@gmail.com', 'password' => bcrypt('123456789'), 'phone' => '0987654321' ,'tax_code' => '123456789', 'address' => '11 xuân đỉnh', 'image' => '','city'=>'Hà Nội','district'=>'Cầu Giấy','ward'=>'Nghĩa Tân'],
            ['id' => 2, 'is_active' => 1, 'code_business' => 'B12345679', 'name_company' => 'Công ty TNHH Hà Ân', 'name_represent' => 'Nguyễn Thị An', 'email' => 'an@gmail.com', 'password' => bcrypt('123456789'), 'phone' => '0987654322' ,'tax_code' => '123456788', 'address' => '11 xuân la', 'image' => '','city'=>'Hà Nội','district'=>'Cầu Giấy','ward'=>'Nghĩa Tân' ],
           
        ]);
    }
}
