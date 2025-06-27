<?php

namespace App\Http\Controllers\Web\Main;

use App\Events\UserCreated;
use App\Filters\Main\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\User\StoreRequest;
use App\Http\Requests\Main\User\UpdateRequest;
use App\Models\Glossary\Division;
use App\Models\Glossary\UserStatus;
use App\Models\Main\Role;
use App\Models\Main\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::notRoot()
            ->withTrashed()
            ->orderBy('division_id')
            ->orderBy('name')
            ->paginate(50)
            ->toResourceCollection();
        $divisions = Division::orderBy('code')->get()->toResourceCollection();
        $roles = Role::get()->toResourceCollection();

        return Inertia::render('main/users/Index', compact('users', 'divisions', 'roles'));
    }

    public function store(StoreRequest $request)
    {
        $user = User::create(array_merge(
            $request->only(['name', 'email', 'division_id']),
            [
                'status_id' => UserStatus::byCode('new')->id,
                'password' => Hash::make(''),
                'password_expired' => true
            ]
        ));

        foreach ($request->roles as $role) {
            $user->addRole($role);
        }

        event(new UserCreated($user));

        return redirect()->route('main.users.index')->with('message', 'Пользователь успешно создан');
    }

    public function restore(User $user)
    {
        $user->restore();

        return redirect()->route('main.users.index')->with('message', 'Пользователь восстановлен');
    }

    public function resetPassword(User $user)
    {
        $user->update(['password_expired', true]);

        return redirect()->route('main.users.index')->with('message', 'Пароль пользователя сброшен');
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'division_id']));

        $user->refreshRoles();
        foreach ($request->roles as $role) {
            $user->addRole($role);
        }

        if ($user->trashed())

            return redirect()->route('main.users.index')->with('message', 'Данные изменены');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('main.users.index')->with('message', 'Пользователь удален');
    }
}
