<?php

namespace App\Http\Controllers\Panel;

use App\Actions\UserCreateAction;
use App\Actions\UserUpdateAction;
use App\Http\Requests\PanelUserRequest;
use App\Inertia\Panel\UsersIndexViewInertia;
use App\Models\User;
use App\Http\Controllers\Controller;

class PanelUserController extends Controller
{
    public function index()
    {
        return app(UsersIndexViewInertia::class)->render(
            User::orderBy('name')
                ->with(['roles'])
                ->paginate()
        );
    }

    public function store(PanelUserRequest $request)
    {
        app(UserCreateAction::class)->execute($request->validated());

        return redirect()->route('panel.users.index');
    }

    public function update(PanelUserRequest $request, User $user)
    {
        app(UserUpdateAction::class)->execute($user, $request->validated());
    }
}
