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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('hash', 10);
            $table->string('name', 60);
            $table->string('first_surname', 40);
            $table->string('second_surname', 40);
            $table->string('telephone', 11);
            $table->string('email', 200);
            $table->date('birthdate');
            $table->string('credit');
            $table->string('civil_status');
            $table->tinyInteger('have_children')->nullable()->default(null);
            $table->string('spouse_status')->nullable()->default(0);
            $table->string('spouse_credit')->nullable()->default(null);
            $table->tinyInteger('assistance')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('registrations');
    }
};
