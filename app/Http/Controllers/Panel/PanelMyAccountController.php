<?php

namespace App\Http\Controllers\Panel;

use App\Actions\UserUpdateAction;
use App\Inertia\Panel\MyAccountViewInertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyAccountRequest;
use App\Http\Controllers\Controller;

class PanelMyAccountController extends Controller
{
    public function manage()
    {
        return app(MyAccountViewInertia::class)->render(Auth::user());
    }

    public function update(MyAccountRequest $request)
    {
        app(UserUpdateAction::class)->execute(
            Auth::user(),
            $request->validated()
        );

        return redirect()->route('panel.my-account.edit');
    }

    public function destroy(Request $request)
    {
        $request->session()->invalidate();

        Auth::user()->delete();

        return redirect()->route('home');
    }
}
