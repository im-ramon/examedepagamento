<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdicHabilitacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adic_habilitacaos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('altos_estudos_I', 4, 2);
            $table->float('altos_estudos_II', 4, 2);
            $table->float('aperfeicoamento', 4, 2);
            $table->float('especializacao', 4, 2);
            $table->float('formacao', 4, 2);
            $table->float('sem_formacao', 4, 2);
            $table->date('periodo_ini');
            $table->date('periodo_fim');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adic_habilitacaos');
    }
}
