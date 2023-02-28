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
        Schema::create('tours_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tour');
            $table->unsignedBigInteger('id_part');
            $table->unsignedBigInteger('id_user');
            $table->text('comment_user')->nullable(true);
            $table->text('comment_staff')->nullable(true);
            $table->dateTime('dep_time');
            $table->dateTime('arr_time');
            $table->integer('stats')->unsigned()->nullable(true);

            $table->timestamps();

            $table->foreign('id_tour')->references('id')->on('tours');
            $table->foreign('id_part')->references('id')->on('tours_parts');
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
