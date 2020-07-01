<?php

use Illuminate\Database\Seeder;

class permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission')->insert([
            ['permission'=>'addproduct'],
            ['permission'=>'showproduct'],
            ['permission'=>'editproduct'],
            ['permission'=>'deleteproduct'],
            ['permission'=>'showlistuser'],
            ['permission'=>'edituser'],
            ['permission'=>'deleteuser']
        ]);
    }
}
