<?php

namespace App\Http\Controllers;

use App\Http\Requests\PanelUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PanelUserController extends Controller
{
    public function index()
    {
        return Inertia::render('panel/users/UsersView', [
            'users' => User::orderBy('created_at', 'desc')->paginate()
        ]);
    }

    public function store(PanelUserRequest $request)
    {
        User::create($request->all());

        return redirect()->route('panel.users.index');
    }
}
