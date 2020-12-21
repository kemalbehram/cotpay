<?php

use Illuminate\Database\Seeder;

class Wallet extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('wallet')->delete();
        DB::table('wallet')->insert([
            ['id' => 1, 'name' => 'Momo'],
            ['id' => 2, 'name' => 'Viettel Pay'],
            ['id' => 3, 'name' => 'Zalo Pay'],
            ['id' => 4, 'name' => 'VNPay'],
            ['id' => 5, 'name' => 'Bonus'],
        ]);

    }
}
