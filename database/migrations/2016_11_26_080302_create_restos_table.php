<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restos', function (Blueprint $table) {
            $table->increments('restoid');
            $table->string('name');           
            $table->string('genre');
            $table->string('pricing');
            $table->integer('addedBy')->nullable();
            $table->string('address');
            $table->string('city')->nullable();
            $table->string('postalcode')->nullable();
            $table->decimal('longitude', 10, 6);
            $table->decimal('latitude', 10, 6);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restos');
    }
}
