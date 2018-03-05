<?php

use App\Models\Inventary\Brand;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountsSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(PermissionSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(DriverSeeder::class);
        $this->call(BrandVehicleSeeder::class);
        $this->call(ModelVehicleSeeder::class);
        $this->call(TypeVehicleSeeder::class);
        $this->call(FleetSeeder::class);
        $this->call(VehicleSeeder::class);
        //$this->call(InventarySeeder::class);
    }
}
