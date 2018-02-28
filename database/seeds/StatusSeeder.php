<?php

use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('status')->insert([
            'sta_des' => "De Permiso",
            'sta_tab' => "drivers",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "sysadmin",
            'sta_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('status')->insert([
            'sta_des' => "Activo",
            'sta_tab' => "drivers",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "sysadmin",
            'sta_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('status')->insert([
            'sta_des' => "En Reposo",
            'sta_tab' => "drivers",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "sysadmin",
            'sta_act'=> true,
            'acc_id'=> 1
        ]);
    }
}
