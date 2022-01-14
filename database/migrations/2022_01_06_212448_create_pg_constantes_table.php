<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePgConstantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pg_constantes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pg', 255);
            $table->string('pg_abrev', 255);
            $table->float('soldo', 10, 2);
            $table->float('adic_mil', 4, 2);
            $table->float('adic_disp', 4, 2);
            $table->string('tipo', 255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pg_constantes');
    }
}
