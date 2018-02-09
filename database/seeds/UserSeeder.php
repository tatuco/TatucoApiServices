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
            'name' => "jaime",
            'email' => 'parraj@zippyttech.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('users')->insert([
            'name' => "Admin",
            'email' => 'sysadmin@zippyttech.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

    }
}
