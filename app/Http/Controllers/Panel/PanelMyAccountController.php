<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyAccountRequest;
use Illuminate\Support\Arr;
use App\Http\Controllers\Controller;

class PanelMyAccountController extends Controller
{
    public function myAccount()
    {
        return Inertia::render('panel/users/MyAccountView', [
            'user' => Auth::user()
        ]);
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
        return Inertia::render('panel/profiles/ProfilesEditView', [
            'profile' => Auth::user()->profile->load(['socialNetworks', 'user'])
        ]);
    }

    public function myMedias()
    {
        return Inertia::render('panel/media/ProfileMediaManagementView', [
            'profile' => Auth::user()->profile->load(['socialNetworks', 'user', 'media'])
        ]);
    }
}
