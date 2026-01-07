<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class TestUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create test UMKM users
        for ($i = 1; $i <= 5; $i++) {
            User::updateOrCreate(
                ['email' => "umkm{$i}@example.com"],
                [
                    'name' => "UMKM User {$i}",
                    'email' => "umkm{$i}@example.com",
                    'password' => Hash::make('password'),
                    'role' => 'umkm',
                    'nib' => '9999999' . str_pad($i, 6, '0', STR_PAD_LEFT),
                    'is_active' => true,
                ]
            );
        }

        // Create test admin user
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrator',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
            ]
        );

        $this->command->info('Test users created successfully!');
        $this->command->info('UMKM Users: umkm1@example.com - umkm5@example.com');
        $this->command->info('Admin User: admin@example.com');
        $this->command->info('Password for all: password');
    }
}
