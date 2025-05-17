<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin_role = Role::firstOrCreate([
            'name' => 'admin',
            'color' => '000000',
            'description' => 'admin role',
            'level' => '99999'
        ]);

        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'gfors',
                'password' => Hash::make('11111111')
            ]
        );

        $user->roles()->syncWithoutDetaching([$admin_role->id]);
    }
}
