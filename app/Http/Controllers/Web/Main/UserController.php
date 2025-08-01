<?php

namespace App\Http\Controllers\Web\Main;

use App\Events\Main\User\Invite\AcceptInvitionEvent;
use App\Events\Main\User\UserCreateEvent;
use App\Filters\Main\UserFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Main\User\EditRequset;
use App\Http\Requests\Main\User\StoreRequest;
use App\Http\Requests\Main\User\UpdateRequest;
use App\Jobs\Main\User\SendInvitionJob;
use App\Models\Glossary\Division;
use App\Models\Main\User;
use App\Models\Sys\Role;
use App\Models\Sys\UserStatus;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index(UserFilter $filter)
    {
        $users = User::withTrashed()->hasEditAccessToCurrentUser()
            ->filter($filter)
            ->orderBy('name')
            ->api();

        return Inertia::render('main/users/Index', [
            'users' => fn() => $users
        ]);
    }

    public function create()
    {
        return Inertia::render('main/users/Create', [
            'divisions' => fn() => Division::notRoot()->createAccess()->orderBy('name')->get()->toResourceCollection(),
            'roles' => fn() => Role::notRoot()->createAccess()->orderBy('name')->get()->toResourceCollection(),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'login' => $request->email,
            'password' => Hash::make($request->email),
            'status_id' => UserStatus::byCode('new')->id,
            'password_expired' => true,
            'division_id' => $request->division_id
        ]);

        foreach ($request->roles as $role) {
            $user->addRole($role);
        }

        event(new UserCreateEvent($user));

        return redirect()->route('main.users.index')->with('message', 'Пользователь успешно создан');
    }

    public function edit(EditRequset $request, User $user)
    {
        return Inertia::render('main/users/Edit', [
            'user' => fn() => $user->toResource(),
            'divisions' => fn() => Division::notRoot()->createAccess()->orderBy('name')->get()->toResourceCollection(),
            'roles' => fn() => Role::notRoot()->createAccess()->orderBy('name')->get()->toResourceCollection(),
        ]);
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'login' => $request->email,
            'division_id' => $request->division_id
        ]);

        $user->refreshRoles();
        foreach ($request->roles as $role) {
            $user->addRole($role);
        }

        return redirect()->route('main.users.index')->with('message', 'Пользователь успешно обновлена');
    }

    public function destroy(User $user)
    {
        $user->setStatus('disabled');
        $user->delete();

        return redirect()->route('main.users.index')->with('message', 'Пользователь удален');
    }

    public function invitionAccept(User $user)
    {
        AcceptInvitionEvent::dispatch($user);

        return redirect()->route('home');
    }

    public function invitionSend(User $user)
    {
        SendInvitionJob::dispatch($user);

        return back()->with('message', 'Приглашение отправлено');
    }

    public function restore(User $user)
    {
        $user->restore();
        $user->setStatus('active');

        return redirect()->route('main.users.index')->with('message', 'Пользователь восстановлен');
    }
}
