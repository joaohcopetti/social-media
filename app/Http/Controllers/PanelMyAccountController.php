<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyAccountRequest;
use Illuminate\Support\Arr;

class PanelMyAccountController extends Controller
{
    public function index()
    {
        return Inertia::render('panel/users/MyAccountView', [
            'user' => Auth::user()
        ]);
    }

    public function update(MyAccountRequest $request)
    {
        Auth::user()->update(
            Arr::where(
                $request->validated(),
                fn($value) => $value !== null
            )
        );

        return redirect()->route('panel.my-account.index');
    }
}
