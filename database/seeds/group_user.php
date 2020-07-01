<?php

use Illuminate\Database\Seeder;

class group_user extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('group_user')->insert([
            ['group_name'=>'normal'],
            ['group_name'=>'manager'],
            ['group_name'=>'admin']
        ]);
    }
}
