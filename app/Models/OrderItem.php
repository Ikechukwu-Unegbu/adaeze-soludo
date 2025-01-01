<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $guarded = [];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
           do {
                $uuid = Str::uuid();
           } while(self::where('uuid', $uuid)->exists());
           $model->uuid = $uuid;
        });
    }
}
