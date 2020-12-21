<?php

use Illuminate\Database\Seeder;

class Bonus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('bonus')->delete();
        DB::table('bonus')->insert([
            ['id' => 1, 'bonus' => 0],
        ]);
    }
}
