<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('trip_users', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('trip_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            

            $table->foreign('trip_id')
                ->references('id')
                ->on('trips')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unique(['trip_id', 'user_id'], 'unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('trip_users');
    }
}
