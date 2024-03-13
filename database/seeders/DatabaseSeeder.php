<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(InfoSeeder::class);
        $this->call(SawahSeeder::class);
        $this->call(PawonganSeeder::class);
        //$this->call(SawahPawonganSeeder::class);
        $this->call(LanjaSeeder::class);
        $this->call(AppconfigSeeder::class);
    }
}
