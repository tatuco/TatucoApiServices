<?php

use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'acc_enc' => "zippyttech",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'acc_des' => "Cuenta de prueba",
            'acc_dir' => 'San cristobal',
            'acc_mai' => 'sysadmin@zippyttech.com',
            'acc_ima'=> 'imagen',
            'acc_nom'=> 'Gasolinera',
            'acc_ruc'=> 'ruc gasolinera',
            'acc_pho'=> '04141234567',
            'acc_web'=> 'gasolinera.com',
            'acc_act'=> true
        ]);

        DB::table('accounts')->insert([
            'acc_enc' => "aguaseo",
            'created_at'=> new DateTime,
            'updated_at'=> new DateTime,
            'acc_des' => "Cuenta de aguaseo",
            'acc_dir' => 'panama',
            'acc_mai' => 'sysadmin@aguaseo.com',
            'acc_ima'=> 'imagen',
            'acc_nom'=> 'aguaseo',
            'acc_ruc'=> 'ruc aguaseo',
            'acc_pho'=> '04141234567',
            'acc_web'=> 'aguaseo.com',
            'acc_act'=> true
        ]);
    }
}
