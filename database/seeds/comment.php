<?php

use Illuminate\Database\Seeder;

class comment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment')->insert([
            ['id_news'=>1,'id_user'=>1,'content'=>"great post!!!!!!!!!!!!!!!!!!",'created_at'=>'2020-06-18 04:08:45']
        ]);
    }
}
