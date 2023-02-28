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
        Schema::create('users_configs', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->boolean('last_ubi')->default(1);
            $table->string('ubication')->nullable();
            $table->boolean('use_fleet')->default(1);
            $table->integer('points')->default(0);
            $table->string('hub')->nullable();
            $table->unsignedBigInteger('id_rank')->default(0);
            $table->integer('tranfer_hours')->default(0);
            $table->integer('tranfer_flights')->default(0);
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
