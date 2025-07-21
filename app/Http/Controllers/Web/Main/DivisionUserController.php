<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use App\Models\Glossary\Division;
use App\Models\Sys\Role;
use Inertia\Inertia;

class DivisionUserController extends Controller
{
    public function index(Division $division){
        $users = $division->users()
            ->withTrashed()
            ->orderBy('name')
            ->paginate(50)
            ->toResourceCollection();

        $roles = Role::where('code', 'user')->where('code', 'division_admin')->get()->toResourceCollection();

        return Inertia::render('main/users/DivisionIndex', compact('users', 'roles'));
    }
}
