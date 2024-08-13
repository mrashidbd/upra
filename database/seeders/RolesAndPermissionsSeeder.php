<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    protected static ?string $password;

    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view list',
            'delete',
            'ban',
            'receive message',
            'send notification',
            'send message',
            'submit',
            'view own',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $superAdminRole->givePermissionTo(Permission::all());

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo([
            'view list',
            'ban',
            'send message',
            'receive message',
            'send notification',
            'view own',
        ]);

        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo([
            'send message',
            'receive message',
            'submit',
            'view own',
        ]);

        // Create a super-admin user
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@upra.test',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $superAdmin->assignRole($superAdminRole);

        // Create an admin user
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@upra.test',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole($adminRole);

        // Assign the 'user' role to all existing users
        User::whereDoesntHave('roles')->get()->each(function ($user) use ($userRole) {
            $user->assignRole($userRole);
        });
    }
}
