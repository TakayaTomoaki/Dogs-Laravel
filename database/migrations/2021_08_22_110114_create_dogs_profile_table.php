<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('dog_name', 20);
            $table->string('location', 5);
            $table->date('dog_birthday');
            $table->boolean('dog_gender');
            $table->integer('dog_weight');
            $table->string('dog_father', 5);
            $table->string('dog_daddy', 30);
            $table->string('dog_mother', 5);
            $table->string('dog_mommy', 30);
            $table->string('dog_introduction', 200);
            $table->string('dog_image')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        DB::statement('ALTER TABLE dogs_profiles ADD FULLTEXT INDEX ft_index (`dog_name`, `location`, `dog_daddy`, `dog_mommy`, `dog_introduction`) WITH PARSER ngram');
    }





    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dogs_profile');
        Schema::table('dogs_profiles', function ($table) {
            $table->dropIndex('ft_index');
        });
    }
}
