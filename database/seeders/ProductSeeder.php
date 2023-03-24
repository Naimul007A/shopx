<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Product::Factory( 20 )->create();

        // $products = Product::select( 'id' )->get();
        // $url      = 'https://via.placeholder.com/640x480.png/002277?text=voluptate';
        // foreach ( $products as $product ) {
        //     $product->addMediaFromUrl( $url )
        //         ->toMediaCollection();
        // }
    }

}