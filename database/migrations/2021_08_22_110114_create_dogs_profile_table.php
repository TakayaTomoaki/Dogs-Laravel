<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDogsProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogs_profile', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('dog_name');
            $table->string('dog_age');
            $table->string('dog_gender');
            $table->string('dog_weight');
            $table->string('dog_father');
            $table->string('dog_mother');
            $table->string('dog_introduction');
            $table->string('dog_image')->nullable();
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
        Schema::dropIfExists('dogs_profile');
    }
}
