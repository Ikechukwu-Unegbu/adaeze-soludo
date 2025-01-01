<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class PayStackTransaction extends Model
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
           $model->reference_id = self::generateUniqueTransactionId();
        });
    }

    private static function generateUniqueTransactionId(): string
    {
        $code = 'ADAEZA';
        $transactionNumber = Auth::id();
        $timestamp = date('YmdHis');
        $randomDigits = Str::upper(Str::random(6));

        return "{$code}|{$transactionNumber}|{$timestamp}|{$randomDigits}";
    }
}
