<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;

trait hasUUID
{
    // use HasUlids;

    // protected $primaryKey = 'uuid';

    // protected $keyType = 'string';

    // public $incrementing = false;

    // protected static function bootUsesUuid()
    // {
    //     static::creating(function ($model) {
    //         if (! $model->getKey()) {
    //             $model->{$model->uuid} = (string) Str::uuid();
    //         }
    //     });
    // }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function getPrimaryKey()
    {
        return 'uuid';
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
