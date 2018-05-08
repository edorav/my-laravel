<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgencyUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('agency_user', function (Blueprint $table) {
            
            $table->increments('id');
            $table->integer('agency_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
            

            $table->foreign('agency_id')
                ->references('id')
                ->on('agencies')
                ->onDelete('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->unique(['agency_id', 'user_id'], 'unique');

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
        Schema::dropIfExists('agency_user');
    }
}
