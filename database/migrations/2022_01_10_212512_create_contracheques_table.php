<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContrachequesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracheques', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('ficha_auxiliar_json', 8000);
            $table->string('valorReceitasCC_array', 512)->default('-');
            $table->string('valorDescontosCC_array', 512)->default('-');
            $table->string('observacoes', 1024)->default('-');
            $table->string('user_email');

            $table->foreign('user_email')->references('email')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracheques');
    }
}
