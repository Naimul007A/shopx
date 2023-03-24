<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        User::factory( 10 )->create();
        Category::factory( 10 )->create();
        Product::factory( 10 )->create();
        $products = Product::select( 'id' )->get();
        $url      = 'https://via.placeholder.com/640x480.png/002277?text=voluptate';
        foreach ( $products as $product ) {
            $product->addMediaFromUrl( $url )
                ->toMediaCollection();
        }

    }
}