<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Appconfig;

class AppconfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $config = Appconfig::create(
            [
                'mapapikey' => 'AIzaSyC4n0qKTgofSQtwYANwBrNd5lO-_mFUwt4',
                'hargapadi' => 750000,
                'nilailanja' => 5,
                'hargabata' => 1100000,
            ]);
    }
}
