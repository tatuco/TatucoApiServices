<?php

use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vehicles')->insert([
            'veh_pla' => 'AAA-123',
            'veh_com' => 30,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => 'sysadmin',
            'veh_des' => 'vehiculo 1',
            'tve_id' => 1,
            'fle_id' => 1,
            'mod_id' => 1,
            'sta_id' => 1,
            'veh_ass' => true,
            'veh_act' => true,
            'acc_id' => 1
        ]);

        DB::table('vehicles')->insert([
            'veh_pla' => 'BBB-123',
            'veh_com' => 20,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => 'sysadmin',
            'veh_des' => 'vehiculo 2',
            'tve_id' => 1,
            'fle_id' => 3,
            'mod_id' => 1,
            'sta_id' => 1,
            'veh_ass' => true,
            'veh_act' => true,
            'acc_id' => 1
        ]);

        DB::table('vehicles')->insert([
            'veh_pla' => 'CCC-123',
            'veh_com' => 10,
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => 'sysadmin',
            'veh_des' => 'vehiculo 3',
            'tve_id' => 1,
            'fle_id' => 3,
            'mod_id' => 3,
            'sta_id' => 1,
            'veh_ass' => true,
            'veh_act' => true,
            'acc_id' => 1
        ]);
    }
}
