<?php

namespace App\Http\Controllers\Web\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\User\StoreRequest;
use App\Http\Requests\Main\User\UpdateRequest;
use App\Models\Glossary\Division;
use App\Models\Main\Role;
use App\Models\Main\User;
use Illuminate\Auth\Events\Registered;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('division_id')->paginate(50)->toResourceCollection();
        $divisions = Division::orderBy('code')->get()->toResourceCollection();
        $roles = Role::get()->toResourceCollection();

        return Inertia::render('main/users/index', compact('users', 'divisions', 'roles'));
    }

    public function store(StoreRequest $request)
    {
        $user = User::create($request->only(['name', 'email', 'division_id']));
        foreach ($request->roles as $role) {
            $user->addRole($role);
        }

        event(new Registered($user));

        return redirect()->route('main.users.index')->with('message', 'Пользователь успешно создан');
    }

    public function update(UpdateRequest $request, User $user) {
        $user->update($request->only(['name', 'email', 'division_id']));

        $user->refreshRoles();
        foreach ($request->roles as $role) {
            $user->addRole($role);
        }

        return redirect()->route('main.users.index')->with('message', 'Данные изменены');
    }

    public function destroy(User $user) {
        $user->delete();

        return redirect()->route('main.users.index')->with('message', 'Пользователь удален');
    }
}
