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
        Schema::create('doms', function (Blueprint $table) {
            $table->id();
            $table->string('hash', 10);
            $table->string('name', 60);
            $table->string('first_surname', 40);
            $table->string('second_surname', 40);
            $table->string('telephone', 11);
            $table->string('email', 200);
            $table->tinyInteger('type_visit');
            $table->tinyInteger('bank')->nullable();
            $table->string('other')->nullable();
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
        Schema::dropIfExists('doms');
    }
};
