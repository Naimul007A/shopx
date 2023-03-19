<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
    //Show cart function
    public function showCart() {
        dd( session()->all() );
    }

    // add to cart function
    public function addToCart( Request $request ) {
        $validetor = Validator::make( $request->all(), [
            'product_id' => 'required|numeric',
        ] );

        if ( $validetor->fails() ) {
            return redirect()->back()->withErrors( $validetor );
        } else {
            $product = Product::findorFail( $request->input( 'product_id' ) );

            $cart = session()->has( 'cart' ) ? session()->get( 'cart' ) : [];

            if ( array_key_exists( $product->id, $cart ) ) {

                $cart[$product->id]['quantity']++;

            } else {
                $cart[$product->id] = [
                    'title'    => $product->title,
                    'quantity' => 1,
                    'price'    => ( $product->sale_price !== null ) ? $product->sale_price : $product->price,
                ];
            }

            session( ['cart' => $cart] );

            return Redirect()->route( 'Frontend.addToCart' );

        }
    }
}