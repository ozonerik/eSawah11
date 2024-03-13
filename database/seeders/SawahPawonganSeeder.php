<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Sawah;
use App\Models\Pawongan;

class SawahPawonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pawongan = Pawongan::find(1);
        $sawah = ['1' => ['tahun' => '2021'] ,'2' => ['tahun' => '2024']];
        $pawongan->sawahs()->sync($sawah);

        $pawongan = Pawongan::find(3);
        $sawah = ['3' => ['tahun' => '2022']];
        $pawongan->sawahs()->sync($sawah);
    }
}
