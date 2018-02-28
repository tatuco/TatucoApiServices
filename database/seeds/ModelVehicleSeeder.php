<?php

use Illuminate\Database\Seeder;

class ModelVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('models_vehicles')->insert([
            'mod_des' => "corolla",
            'bra_id' => 1,
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'mod_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('models_vehicles')->insert([
            'mod_des' => "juke",
            'bra_id' => 2,
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'mod_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('models_vehicles')->insert([
            'mod_des' => "A6",
            'bra_id' => 3,
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'mod_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('models_vehicles')->insert([
            'mod_des' => "fiesta power",
            'bra_id' => 4,
            'use_nic' => "sysadmin",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'mod_act'=> true,
            'acc_id'=> 1
        ]);
    }
}
