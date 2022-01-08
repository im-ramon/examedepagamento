<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContrachequeRubricasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracheque_rubricas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // BASE
            $table->string('pg_real', 128);
            $table->string('pg_soldo', 128);

            // RECEITAS
            $table->integer('tipo_soldo');
            $table->float('soldo_cota_porcentagem', 6, 2);
            $table->integer('soldo_prop_divisor');
            $table->integer('soldo_prop_dividendo');
            $table->integer('compl_ct_soldo');
            $table->float('adic_tp_sv', 4, 2);
            $table->float('adic_comp_disp', 4, 2);
            $table->string('adic_hab_tipo', 128);
            $table->integer('adic_perm');
            $table->string('adic_comp_org_tipo', 128);
            $table->float('adic_comp_org_percet', 4, 2);
            $table->string('adic_comp_org_pg', 128);
            $table->integer('hvoo');
            $table->float('hvoo_percet', 6, 2);
            $table->string('hvoo_pg', 128);
            $table->integer('acres_25_soldo');
            $table->integer('adic_ferias');
            $table->integer('adic_pttc');
            $table->integer('adic_natalino');
            $table->integer('adic_natalino_qtd_meses');
            $table->float('adic_natalino_valor_adiantamento', 10, 2);
            $table->integer('aux_pre_escolar_qtd');
            $table->integer('aux_invalidez');
            $table->float('aux_transporte', 10, 2);
            $table->integer('aux_fard');
            $table->integer('aux_fard_primeiro');
            $table->integer('aux_alim_c');
            $table->integer('aux_alim_5x');
            $table->integer('aux_alim_5x_qtd_dias');
            $table->integer('aux_natalidade');
            $table->integer('aux_natalidade_qtd_filhos');
            $table->float('grat_loc_esp', 10, 2);
            $table->integer('grat_repr_cmdo');
            $table->integer('grat_repr_2_dias');
            $table->string('grat_repr_2_pg', 128);
            $table->float('dp_excmb_art_9_valor', 10, 2);

            // DESCONTOS
            $table->integer('pmil');
            $table->string('pmil_pg', 255);
            $table->integer('pmil_15');
            $table->integer('pmil_30');
            $table->integer('fusex_3');
            $table->integer('desc_dep_fusex');
            $table->integer('pnr');
            $table->integer('pnr_tipo');
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

            // DADOS DOS DEPENDENTES
            $table->integer('salario_familia_dep');
            $table->integer('imposto_renda_dep');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracheque_rubricas');
    }
}
