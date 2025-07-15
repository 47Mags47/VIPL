<?php

namespace App\Traits;

use App\Models\Main\Permission;
use App\Models\Main\Role;
use App\Models\Main\UserPivotPermission;
use App\Models\Main\UserPivotRole;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait RolesAndPermissions
{
    ### Связи
    ##################################################
    /**
     * @return belongsToMany Роли пользователя
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, UserPivotRole::getTableName(), 'user_id', 'role_code', 'id', 'code')->withoutGlobalScope('not root');
    }

    /**
     * @return BelongsToMany Права пользователя
     */
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, UserPivotPermission::getTableName(), 'user_id', 'permission_code', 'id', 'code');
    }

    /**
     * Возвращает права пользователя через его роли
     * @return collect Коллекция прав через роли
     */
    public function scopeRolePermissions(){
        $assigned_permissions = $this->permissions;
        $roles = $this->roles->map(function($role){
            return $role->permissions;
        })->collapse();

        return $assigned_permissions->merge($roles);
    }

    ### Сеттеры
    ##################################################
    /**
     * Добавляет пользователю роль
     * @param Role $role Role
     * @param string $role Role code
     * @return bool
     */
    public function addRole(string|Role $role)
    {
        $role_model = $role instanceof Role
            ? $role
            : Role::whereCode($role)->first();

        if ($role_model === null) return false;

        return (bool) UserPivotRole::firstOrCreate([
            'user_id' => $this->id,
            'role_code' => $role_model->code,
        ]);
    }

    /**
     * Добавляет пользователю право
     * @param Permission $permission Permission
     * @param string $permission Permission code
     * @return bool
     */
    public function addPermission(string|Permission $permission)
    {
        $permission_model = $permission instanceof Permission
            ? $permission
            : Permission::whereCode($permission)->first();

        if ($permission_model === null) return false;

        return (bool) UserPivotPermission::firstOrCreate([
            'user_id' => $this->id,
            'permission_code' => $permission_model->code,
        ]);
    }

    ### Проверки
    ##################################################
    /**
     * @param Role $role Permission
     * @param string $role Permission code
     * @return bool Имеет ли пользователь данную роль
     */
    public function hasRole(string|Role $role)
    {
        $role = $role instanceof Role
            ? $role->code
            : $role;

        return (bool) $this->roles->where('code', $role)->count();
    }

    /**
     * @param Permission $permission Permission
     * @param string $permission Permission code
     * @return bool Имеет ли пользователь данное право
     */
    public function hasPermission(string|Permission $permission)
    {
        $permission = $permission instanceof Permission
            ? $permission
            : Permission::whereCode($permission)->first();

        return user()->rolePermissions()->contains($permission);
    }

    public function ScopeIsAdmin():bool
    {
        return $this->hasRole('admin') or $this->hasRole('root');
    }

    public function ScopeIsUser():bool
    {
        return !$this->isAdmin();
    }

    ### Удаление
    ##################################################
    /**
     * Удаляет роль
     * @param Role $role Permission
     * @param string $role Permission code
     * @return bool
     */
    public function deleteRole(string|Role $role)
    {
        $role_model = $role instanceof Role
            ? $role
            : Role::whereCOde($role)->first();

        if ($role_model === null) return false;

        $this->roles()->detach($role_model->code);
        return true;
    }

    /**
     * Удаляет все роли у пользователя
     * @return bool
     */
    public function refreshRoles()
    {
        return $this->roles()->detach();
    }

    /**
     *Удаляет право
     * @param string $permission Permission code
     * @return bool
     */
    public function deletePermission(string $permission)
    {
        $permission_model = $permission instanceof Permission
            ? $permission
            : Permission::whereCode($permission)->first();

        if ($permission_model === null) return false;

        $this->permissions()->detach($permission_model->code);
        return true;
    }

    /**
     * Удаляет все права у пользователя
     * @return bool
     */
    public function refreshPermissions()
    {
        return $this->permissions()->detach();
    }
}
