<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocalNetworkMiddleware
{

    function applyNetMask($ip, $mask)
    {
        if (is_string($ip)) $ip   = ip2long($ip);
        if (is_string($mask)) $mask = ip2long($mask);

        return long2ip(sprintf('%u', $ip & $mask));
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ('10.0.0.0'    === $this->applyNetMask($request->ip(), '255.0.0.0')) return $next($request);
        if ('72.16.0.0'   === $this->applyNetMask($request->ip(), '255.255.0.0')) return $next($request);
        if ('127.0.0.0'   === $this->applyNetMask($request->ip(), '255.0.0.0')) return $next($request);
        if ('192.168.0.0' === $this->applyNetMask($request->ip(), '255.255.0.0')) return $next($request);

        return abort(403);
    }
}
