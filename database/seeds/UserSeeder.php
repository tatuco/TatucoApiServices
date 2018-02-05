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
            'name' => "Tatuco",
            'email' => 'sysadmin@tatuco.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('users')->insert([
            'name' => "Admin",
            'email' => 'admin@tatuco.com',
            'password' => bcrypt('123456'),
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('roles')->insert([
            'name'=> 'sysadmin',
            'slug'=>'SYSADMIN',
            'description' => 'todos los permisos',
            'level' => 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('roles')->insert([
            'name'=> 'admin',
            'slug'=>'ADMIN',
            'description' => 'administrador del sistema',
            'level' => 2,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('role_user')->insert([
            'role_id'=> 1,
            'user_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('role_user')->insert([
            'role_id'=> 2,
            'user_id'=> 2,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
    }
}
