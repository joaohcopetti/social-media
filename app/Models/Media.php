<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
