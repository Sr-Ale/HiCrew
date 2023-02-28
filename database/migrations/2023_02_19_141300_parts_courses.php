<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parts_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_courses');
            $table->string('name');
            $table->integer('parts')->unsigned();
            $table->text('html')->nullable(true);
            $table->timestamps();

            $table->foreign('id_courses')->references('id')->on('courses');
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
    }
};
