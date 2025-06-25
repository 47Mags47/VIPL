<?php

namespace Database\Seeders\Main;

use App\Models\Glossary\Division;
use App\Models\Glossary\UserStatus;
use App\Models\Main\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserStatus::create(['code' => 'new',             'name' => 'Создан']);
        UserStatus::create(['code' => 'send-invite', 'name' => 'Отправлено приглашение']);
        UserStatus::create(['code' => 'send-verify',     'name' => 'Отправлено подтвержение']);
        UserStatus::create(['code' => 'active',          'name' => 'Активен']);
        UserStatus::create(['code' => 'disabled',        'name' => 'Отключен']);

        $root = User::create([
            'division_id' => Division::byCode('root')->id,
            'name' => 'root',
            'email' => '',
            'password' => Hash::make('root'),
            'status_id' => UserStatus::byCode('active')->id,
        ]);

        $root->addRole('admin');
    }
}
