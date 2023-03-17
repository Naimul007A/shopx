<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Category extends Model {
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'name',
        'slug',
        'banner',
        'category_id',

    ];
    public static function boot() {
        parent::boot();
        static::creating( function ( $categoty ) {
            $categoty->slug = Str::slug( $categoty->name );
        } );
    }
}