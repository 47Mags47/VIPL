<?php

use App\Models\Main\User;
use App\Models\Payment\Raport;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('private-raports', function (User $user, Raport $raport) {
    return true;
});
