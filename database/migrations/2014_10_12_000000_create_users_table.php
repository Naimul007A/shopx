<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'users', function ( Blueprint $table ) {
            $table->increments( 'id' );
            $table->string( 'name', 128 );
            $table->string( 'password', 128 );
            $table->string( 'phone', 32 );
            $table->string( 'email', 128 )->unique();
            $table->timestamp( 'last_login' )->nullable();
            $table->timestamp( 'email_verified_at' )->nullable();
            $table->string( 'email_verification_token', 56 )->nullable();
            $table->tinyInteger( 'email_verified' )->default( 0 );
            $table->softDeletes();
            $table->rememberToken();
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'users' );
    }
}