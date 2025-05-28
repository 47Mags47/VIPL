<?php

namespace Database\Seeders\Dev\Main;

use App\Models\Main\Role;
use App\Models\Main\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ADMIN
        $admin = User::create([
            'id' => 1,
            'division_id' => null,
            'name' => 'Администратор',
            'email' => 'admin@test.ru',
            'password' => Hash::make('admin'),
        ]);

        foreach (Role::all() as $role) {
            $admin->addRole($role->code);
        }

        // USER
        $user = User::create([
            'id' => 2,
            'division_id' => 1,
            'name' => 'Пользователь',
            'email' => 'user@test.ru',
            'password' => Hash::make('user'),
        ]);
    }
}
