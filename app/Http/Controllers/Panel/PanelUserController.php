<?php

namespace App\Http\Controllers\Panel;

use App\Enums\RolesEnum;
use App\Http\Requests\PanelUserRequest;
use App\Inertia\Panel\UsersIndexViewInertia;
use App\Models\User;
use Illuminate\Support\Arr;
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
        User::create($request->validated());

        return redirect()->route('panel.users.index');
    }

    public function update(PanelUserRequest $request, User $user)
    {
        $user->update(
            Arr::where(
                $request->validated(),
                fn($value) => $value !== null
            )
        );

        if ($request->boolean('is_admin')) {
            $user->assignRole(RolesEnum::ADMIN->value);
        } else {
            $user->removeRole(RolesEnum::ADMIN->value);
        }
    }
}
