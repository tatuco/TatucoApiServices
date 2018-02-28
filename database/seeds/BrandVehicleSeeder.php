<?php

use Illuminate\Database\Seeder;

class BrandVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands_vehicles')->insert([
            'bra_des' => "Toyota",
            'use_nic' => 'sysadmin',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'bra_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('brands_vehicles')->insert([
            'bra_des' => "Nissan",
            'use_nic' => 'sysadmin',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'bra_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('brands_vehicles')->insert([
            'bra_des' => "Audi",
            'use_nic' => 'sysadmin',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'bra_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('brands_vehicles')->insert([
            'bra_des' => "Ford",
            'use_nic' => 'sysadmin',
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'bra_act'=> true,
            'acc_id'=> 1
        ]);
    }
}
