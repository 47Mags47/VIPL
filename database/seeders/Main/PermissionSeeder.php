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
        // glossary-worker
        Role::create(['code' => 'glossary-worker', 'name' => 'Работа со справочниками']);

        Permission::create(['code' => 'glossary-payment-create',    'name' => 'Создание записи в справочнике "выплаты"']);
        Permission::create(['code' => 'glossary-payment-update',      'name' => 'Редактирование записи в справочнике "выплаты"']);
        Permission::create(['code' => 'glossary-payment-delete',    'name' => 'Удаление записи в справочнике "выплаты"']);

        Permission::create(['code' => 'glossary-bank-create',       'name' => 'Создание записи в справочнике "Банки"']);
        Permission::create(['code' => 'glossary-bank-update',         'name' => 'Редактирование записи в справочнике "Банки"']);
        Permission::create(['code' => 'glossary-bank-delete',       'name' => 'Удаление записи в справочнике "Банки"']);

        Permission::create(['code' => 'glossary-division-create',   'name' => 'Создание записи в справочнике "Организации"']);
        Permission::create(['code' => 'glossary-division-update',     'name' => 'Редактирование записи в справочнике "Организации"']);
        Permission::create(['code' => 'glossary-division-delete',   'name' => 'Удаление записи в справочнике "Организации"']);

        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-payment-create']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-payment-update']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-payment-delete']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-bank-create']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-bank-update']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-bank-delete']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-division-create']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-division-update']);
        RolePivotPermission::create(['role_code' => 'glossary-worker',    'permission_code' => 'glossary-division-delete']);

        // division-worker
        Role::create(['code' => 'division-worker', 'name' => 'Работник организации']);

        Permission::create(['code' => 'payment-file-upload',    'name' => 'Загрузка файлов для выплат']);

        RolePivotPermission::create(['role_code' => 'division-worker',    'permission_code' => 'payment-file-upload']);

        // Raports
        Permission::create(['code' => 'create-raport-payment-all-divisions',    'name' => 'формирование Отчета по выплате по всем организациям']);
        Permission::create(['code' => 'create-raport-payment-from-divisions',    'name' => 'формирование Отчета по выплате для организации']);
    }
}
