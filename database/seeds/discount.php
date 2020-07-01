<?php

use Illuminate\Database\Seeder;

class discount extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discount')->insert([
            ['code'=>'abc','sale_percent'=>50],
            ['code'=>'xyz','sale_percent'=>30]
        ]);
    }
}
