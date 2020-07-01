<?php

use Illuminate\Database\Seeder;

class comment_product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comment_product')->insert([
            ['id_product'=>1,'id_user'=>1,'comment'=>"Co mien phi van chuyen khong a ?",'created_at'=>'2020-06-18 04:08:45'],
            ['id_product'=>1,'id_user'=>2,'comment'=>"Co ship ngoai thanh khong ban ?",'created_at'=>'2020-06-18 04:08:45']
        ]);
    }
}
