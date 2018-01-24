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

        DB::table('roles')->insert([
            'name'=> 'root',
            'slug'=>'SYSADMIN',
            'description' => 'todos los permisos',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('role_user')->insert([
            'role_id'=> 1,
            'user_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('permissions')->insert([
            'name'=> 'all-access',
            'slug'=>'ALL-ACCESS',
            'description' => 'todos los permisos',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        DB::table('permission_role')->insert([
            'permission_id'=> 1,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
    }
}
