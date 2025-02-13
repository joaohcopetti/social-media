<?php

namespace App\Http\Controllers\Panel;

use App\Actions\UserUpdateAction;
use App\Inertia\Panel\MyAccountViewInertia;
use App\Inertia\Panel\ProfileMediaViewInertia;
use App\Inertia\Panel\ProfilesEditViewInertia;
use App\Models\ProfileMedia;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\MyAccountRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\PanelProfileRequest;
use Illuminate\Support\Facades\DB;
use App\Actions\ProfileUpdateAction;
use App\Actions\ProfileSyncNetworksAction;
use App\Http\Requests\PanelProfileMediaRequest;
use App\Actions\ProfileMediaUploadAction;
use App\Actions\ProfileMediaStoreAction;
use App\Actions\ProfileMediaDeleteAction;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

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
}
