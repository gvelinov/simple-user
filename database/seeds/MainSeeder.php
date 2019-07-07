<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Demo User',
            'email' => 'demo@demo.com',
            'password' => bcrypt('Changeme1'),
            'role_id' => 1,
            'in_probation' => 0,
            'employee_id' => Str::uuid()
        ]);

        DB::table('roles')->insert([
            'name' => 'Manager Role',
            'ident' => 'manager',
            'description' => 'Main role for management'
        ]);
        DB::table('roles')->insert([
            'name' => 'Staff Member',
            'ident' => 'staff',
            'description' => 'Main role for employee user'
        ]);

        DB::table('permissions')->insert([
            'name' => 'Edit Users',
            'ident' => 'users.edit',
            'description' => 'Ability to edit users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'View Users',
            'ident' => 'users.view',
            'description' => 'Ability to view users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Create Users',
            'ident' => 'users.create',
            'description' => 'Ability to create users'
        ]);
        DB::table('permissions')->insert([
            'name' => 'Edit Profile',
            'ident' => 'user.profile',
            'description' => 'Ability to edit own profile'
        ]);

        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 1
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 2
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 3
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 1,
            'permission_id' => 4
        ]);
        DB::table('role_permissions')->insert([
            'role_id' => 2,
            'permission_id' => 4
        ]);
    }
}
