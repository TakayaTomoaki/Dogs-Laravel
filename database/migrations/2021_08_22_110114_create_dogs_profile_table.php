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
        Schema::create('dogs_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('user_id')->unique();
            $table->string('dog_name', 30);
            $table->date('dog_birthday');
            $table->boolean('dog_gender');
            $table->integer('dog_weight');
            $table->string('dog_father');
            $table->string('dog_mother');
            $table->string('dog_introduction')->nullable();
            $table->string('dog_image')->nullable();
            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
