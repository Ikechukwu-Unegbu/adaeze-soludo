<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',              // The product name
        'description',       // The product description
        'price',             // The product price
        'image_path',        // The image URL or path
    ];
}
