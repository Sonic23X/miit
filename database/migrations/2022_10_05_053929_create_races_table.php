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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->string('hash', 10);
            $table->string('name', 60);
            $table->string('first_surname', 40);
            $table->string('second_surname', 40);
            $table->string('telephone', 11);
            $table->string('email', 200);
            $table->date('birthdate');
            $table->tinyInteger('gender');
            $table->string('size');
            $table->integer('state');
            $table->integer('city')->nullable();
            $table->string('doc')->nullable();
            $table->tinyInteger('payment_mode')->default(0)->nullable();
            $table->tinyInteger('payment_status')->default(0)->nullable();
            $table->tinyInteger('assistance')->default(0);
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
        Schema::dropIfExists('races');
    }
};
