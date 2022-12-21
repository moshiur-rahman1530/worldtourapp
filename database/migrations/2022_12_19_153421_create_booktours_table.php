<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooktoursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booktours', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('tour_id');
            $table->string('tour_name');
            $table->string('tour_img');
            $table->text('tour_des');
            $table->string('price');
            $table->string('duration');
            $table->string('tour_date');
            $table->string('book_date');
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('booktours');
    }
}
