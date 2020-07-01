<?php

use Illuminate\Database\Seeder;

class category_news extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_news')->insert([
            ['news_name'=>'Chia sẻ','slug_name'=>'chia-se'],
            ['news_name'=>'Công nghệ','slug_name'=>'cong-nghe']
        ]);
    }
}
