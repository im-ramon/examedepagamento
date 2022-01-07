<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContrachequeReceitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracheque_receitas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('tipo_soldo');
            $table->float('soldo_cota_porcentagem', 4, 2);
            $table->integer('soldo_prop_divisor');
            $table->integer('soldo_prop_dividendo');
            $table->float('compl_ct_soldo', 10, 2);
            $table->integer('acres_25_soldo');
            $table->float('adic_comp_disp', 4, 2);
            $table->float('adic_tp_sv', 4, 2);
            $table->string('adic_comp_org_tipo', 128);
            $table->string('adic_comp_org_pg', 128);
            $table->float('adic_comp_org_percet', 4, 2);
            $table->float('adic_perm', 4, 2);
            $table->integer('aux_fard_tipo');
            $table->integer('aux_alim_c');
            $table->integer('aux_alim_5x');
            $table->float('aux_transporte', 10, 2);
            $table->float('grat_loc_esp', 10, 2);
            $table->integer('grat_repr_2_dias');
            $table->string('grat_repr_2_pg', 128);
            $table->integer('grat_repr_10');
            $table->integer('aux_invalidez');
            $table->integer('aux_natalidade_qtd_filhos');
            $table->integer('aux_pre_escolar_qtd');
            $table->integer('salario_familia_dep');
            $table->integer('adic_ferias');
            $table->integer('adic_pttc');
            $table->integer('adic_natalino_parcelas_qtd');
            $table->float('adic_natalino_valor_1_parcela', 10, 2);
            $table->string('adic_hab_tipo', 128);
            $table->float('dp_excmb_art_9', 10, 2);
            $table->integer('comp_pecuniaria');
            // $table->integer('pg_constants_pg_real');
            // $table->integer('pg_constants_pg_soldo');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracheque_receitas');
    }
}
