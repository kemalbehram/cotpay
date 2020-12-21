<?php

use Illuminate\Database\Seeder;

class ShippingUnit extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shipping_unit')->delete();
        DB::table('shipping_unit')->insert([
            ['id' => 1, 'name' => 'Viettel Post'],
            ['id' => 2, 'name' => 'VN post'],
            ['id' => 3, 'name' => 'Giao hàng tiết kiệm'],
            ['id' => 4, 'name' => 'Giao hàng nhanh'],
        ]);
    }
}
