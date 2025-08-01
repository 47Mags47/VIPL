<?php

namespace App\Models\Main;

use App\Models\Glossary\Division;
use App\Models\Sys\UserStatus;
use App\Traits\hasApi;
use App\Traits\HasFilter;
use App\Traits\Named;
use App\Traits\RolesAndPermissions;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $login
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property bool $password_expired
 * @property int $division_id
 * @property int $status_id
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Division $division
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sys\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Sys\Role> $roles
 * @property-read int|null $roles_count
 * @property-read UserStatus $status
 * @method static Builder<static>|User api()
 * @method static Builder<static>|User filter(\App\Classes\Filter $filter)
 * @method static Builder<static>|User hasEditAccessToCurrentUser()
 * @method static Builder<static>|User newModelQuery()
 * @method static Builder<static>|User newQuery()
 * @method static Builder<static>|User notCurrent()
 * @method static Builder<static>|User notRoot()
 * @method static Builder<static>|User onlyTrashed()
 * @method static Builder<static>|User query()
 * @method static Builder<static>|User rolePermissions()
 * @method static Builder<static>|User whereCreatedAt($value)
 * @method static Builder<static>|User whereDeletedAt($value)
 * @method static Builder<static>|User whereDivisionId($value)
 * @method static Builder<static>|User whereEmail($value)
 * @method static Builder<static>|User whereEmailVerifiedAt($value)
 * @method static Builder<static>|User whereId($value)
 * @method static Builder<static>|User whereLogin($value)
 * @method static Builder<static>|User whereName($value)
 * @method static Builder<static>|User wherePassword($value)
 * @method static Builder<static>|User wherePasswordExpired($value)
 * @method static Builder<static>|User whereRememberToken($value)
 * @method static Builder<static>|User whereStatusId($value)
 * @method static Builder<static>|User whereUpdatedAt($value)
 * @method static Builder<static>|User withTrashed()
 * @method static Builder<static>|User withoutTrashed()
 * @mixin \Eloquent
 */
class User extends Authenticatable implements MustVerifyEmail
{
    use
        hasApi,
        HasFilter,
        Named,
        RolesAndPermissions,
        CanResetPassword,
        HasFactory,
        SoftDeletes,
        Notifiable;

    ### Настройки
    ##################################################
    protected $table = 'main__users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_expired',
        'division_id',
        'status_id'
    ];

    protected $hidden = [
        'password',
        'password_expired',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'password_expired' => 'boolean',
        ];
    }

    protected $attributes = [
        'password_expired' => false,
    ];

    ### Ограничения
    ##################################################

    public static function scopeNotRoot(Builder $builder): Builder
    {
        return $builder->whereHas('roles', function ($query) {
            return $query->whereNot('code', 'root');
        });
    }

    public function scopeNotCurrent(Builder $builder): Builder
    {
        return $builder->whereNot('id', user()->id);
    }

    public function scopeHasEditAccessToCurrentUser(Builder $builder): Builder
    {
        $builder
            ->notRoot()
            ->notCurrent();

        if (!user()->hasPermission('create_system_admins'))
            $builder->where('division_id', user()->division->id);

        return $builder;
    }

    ### Функции
    ##################################################
    /**
     * Меняет статус пользователя
     *
     * @param string|UserStatus $status Код или объект нового статуса
     * @return User
     */
    public function setStatus(string|UserStatus $status)
    {
        $this->update([
            'status_id' => $status instanceof UserStatus
                ? $status->id
                : UserStatus::byCode($status)->id
        ]);

        return $this;
    }

    // public function scopeNotRoot(){
    //     $roots = Role::roots()->users;
    //     return $this->whereNotIn('id', $roots->pluck('id')->toArray());
    // }

    ### Связи
    ##################################################
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(UserStatus::class, 'status_id');
    }
}
