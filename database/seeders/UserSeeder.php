<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Taylor Ivanoff',
            'email' => 'taylorivanoff@gmail.com',
            'password' => Hash::make('8g48b8p8fR'),
        ]);
    }
}
