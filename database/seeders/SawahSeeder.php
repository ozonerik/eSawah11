<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sawah;

class SawahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sawah = Sawah::create(
            [
                'nosawah' => '1',
                'namasawah'=> 'sawah admin',
                'luas' => '2100',
                'lokasi' => 'Kedokan',
                'user_id' => '1',
            ]);

        $sawah = Sawah::create(
            [
                'nosawah' => '1',
                'namasawah'=> 'sawah user',
                'luas' => '3100',
                'lokasi' => 'Mundu',
                'user_id' => '2',
            ]);

        $sawah = Sawah::create(
            [
                'nosawah' => '1',
                'namasawah'=> 'sawah pro',
                'luas' => '4100',
                'lokasi' => 'Karangampel',
                'user_id' => '3',
            ]);
    }
}
