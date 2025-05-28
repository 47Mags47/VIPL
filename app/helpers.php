<?php

use App\Models\Main\User;
use Illuminate\Support\Facades\Auth;

if (! function_exists('getOld')) {
    /**
     * Возвращает старое значение для поля
     * @param string $name Наименование поля
     * @return mixed старое значение для поля
     */
    function getOld(string|null $name)
    {
        if ($name === null)
            return;

        $dot_name = str_replace(']', '', str_replace('[', '.', $name));

        $value = old($name);
        $value = $value ?? old($dot_name);
        $value = $value ?? request()->input($name);
        $value = $value ?? request()->input($dot_name);

        return $value;
    }
}

if (! function_exists('user')) {
    /**
     * Возвращает текущего аунтифицированного пользователя
     * @return User|null - текущий пользователь
     */
    function user(int|null $id = null): User|null
    {
        return $id !== null
            ? User::whereKey($id)->get()->first()
            : Auth::user();
    }
}

if (! function_exists('formatSizeUnits')) {
    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824) {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        } elseif ($bytes > 1) {
            $bytes = $bytes . ' бит';
        } elseif ($bytes == 1) {
            $bytes = $bytes . ' байт';
        } else {
            $bytes = '0 байт';
        }

        return $bytes;
    }
}
