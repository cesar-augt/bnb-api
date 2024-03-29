<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'name' => 'admin', 
            'email' => 'admin@bnb',
            'password' => Hash::make('1234'),
        ]);
    }
}
