<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'tenant_id' => 1,
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password')
        ]);
    }
}
