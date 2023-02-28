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
        Schema::create('flights_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('callsign');
            $table->string('departure');
            $table->string('arrival');
            $table->string('aircraft');
            $table->integer('state')->default(0);

            $table->string('simbrief')->nullable();
            $table->integer('type');
            $table->integer('id_regular')->nullable();
            $table->integer('red');

            $table->string('user_comments')->nullable();
            $table->string('staff_comments')->nullable();

            $table->dateTime('start_flight')->nullable();
            $table->dateTime('finish_flight')->nullable();

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
        //
    }
};
