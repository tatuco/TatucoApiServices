<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'use_dni' => "12345678",
            'use_nam' => "sysadmin",
            'email' => 'sysadmin@zippyttech.com',
            'password' => bcrypt('123456'),
            'use_dac'=> new DateTime,
            'use_sta'=> true,
            'acc_id'=> 1
        ]);

        DB::table('users')->insert([
            'use_dni' => "12345679",
            'use_nam' => "admin",
            'email' => 'admin@zippyttech.com',
            'password' => bcrypt('123456'),
            'use_dac'=> new DateTime,
            'use_sta'=> true,
            'acc_id'=> 1
        ]);

        DB::table('users')->insert([
            'use_dni' => "12345670",
            'use_nam' => "operador",
            'email' => 'operador@zippyttech.com',
            'password' => bcrypt('123456'),
            'use_dac'=> new DateTime,
            'use_sta'=> true,
            'acc_id'=> 1
        ]);

          DB::table('users')->insert([
              'use_dni' => "12345671",
              'use_nam' => "guest",
              'email' => 'guest@zippyttech.com',
              'password' => bcrypt('123456'),
              'use_dac'=> new DateTime,
              'use_sta'=> true,
              'acc_id'=> 1
        ]);
    }
}
