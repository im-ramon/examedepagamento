<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContrachequeDescontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracheque_descontos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('pmil', 4, 2);
            $table->string('pmil_pg', 255);
            $table->integer('pmil_15');
            $table->integer('pmil_30');
            $table->integer('fsuex_3');
            $table->integer('desc_dep_fusex');
            $table->integer('imposto_renda_dep');
            $table->integer('pnr');
            $table->float('ded_ad_adic_natal', 10, 2);
            $table->float('pens_judiciaria_1', 10, 2);
            $table->float('pens_judiciaria_2', 10, 2);
            $table->float('pens_judiciaria_3', 10, 2);
            $table->float('pens_judiciaria_4', 10, 2);
            $table->float('pens_judiciaria_5', 10, 2);
            $table->float('pens_judiciaria_6', 10, 2);
            $table->float('pens_judiciaria_7', 10, 2);
            $table->float('pens_judiciaria_8', 10, 2);
            $table->float('pens_judiciaria_9', 10, 2);
            $table->float('pens_judiciaria_10', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracheque_descontos');
    }
}
