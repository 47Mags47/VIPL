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
        ### Role
        ##################################################
        Role::create(['code' => 'root',             'name' => 'root']);
        Role::create(['code' => 'system_admin',     'name' => 'Администратор системы']);
        Role::create(['code' => 'division_admin',   'name' => 'Администратор подразделения']);
        Role::create(['code' => 'user',             'name' => 'Пользователь']);

        ### Permission
        ##################################################
        Permission::create(['code' => 'system_configuration',           'name' => 'Изменение конфигурации системы']);
        Permission::create(['code' => 'edit_glossary',                  'name' => 'Заполнение справочников']);
        Permission::create(['code' => 'create_users',                   'name' => 'Создание пользователей']);
        Permission::create(['code' => 'create_system_admins',           'name' => 'Создание администраторов системы']);
        Permission::create(['code' => 'create_division_admins',         'name' => 'Создание администраторов подразделений']);
        Permission::create(['code' => 'create_payment_raports',         'name' => 'Создание отчетов по выплатам']);

        ### RolePivotPermission
        ##################################################
        // root
        RolePivotPermission::create(['role_code' => 'root',             'permission_code' => 'edit_glossary']);
        RolePivotPermission::create(['role_code' => 'root',             'permission_code' => 'system_configuration']);
        RolePivotPermission::create(['role_code' => 'root',             'permission_code' => 'create_users']);
        RolePivotPermission::create(['role_code' => 'root',             'permission_code' => 'create_system_admins']);
        RolePivotPermission::create(['role_code' => 'root',             'permission_code' => 'create_division_admins']);

        // system_admin
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'edit_glossary']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'create_users']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'create_system_admins']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'create_division_admins']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'create_payment_raports']);

        // division_admin
        RolePivotPermission::create(['role_code' => 'division_admin',   'permission_code' => 'create_users']);
    }
}
