<?php

namespace App\Models\Main;

use App\Models\Glossary\Division;
use App\Models\Glossary\UserStatus;
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

class User extends Authenticatable implements MustVerifyEmail
{
    use
        Named,
        RolesAndPermissions,
        HasFilter,
        HasFactory,
        Notifiable,
        SoftDeletes,
        CanResetPassword;

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

    public function scopeNotRoot(){
        $roots = Role::roots()->users;
        return $this->whereNotIn('id', $roots->pluck('id')->toArray());
    }

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
