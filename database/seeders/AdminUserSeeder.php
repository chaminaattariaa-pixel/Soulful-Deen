<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@soulfuldeen.com')],
            [
                'name'     => 'Admin',
                'password' => Hash::make(env('ADMIN_PASSWORD', 'Admin@12345')),
                'role'     => 'admin',
            ]
        );

        $this->command->info('✅ Admin user ready: ' . env('ADMIN_EMAIL', 'admin@soulfuldeen.com'));
    }
}