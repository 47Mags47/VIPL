<?php

namespace Database\Seeders\Main;

use App\Models\Glossary\Division;
use App\Models\Glossary\UserStatus;
use App\Models\Main\User;
use App\Models\Main\UserPivotRole;
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
        UserStatus::create(['code' => 'new',            'name' => 'Создан']);
        UserStatus::create(['code' => 'send-invite',    'name' => 'Отправлено приглашение']);
        UserStatus::create(['code' => 'send-verify',    'name' => 'Отправлено подтвержение']);
        UserStatus::create(['code' => 'active',         'name' => 'Активен']);
        UserStatus::create(['code' => 'disabled',       'name' => 'Отключен']);

        $root = User::create([
            'division_id' => Division::withoutGlobalScope('not root')->where('code', 'root')->first()->id,
            'name' => 'root',
            'email' => '',
            'login' => 'root',
            'password' => Hash::make('root'),
            'status_id' => UserStatus::byCode('active')->id,
        ]);

        UserPivotRole::create([
            'user_id' => $root->id,
            'role_code' => 'root',
        ]);
    }
}
