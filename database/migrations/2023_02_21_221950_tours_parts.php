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
        Schema::create('tours_parts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_tour');
            $table->text('description')->nullable(true);
            $table->integer('parts')->unsigned();
            $table->string('departure');
            $table->string('arrival');
            $table->timestamps();

            $table->foreign('id_tour')->references('id')->on('tours');
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
