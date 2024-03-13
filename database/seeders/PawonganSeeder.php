<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pawongan;

class PawonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pawongan = Pawongan::create(
            [
                'nik' => '3209201109870008',
                'nama'=> 'ade erik',
                'alamat' => 'mundu karangampel indramayu',
                'telp' => '081324275362',
                'user_id' => '1',
            ]);
        $pawongan = Pawongan::create(
            [
                'nik' => '3209201109870009',
                'nama'=> 'dede',
                'alamat' => 'kedokan karangampel indramayu',
                'telp' => '089324275362',
                'user_id' => '2',
            ]);
        $pawongan = Pawongan::create(
            [
                'nik' => '3209201109870010',
                'nama'=> 'jojon',
                'alamat' => 'kedokan karangampel indramayu',
                'telp' => '014324275370',
                'user_id' => '3',
            ]);
    }
}
