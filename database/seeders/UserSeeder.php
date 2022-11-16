<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Admin Test',
            'email' => 'admin.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678')
        ]);
        $adminRole = Role::findByName(config('auth.roles.admin'));
        if (isset($adminRole)) {
            $admin->assignRole($adminRole);
        }

        $user = User::create([
            'name' => 'User Test',
            'email' => 'user.test@localhost',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('12345678')
        ]);
        $userRole = Role::findByName(config('auth.roles.user'));
        if (isset($userRole)) {
            $user->assignRole($userRole);
        }
    }
}
