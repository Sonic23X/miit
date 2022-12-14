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
        Schema::table('races', function (Blueprint $table) {
            $table->text('conekta_url');
        });

        Schema::table('canadevis', function (Blueprint $table) {
            $table->text('conekta_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('races', function (Blueprint $table) {
            $table->dropColumn('conekta_url');
        });

        Schema::table('canadevis', function (Blueprint $table) {
            $table->dropColumn('conekta_url');
        });
    }
};
