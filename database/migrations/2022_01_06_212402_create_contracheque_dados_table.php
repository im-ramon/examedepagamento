<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContrachequeDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracheque_dados', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('nome_examinado', 255);
            $table->string('universo', 255);
            $table->integer('maior_65');
            $table->integer('isento_IR');
            $table->date('data_contracheque');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracheque_dados');
    }
}
