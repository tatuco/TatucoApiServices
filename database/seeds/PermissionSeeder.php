<?php
use Illuminate\Database\Seeder;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //permisos para user
        DB::table('permissions')->insert([
            'name'=> 'index user',
            'slug'=>'index.user',
            'description' => 'listar usuarios',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 1,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'update user',
            'slug'=>'update.user',
            'description' => 'actualizar usuario',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 2,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'show user',
            'slug'=>'show.user',
            'description' => 'mostrar un usuario',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 3,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'store user',
            'slug'=>'store.user',
            'description' => 'guardar un usuario',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 4,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'delete user',
            'slug'=>'delete.user',
            'description' => 'borrar usuario',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 5,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);


        //permisos para account
        DB::table('permissions')->insert([
            'name'=> 'index account',
            'slug'=>'index.account',
            'description' => 'listar account',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 6,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'update account',
            'slug'=>'update.account',
            'description' => 'actualizar account',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 7,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'show account',
            'slug'=>'show.account',
            'description' => 'mostrar un account',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 8,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'store account',
            'slug'=>'store.account',
            'description' => 'mostrar un account',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 9,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'delete account',
            'slug'=>'delete.account',
            'description' => 'borrar account',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 10,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);


        //permisos para status
        DB::table('permissions')->insert([
            'name'=> 'index status',
            'slug'=>'index.status',
            'description' => 'listar status',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 11,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'update status',
            'slug'=>'update.status',
            'description' => 'actualizar status',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 12,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'show status',
            'slug'=>'show.status',
            'description' => 'mostrar un status',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 13,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'store status',
            'slug'=>'store.status',
            'description' => 'guardar un status',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 14,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'delete status',
            'slug'=>'delete.status',
            'description' => 'borrar status',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 15,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);


        //permisos para driver
        DB::table('permissions')->insert([
            'name'=> 'index driver',
            'slug'=>'index.driver',
            'description' => 'listar driver',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 16,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'update driver',
            'slug'=>'update.driver',
            'description' => 'actualizar driver',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 17,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'show driver',
            'slug'=>'show.driver',
            'description' => 'mostrar un driver',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 18,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'store driver',
            'slug'=>'store.driver',
            'description' => 'guardar un driver',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 19,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'delete driver',
            'slug'=>'delete.driver',
            'description' => 'borrar driver',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 20,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);



        //permisos para brand_vehicle
        DB::table('permissions')->insert([
            'name'=> 'index brand_vehicle',
            'slug'=>'index.brand_vehicle',
            'description' => 'listar brand_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 21,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'update brand_vehicle',
            'slug'=>'update.brand_vehicle',
            'description' => 'actualizar brand_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 22,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'show brand_vehicle',
            'slug'=>'show.brand_vehicle',
            'description' => 'mostrar un brand_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 23,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'store brand_vehicle',
            'slug'=>'store.brand_vehicle',
            'description' => 'guardar un brand_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 24,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'delete brand_vehicle',
            'slug'=>'delete.brand_vehicle',
            'description' => 'borrar brand_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 25,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);


        //permisos para model_vehicle
        DB::table('permissions')->insert([
            'name'=> 'index model_vehicle',
            'slug'=>'index.model_vehicle',
            'description' => 'listar model_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 26,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'update model_vehicle',
            'slug'=>'update.model_vehicle',
            'description' => 'actualizar model_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 27,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'show model_vehicle',
            'slug'=>'show.model_vehicle',
            'description' => 'mostrar un model_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 28,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'store model_vehicle',
            'slug'=>'store.model_vehicle',
            'description' => 'guardar un model_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 29,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        //
        DB::table('permissions')->insert([
            'name'=> 'delete model_vehicle',
            'slug'=>'delete.model_vehicle',
            'description' => 'borrar model_vehicle',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 30,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);


        //permisos especiales
        //
        DB::table('permissions')->insert([
            'name'=> 'run backup',
            'slug'=>'run.backup',
            'description' => 'generar backup de la base de datos',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 31,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);

        //
        DB::table('permissions')->insert([
            'name'=> 'index.report',
            'slug'=>'index.report',
            'description' => 'ver los reportes',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
        DB::table('permission_role')->insert([
            'permission_id'=> 32,
            'role_id'=> 1,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime
        ]);
    }
}