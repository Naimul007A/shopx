<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'orders', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->unsignedInteger( 'user_id' );
            $table->string( 'customer_name', 56 );
            $table->string( 'customer_phone', 15 );
            $table->string( 'customer_email', 56 );
            $table->string( 'customer_address', 250 );
            $table->string( 'customer_state', 56 );
            $table->string( 'customer_zip', 56 );
            $table->decimal( 'total_price', 8, 2 );
            $table->timestamps();
            $table->foreign( 'user_id' )->references( 'id' )->on( 'users' )->onDelete( 'cascade' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'orders' );
    }
}