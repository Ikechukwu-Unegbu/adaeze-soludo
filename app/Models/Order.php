<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Auth::id();
           do {
                $uuid = Str::uuid();
           } while(self::where('uuid', $uuid)->exists());
           $model->uuid = $uuid;
        });
    }
}
