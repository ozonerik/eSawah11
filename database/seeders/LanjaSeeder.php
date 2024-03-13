<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Lanja;

class LanjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lanja = Lanja::create(
            [
                'tahun' => '2023',
                'nilailanja' => '5',
                'sawah_id' => '1',
                'pawongan_id' => '1',
                'user_id' => '1',
            ]);
        $lanja = Lanja::create(
            [
                'tahun' => '2022',
                'nilailanja' => '6',
                'sawah_id' => '2',
                'pawongan_id' => '2',
                'user_id' => '2',
            ]);
        $lanja = Lanja::create(
            [
                'tahun' => '2021',
                'nilailanja' => '4',
                'sawah_id' => '3',
                'pawongan_id' => '3',
                'user_id' => '3',
            ]);
    }
}
