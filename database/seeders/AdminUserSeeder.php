<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeder untuk membuat user admin default.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin SIPETA',
            'email' => 'admin@sipeta.com',
            'password' => bcrypt('password'),
        ]);

        $this->command->info('✅ Admin user created successfully!');
        $this->command->info('📧 Email: admin@sipeta.com');
        $this->command->info('🔑 Password: password');
    }
}
