<?php

use App\Models\Main\Payment\File;
use App\Models\Main\Payment\Package;
use App\Models\Main\User;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('files.{file}', function (User $user, File $file) {
    if(user()->hasRole('system_admin'))
        return true;

    if(user()->division->id === $file->package->division->id)
        return true;

    return false;
});

Broadcast::channel('package.{package}.files', function (User $user, Package $package) {
    if(user()->hasRole('system_admin'))
        return true;

    if(user()->division->id === $package->division->id)
        return true;

    return false;
});
