<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Membuat permissions
        $permissions = [
            'view_users',
            'manage_users',
            'view_vehicles',
            'manage_vehicles',
            'view_bbm_reports',
            'manage_bbm_reports',
            'book_vehicles',
            'approve_vehicle_booking',
            'view_service_records',
            'manage_service_records'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Membuat roles dan memberikan permissions

        // Admin
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo($permissions);

        // Supervisor
        $supervisor = Role::create(['name' => 'supervisor']);
        $supervisor->givePermissionTo([
            'view_users', 'view_vehicles', 'view_bbm_reports', 'book_vehicles',
            'approve_vehicle_booking', 'view_service_records'
        ]);

        // Manager
        $manager = Role::create(['name' => 'manager']);
        $manager->givePermissionTo([
            'view_users', 'view_vehicles', 'view_bbm_reports', 'book_vehicles',
            'approve_vehicle_booking', 'view_service_records'
        ]);

        // Employee
        $employee = Role::create(['name' => 'employee']);
        $employee->givePermissionTo(['view_vehicles', 'book_vehicles']);
    }
}
