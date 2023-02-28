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
        Schema::create('permissions', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->primary();
            $table->boolean('staff')->default(0);
            $table->boolean('valid')->default(0);
            $table->boolean('operations')->default(0);
            $table->boolean('academy')->default(0);
            $table->boolean('events')->default(0);
            $table->boolean('members')->default(0);
            $table->boolean('admin')->default(0);
            $table->timestamps();

            $table->foreign('id')->references('id')->on('users');
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
