<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create(
            [
                'name' => 'Admin',
                'email' => 'admin@test.id',
                'password' => Hash::make('123456789'),
                'email_verified_at' => Carbon::now(),
                'photo' => '',
            ]);
        $user->assignRole('admin');
        $user = User::create(
            [
                'name' => 'User',
                'email' => 'user@test.id',
                'password' => Hash::make('123456789'),
                'email_verified_at' => Carbon::now(),
                'photo' => '',
            ]);
        $user->assignRole('user');
        $user = User::create(
            [
                'name' => 'pro',
                'email' => 'pro@test.id',
                'password' => Hash::make('123456789'),
                'email_verified_at' => Carbon::now(),
                'photo' => '',
            ]);
        $user->assignRole('pro');
    }
}
