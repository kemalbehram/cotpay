<?php

use Illuminate\Database\Seeder;

class About extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('about')->delete();
        DB::table('about')->insert([
            ['id' => 1, 'name' => 'Vài điều về chúng tôi', 'content' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
            Ipsum has been the industrys standard dummy text ever since the 1500s, when an
            unknown printer took a galley of type and scrambled it to make a type specimen'],

            ['id' => 2, 'name' => 'Xã hội', 'content' => 'Contribute to implement the goal the cashless society of Government'],
            ['id' => 3, 'name' => 'Khách hàng', 'content' => 'Contribute to implement the goal the cashless society of Government'],
            ['id' => 4, 'name' => 'Doanh nghiệp', 'content' => 'Contribute to implement the goal the cashless society of Government'],
            ['id' => 5, 'name' => 'Đối tác', 'content' => 'Contribute to implement the goal the cashless society of Government'],
            ['id' => 6, 'name' => 'Chúng tôi đã hợp tác với', 'content' => 'Contribute to implement the implement the implement the implement the implement the implement the implement the implement the implement the implement the implement the implement the implement the implement the implement the goal the cashless society of Government'],

          
           
        ]);
    }
}
