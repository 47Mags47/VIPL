<?php

namespace App\Models\Main;

use App\Models\Glossary\Division;
use App\Traits\Named;
use App\Traits\RolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Named, HasFactory, Notifiable, RolesAndPermissions, SoftDeletes;

    ### Настройки
    ##################################################
    protected $table = 'main__users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'password_reset',
        'division_id',
        'status_id'
    ];

    protected $hidden = [
        'password',
        'password_reset',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'password_reset' => 'boolean',
        ];
    }

    ### Связи
    ##################################################
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class, 'division_id');
    }
}
