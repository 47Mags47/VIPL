<?php

use App\Exceptions\InvalidUserException;
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
     * Возвращает текущего пользователя
     * @return User - текущий пользователь
     */
    function user(): User
    {
        $user = Auth::user() ?? new User();

        return $user;
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

if (! function_exists('sys_config')) {
    function sys_config(string|null $param = null)
    {
        $config = App\Models\Sys\Config::byCode($param);

        return $param == null
            ? $config
            : $config[$param];
    }
}

if (! function_exists('applyNetMask')) {
    function applyNetMask($ip, $mask)
    {
        if (is_string($ip)) $ip   = ip2long($ip);
        if (is_string($mask)) $mask = ip2long($mask);

        return long2ip(sprintf('%u', $ip & $mask));
    }
}


if (! function_exists('isLocalRequest')) {
    function isLocalRequest(Illuminate\Http\Request $request)
    {
        if ('10.0.0.0'    === applyNetMask($request->ip(), '255.0.0.0'))    return true;
        if ('72.16.0.0'   === applyNetMask($request->ip(), '255.255.0.0'))  return true;
        if ('127.0.0.0'   === applyNetMask($request->ip(), '255.0.0.0'))    return true;
        if ('192.168.0.0' === applyNetMask($request->ip(), '255.255.0.0'))  return true;

        return false;
    }
}
