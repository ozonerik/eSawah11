<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Info;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $info = Info::create(
            [
                'title' => 'Judul Pesan 1',
                'message' => 'Isi Pesan Satu',
                'img' => '',
            ]);
        $info = Info::create(
            [
                'title' => 'Judul Pesan 2',
                'message' => 'Isi Pesan Dua',
                'img' => '',
            ]);
    }
}
