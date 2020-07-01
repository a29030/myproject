<?php

use Illuminate\Database\Seeder;

class order_detail extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order_detail')->insert([
            ['id_order'=>1,'id_product'=>1,'quantity'=>1]
        ]);
    }
}
