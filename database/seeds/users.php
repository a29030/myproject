<?php

use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['email'=>'admin@gmail.com','password'=>bcrypt('123456'),'fullname'=>'Nguyễn A','phone'=>'0989999999','address'=>'Việt Nam','id_group'=>3,'username'=>'admin','code_change_password'=>'abc'],
            ['email'=>'thuong@gmail.com','password'=>bcrypt('123456'),'fullname'=>'Nguyễn B','phone'=>'0989999999','address'=>'Việt Nam','id_group'=>1,'username'=>'thuong','code_change_password'=>'def']
        ]);
    }
}
