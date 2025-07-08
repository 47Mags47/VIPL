<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Route;

class HandleInertiaRequests extends Middleware
{

    protected $rootView = 'app';

    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    public function share(Request $request): array
    {
        $shared = parent::share($request);

        if(in_array('auth', $request->route()->middleware()))
            $shared['user'] = user()->toResource();

        $shared['flash'] = [];
        if ($request->session()->has('message'))
            $shared['flash']['message'] = $request->session()->get('message');

        if ($request->session()->has('error'))
            $shared['flash']['error'] = $request->session()->get('error');

        return $shared;
    }
}
