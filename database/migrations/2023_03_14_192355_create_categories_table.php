<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void {
        Schema::create( 'categories', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 128 )->unique();
            $table->string( 'slug', 128 )->unique();
            $table->string( 'banner', 128 );
            $table->unsignedInteger( 'category_id' )->default( 0 );
            $table->softDeletes();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'categories' );
    }
}