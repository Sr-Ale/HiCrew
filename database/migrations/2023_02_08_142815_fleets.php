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
        Schema::create('fleets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('type');
            $table->unsignedBigInteger('hub');
            $table->string('registration');
            $table->string('name');
            $table->string('location');
            $table->boolean('boocked')->default(0);
            $table->timestamps();

            $table->foreign('type')->references('id')->on('aircrafts');
            $table->foreign('hub')->references('id')->on('hubs');
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
