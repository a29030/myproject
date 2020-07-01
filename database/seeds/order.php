<?php

use Illuminate\Database\Seeder;

class order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('order')->insert([
            ['fullname'=>'John Smith','email'=>'admin@gmail.com','phone'=>'0999999999','address'=>'Ha Noi','totalpay'=>250000,'sale_percent'=>0,'id_status'=>1,'id_user'=>1,'created_at'=>'2020-06-18 04:08:45']
        ]);
    }
}
