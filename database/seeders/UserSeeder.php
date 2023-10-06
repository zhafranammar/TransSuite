<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
        $admin->assignRole('admin');

        // Supervisor user
        $supervisor = User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@email.com',
            'password' => bcrypt('password')
        ]);
        $supervisor->assignRole('supervisor');

        // Manager user
        $manager = User::create([
            'name' => 'Manager',
            'email' => 'manager@email.com',
            'password' => bcrypt('password')
        ]);
        $manager->assignRole('manager');

        // Employee user
        $employee = User::create([
            'name' => 'User',
            'email' => 'employee@email.com',
            'password' => bcrypt('password')
        ]);
        $employee->assignRole('employee');
    }
}
