<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $user = User::factory()->create([
            'name' => 'admin', 
            'email' => 'admin@bnb',
            'password' => Hash::make('123456'),
        ]);

        Permission::create(['name' => 'check control']);
        $user->givePermissionTo('check control');
        $user->save();
    }
}
