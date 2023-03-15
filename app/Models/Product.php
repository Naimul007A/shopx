<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model {
    use HasFactory;
    protected $fillable = [
        'title',
        'short_description',
        'description',
        'category_id',
        'price',
        'sale_price',
        'status',
        'slug',
    ];
    public static function boot() {
        parent::boot();
        static::creating( function ( $product ) {
            $product->slug = Str::slug( $product->title );
        } );
    }
}