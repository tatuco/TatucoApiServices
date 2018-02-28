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
            'use_nic' => 'sysadmin',
            'email' => 'sysadmin@zippyttech.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('users')->insert([
            'use_dni' => "12345679",
            'use_nam' => "admin",
            'use_nic' => 'admin',
            'email' => 'admin@zippyttech.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('users')->insert([
            'use_dni' => "12345670",
            'use_nam' => "operador",
            'use_nic' => 'operador',
            'email' => 'operador@zippyttech.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_act'=> true,
            'acc_id'=> 1
        ]);

          DB::table('users')->insert([
              'use_dni' => "12345671",
              'use_nam' => "guest",
              'use_nic' => 'guest',
              'email' => 'guest@zippyttech.com',
              'password' => bcrypt('123456'),
              'created_at'=> new DateTime,
              'updated_at'=> new DateTime,
              'use_act'=> true,
              'acc_id'=> 1
        ]);

        DB::table('users')->insert([
            'use_dni' => "12345676",
            'use_nam' => "guest",
            'use_nic' => 'guest1',
            'email' => 'guest1@zippyttech.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_act'=> true,
            'acc_id'=> 2
        ]);
    }
}
