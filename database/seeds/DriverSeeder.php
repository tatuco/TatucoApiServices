<?php

use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('drivers')->insert([
            'dri_dni' => "12345678",
            'dri_nam' => "conductor 1",
            'dri_lic' => "L-12345678",
            'dri_pho' => "0424-123456",
            'dri_mai' => "conductor1@hotmail.com",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "admin",
            'sta_id' => 1,
            'dri_ass' => false,
            'dri_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('drivers')->insert([
            'dri_dni' => "12345628",
            'dri_nam' => "conductor 2",
            'dri_lic' => "L-12345628",
            'dri_pho' => "0424-1234561",
            'dri_mai' => "conductor2@hotmail.com",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "admin",
            'sta_id' => 1,
            'dri_ass' => false,
            'dri_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('drivers')->insert([
            'dri_dni' => "12345679",
            'dri_nam' => "conductor 3",
            'dri_lic' => "L-12345679",
            'dri_pho' => "0424-123457",
            'dri_mai' => "conductor3@hotmail.com",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "sysadmin",
            'sta_id' => 2,
            'dri_ass' => true,
            'dri_act'=> true,
            'acc_id'=> 1
        ]);

        DB::table('drivers')->insert([
            'dri_dni' => "12345670",
            'dri_nam' => "conductor 4",
            'dri_lic' => "L-12345670",
            'dri_pho' => "0424-123458",
            'dri_mai' => "conductor4@hotmail.com",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'use_nic' => "sysadmin",
            'sta_id' => 3,
            'dri_ass' => false,
            'dri_act'=> true,
            'acc_id'=> 1
        ]);
    }
}
