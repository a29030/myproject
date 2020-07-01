<?php

use Illuminate\Database\Seeder;

class category_product extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_product')->insert([
            ['category_name'=>'Cloud','slug_name'=>'cloud'],
            ['category_name'=>'Ảo hóa','slug_name'=>'ao-hoa'],
            ['category_name'=>'Hệ thống','slug_name'=>'he-thong'],
            ['category_name'=>'Cơ sở dữ liệu','slug_name'=>'co-so-du-lieu'],
            ['category_name'=>'Bảo mật','slug_name'=>'bao-mat'],
            ['category_name'=>'Giải pháp','slug_name'=>'giai-phap'],
            ['category_name'=>'Lập trình','slug_name'=>'lap-trinh'],
            ['category_name'=>'Đồ họa','slug_name'=>'do-hoa'],
            ['category_name'=>'Dịch vụ','slug_name'=>'dich-vu'],
            ['category_name'=>'Văn phòng','slug_name'=>'van-phong'],
            ['category_name'=>'Giáo dục','slug_name'=>'giao-duc']
        ]);
    }
}
