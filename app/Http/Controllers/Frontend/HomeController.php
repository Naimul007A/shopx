<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller {
    public function showHome() {
        $data             = [];
        $data['Products'] = Product::select( ['title', 'id', 'slug', 'price', 'sale_price'] )->where( 'status', 1 )->simplepaginate( 9 );
        return view( 'Frontend.home', $data );
    }
}