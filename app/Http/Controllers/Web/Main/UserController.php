<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Main\User;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(){
        $users = User:: orderBy('division_id')->paginate(50)->toResourceCollection();

        return Inertia::render('main/users/index', compact('users'));
    }
}
