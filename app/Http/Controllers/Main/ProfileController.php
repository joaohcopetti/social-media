<?php

namespace App\Http\Controllers\Main;

use App\Models\Profile;
use App\Http\Controllers\Controller;
use App\Inertia\Main\ProfileViewInertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Cashier;

class ProfileController extends Controller
{
    public function index(Profile $profile)
    {
        return app(ProfileViewInertia::class)->render(
            $profile,
            $profile->media()
                ->where('show_on_home', true)
                ->where('is_free', true)
                ->orderBy('order', 'desc')
                ->get()
        );
    }

    public function free(Profile $profile)
    {
        return app(ProfileViewInertia::class)->render(
            $profile,
            $profile->media()
                ->where('is_free', true)
                ->orderBy('order', 'desc')
                ->get()
        );
    }

    public function premium(Profile $profile)
    {
        return app(ProfileViewInertia::class)->render(
            $profile,
            $profile->media()
                ->where('is_free', false)
                ->orderBy('order', 'desc')
                ->get()
        );
    }

    public function subscribe(Profile $profile, Request $request)
    {
        /**
         * @var \App\Models\User
         */
        $user = Auth::user();

        $price = $profile->subscription_price;
        $title = "Perfil de {$profile->name}";

        return $user->newSubscription('default', 'price_1Qx0CiG8sEYWxOnlvB7b7aag')
            ->checkout();
        /* return $user->checkoutCharge($price, $title, sessionOptions: [
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'brl',
                        'product_data' => [
                            'name' => $title,
                            'description' => 'Assinatura com duração de 1 mễs',
                        ],
                        'unit_amount' => $price,
                    ],
                    'quantity' => 1,
                ],
            ]
        ]); */
    }
}
