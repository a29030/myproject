<?php

use Illuminate\Database\Seeder;

class status_order extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status_order')->insert([
            ['status'=>'Đang chờ duyệt'],
            ['status'=>'Đã duyệt'],
            ['status'=>'Đang giao hàng'],
            ['status'=>'Đã giao hàng'],
            ['status'=>'Hủy đơn hàng']
        ]);
    }
}
