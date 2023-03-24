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
        // session()->flush();
        $data = [];
        if ( session()->has( 'cart' ) ) {
            $data['total'] = 0;
            $data['cart']  = session()->get( 'cart' );
            $data['total'] = array_sum( array_column( $data['cart'], 'sub_total' ) );

        } else {
            $data['cart'] = null;
        }

        return view( 'Frontend.cart', $data );

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

                $quantity                        = $cart[$product->id]['quantity']++;
                $cart[$product->id]['sub_total'] = (  ( $quantity + 1 ) * $cart[$product->id]['price'] );

            } else {
                $cart[$product->id] = [
                    'product_id' => $product->id,
                    'title'      => $product->title,
                    'quantity'   => 1,
                    'sub_total'  => ( $product->sale_price !== null ) ? $product->sale_price : $product->price,
                    'price'      => ( $product->sale_price !== null ) ? $product->sale_price : $product->price,
                ];
            }

            session( ['cart' => $cart] );

            return Redirect()->route( 'Frontend.addToCart' );

        }
    }
    // cart remove
    public function cartRemove( $id ) {
        session()->forget( 'cart.' . $id );
        return true;

    }
    ///product details  show
    public function showProduct( $slug ) {
        $data            = [];
        $data['product'] = Product::where( 'slug', $slug )->get();
        return view( 'Frontend.productDetails', $data );
    }
    //cart quantity increase
    public function cartincrease( $id ) {
        $cart                   = session()->get( 'cart' );
        $quantity               = $cart[$id]['quantity']++;
        $cart[$id]['sub_total'] = (  ( $quantity + 1 ) * $cart[$id]['price'] );

        session( ['cart' => $cart] );
        return "data changed";
    }
    //cart quantity decrease
    public function cartdecrease( $id ) {
        $cart                   = session()->get( 'cart' );
        $quantity               = $cart[$id]['quantity']--;
        $cart[$id]['sub_total'] = (  ( $quantity - 1 ) * $cart[$id]['price'] );

        session( ['cart' => $cart] );
        return "data changed";
    }
    //checkout page
    public function checkout() {
        $data = [];
        if ( session()->has( 'cart' ) ) {
            $data['total'] = 0;
            $data['cart']  = session()->get( 'cart' );
            $data['total'] = array_sum( array_column( $data['cart'], 'sub_total' ) );
            $data['count'] = count( $data['cart'] );
        } else {
            $data['cart'] = null;
        }
        return view( 'Frontend.checkout', $data );
    }
    //checkout proccess
    public function checkoutProccess( Request $request ) {
        dd( $request->all() );
    }
}