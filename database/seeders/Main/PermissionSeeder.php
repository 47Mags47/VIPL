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
        Role::create(['code' => 'root',             'name' => 'root']);
        Role::create(['code' => 'system_admin',     'name' => 'Администратор системы']);
        Role::create(['code' => 'division_admin',   'name' => 'Администратор подразделения']);
        Role::create(['code' => 'user',             'name' => 'Пользователь']);

        Permission::create(['code' => 'system_configuration',           'name' => 'Изменение конфигурации системы']);
        Permission::create(['code' => 'edit_glossary',                  'name' => 'Заполнение справочников']);
        Permission::create(['code' => 'edit_divisions',                 'name' => 'Изменение данных подразделений']);
        Permission::create(['code' => 'edit_division',                  'name' => 'Изменение данных подразделения']);
        Permission::create(['code' => 'edit_payment_files',             'name' => 'Загрузка файлов выплат']);
        Permission::create(['code' => 'upload_payment_raport',          'name' => 'Формирование отчета по выплате']);
        Permission::create(['code' => 'upload_division_payment_raport', 'name' => 'Формирование отчета по выплате для подразделения']);

        Permission::create(['code' => 'edit_system_admins',             'name' => 'Назначение администраторов системы']);
        Permission::create(['code' => 'edit_division_admins',           'name' => 'Назначение администраторов подразделения']);
        Permission::create(['code' => 'edit_users',                     'name' => 'Создание пользователей']);

        RolePivotPermission::create(['role_code' => 'root',             'permission_code' => 'system_configuration']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'edit_system_admins']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'edit_division_admins']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'edit_glossary']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'edit_divisions']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'edit_users']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'upload_payment_raport']);
        RolePivotPermission::create(['role_code' => 'system_admin',     'permission_code' => 'upload_division_payment_raport']);
        RolePivotPermission::create(['role_code' => 'division_admin',   'permission_code' => 'edit_division']);
        RolePivotPermission::create(['role_code' => 'division_admin',   'permission_code' => 'edit_users']);
        RolePivotPermission::create(['role_code' => 'division_admin',   'permission_code' => 'edit_payment_files']);
        RolePivotPermission::create(['role_code' => 'division_admin',   'permission_code' => 'upload_division_payment_raport']);
        RolePivotPermission::create(['role_code' => 'user',             'permission_code' => 'edit_payment_files']);
    }
}
