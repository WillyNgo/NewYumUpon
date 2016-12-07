<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->increments('reviewid');
            $table->string('title');
            $table->string('content');
            $table->integer('user')->unsigned()->index();
            $table->integer('resto')->unsigned()->index();
            $table->integer('rating');
            $table->timestamps();
            $table->foreign('user')->references('id')
                    ->on('users');
            $table->foreign('resto')->references('restoid')
                    ->on('restos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
