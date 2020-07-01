<?php

use Illuminate\Database\Seeder;

class cart extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cart')->insert([
            ['id_user'=>1,'id_product'=>1,'quantity'=>2],
            ['id_user'=>1,'id_product'=>16,'quantity'=>1],
        ]);
    }
}
