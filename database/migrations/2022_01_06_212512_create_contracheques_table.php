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
            $table->unsignedBigInteger('contracheque_dados_id');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('contracheque_descontos_id');
            $table->unsignedBigInteger('contracheque_receitas_id');

            // Constraints (FKs)
            $table->foreign('contracheque_dados_id')->references('id')->on('contracheque_dados');
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('contracheque_descontos_id')->references('id')->on('contracheque_descontos');
            $table->foreign('contracheque_receitas_id')->references('id')->on('contracheque_receitas');
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
