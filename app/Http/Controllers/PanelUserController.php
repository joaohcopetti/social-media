<?php

namespace App\Http\Controllers;

use App\Enums\RoleEnum;
use App\Http\Requests\MyAccountRequest;
use App\Http\Requests\PanelUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Arr;

class PanelUserController extends Controller
{
    public function index()
    {
        return Inertia::render('panel/users/UsersView', [
            'users' => User::orderBy('created_at', 'desc')->with(['roles'])->paginate()
        ]);
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
            $user->assignRole(RoleEnum::ADMIN->value);
        } else {
            $user->removeRole(RoleEnum::ADMIN->value);
        }
    }
}
