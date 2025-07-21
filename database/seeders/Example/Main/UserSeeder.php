<?php

namespace Database\Seeders\Example\Main;

use App\Models\Glossary\Division;
use App\Models\Main\User;
use App\Models\Sys\UserStatus;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'division_id' => Division::first()->id,
            'name' => 'Администратор',
            'email' => 'admin@test.ru',
            'password' => Hash::make('admin'),
            'status_id' => UserStatus::byCode('active')->id,
        ]);
        $admin->addRole('system_admin');

        $user = User::create([
            'division_id' => Division::first()->id,
            'name' => 'Пользователь',
            'email' => 'user@test.ru',
            'password' => Hash::make('user'),
            'status_id' => UserStatus::byCode('active')->id,
        ]);
        $user->addRole('user');
    }
}
