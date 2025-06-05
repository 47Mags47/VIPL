<?php

namespace Database\Seeders\Main;

use App\Models\Main\Permission;
use App\Models\Main\Role;
use App\Models\Main\RolePivotPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['code' => 'user',     'name' => 'Пользователь']);
        Role::create(['code' => 'admin',    'name' => 'Администратор']);
        Role::create(['code' => 'root',     'name' => 'root']);


        Permission::create(['code' => 'edit-glossary-bank',      'name' => 'Изменение справочника "Банки"']);
        Permission::create(['code' => 'edit-glossary-division',  'name' => 'Изменение справочника "Подразделение"']);
        Permission::create(['code' => 'edit-glossary-law',       'name' => 'Изменение справочника "Законы"']);
        Permission::create(['code' => 'edit-glossary-payment',   'name' => 'Изменение справочника "Выплаты"']);
        Permission::create(['code' => 'edit-main-user',          'name' => 'Изменение списка пользователей']);


        RolePivotPermission::create(['role_code' => 'admin',    'permission_code' => 'edit-glossary-bank']);
        RolePivotPermission::create(['role_code' => 'admin',    'permission_code' => 'edit-glossary-division']);
        RolePivotPermission::create(['role_code' => 'admin',    'permission_code' => 'edit-glossary-law']);
        RolePivotPermission::create(['role_code' => 'admin',    'permission_code' => 'edit-glossary-payment']);
        RolePivotPermission::create(['role_code' => 'admin',    'permission_code' => 'edit-main-user']);
    }
}
