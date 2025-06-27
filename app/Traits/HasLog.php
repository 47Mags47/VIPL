<?php

namespace App\Traits;

use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Contracts\Activity;

trait HasLog
{
    use LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->useLogName('system')
            ->logFillable();
    }

    public function tapActivity(Activity $activity, string $eventName)
    {
        $activity->description = "{$eventName}";
        $activity->causer_id = user()->id;
    }
}
