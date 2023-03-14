<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'products', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'title', 256 );
            $table->Text( 'short_description' );
            $table->longText( 'description' );
            $table->unsignedInteger( 'category_id' );
            $table->decimal( 'price', 8, 2 );
            $table->decimal( 'sale_price', 8, 2 )->nullable();
            $table->tinyInteger( 'status' )->default( 1 );
            $table->timestamps();
            $table->foreign( 'category_id' )->references( 'id' )->on( 'categories' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'products' );
    }
}