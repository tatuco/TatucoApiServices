<?php

use Illuminate\Database\Seeder;

class TypeVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('type_vehicles')->insert([
            'tve_des' => "De Carga",
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'tve_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('type_vehicles')->insert([
            'tve_des' => "Liviano",
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'tve_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('type_vehicles')->insert([
            'tve_des' => "De Viaje",
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'tve_act'=> true,
            'acc_id'=> 1
        ]);
    }
}
