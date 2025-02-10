<?php

namespace App\Http\Controllers\Panel;

use App\Inertia\Panel\MyAccountViewInertia;
use App\Inertia\Panel\ProfileMediaViewInertia;
use App\Inertia\Panel\ProfilesEditViewInertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyAccountRequest;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class PanelMyAccountController extends Controller
{
    public function myAccount()
    {
        return app(MyAccountViewInertia::class)->render(Auth::user());
    }

    public function myAccountUpdate(MyAccountRequest $request)
    {
        Auth::user()->update(
            Arr::where(
                $request->validated(),
                fn($value) => $value !== null
            )
        );

        return redirect()->route('panel.user.my-account');
    }

    public function myProfile()
    {
        return app(ProfilesEditViewInertia::class)->render(Auth::user()->profile);
    }

    public function myMedias()
    {
        return app(ProfileMediaViewInertia::class)->render(Auth::user()->profile);
    }
}
