<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Cashier\Subscription as CashierSubscription;

class Subscription extends CashierSubscription
{
    protected $appends = ['status', 'is_active'];

    public function profile(): BelongsTo
    {
        return $this->belongsTo(Profile::class);
    }

    public function status(): Attribute
    {
        return Attribute::make(fn() => match ($this->stripe_status) {
            'active' => 'ativo',
            'incomplete' => 'pendente',
            'error' => 'erro'
        });
    }

    public function isActive(): Attribute
    {
        return Attribute::make(fn() => $this->active());
    }
}
