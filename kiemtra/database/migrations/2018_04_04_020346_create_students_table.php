<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname', 100);
            $table->string('nickname', 100);
            $table->boolean('gender');
            $table->string('email', 150);
            $table->integer('phone');
            $table->dateTime('birthday');
            $table->text('country');
            $table->string('hobbies', 100);

            $table->integer('class_id')->unsigned()->index()->nullable();

            $table->foreign('class_id')
                    ->references('id')
                    ->on('classes')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
