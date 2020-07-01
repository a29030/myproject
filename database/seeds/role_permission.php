<?php

use Illuminate\Database\Seeder;

class role_permission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('role_permission')->insert([
            ['id_group'=>'2','id_permission'=>'1'],
            ['id_group'=>'2','id_permission'=>'2'],
            ['id_group'=>'2','id_permission'=>'3'],
            ['id_group'=>'2','id_permission'=>'5'],
            ['id_group'=>'3','id_permission'=>'1'],
            ['id_group'=>'3','id_permission'=>'2'],
            ['id_group'=>'3','id_permission'=>'3'],
            ['id_group'=>'3','id_permission'=>'4'],
            ['id_group'=>'3','id_permission'=>'5'],
            ['id_group'=>'3','id_permission'=>'6'],
            ['id_group'=>'3','id_permission'=>'7']
        ]);
    }
}
