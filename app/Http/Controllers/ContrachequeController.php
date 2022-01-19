<?php

namespace App\Http\Controllers;

use App\Models\Contracheque;
use App\Http\Requests\StoreContrachequeRequest;
use App\Http\Requests\UpdateContrachequeRequest;
use Illuminate\Http\Request;

class ContrachequeController extends Controller
{
    // RECEITAS
    public $data_contracheque = 0;

    public $soldo = 0;
    public $soldo_prop = 0;
    public $soldo_base = 0; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um "IF" para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    // -------------------------- //
    public $bruto_ir_descontos = 0;
    public $bruto_total = 0;
    // -------------------------- //
    public $soldo_pg_real_base = 0; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um IF para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    public $soldo_pg_real_normal = 0; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    public $soldo_pg_real_prop = 0; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    // -------------------------- //
    public $compl_ct_soldo = 0;
    public $adic_tp_sv = 0;
    public $adic_mil = 0;
    public $adic_comp_disp = 0;
    public $adic_hab = 0;
    public $adic_perm = 0;
    public $adic_comp_org = 0;
    public $hvoo = 0;
    public $acres_25_soldo = 0;
    public $salario_familia = 0;
    public $adic_ferias = 0;
    public $adic_pttc = 0;
    public $adic_natalino = 0;
    public $aux_pre_escolar = 0;
    public $aux_invalidez = 0;
    public $aux_transporte = 0;
    public $aux_fard = 0;
    public $aux_alim_c = 0;
    public $aux_alim_5x = 0;
    public $aux_natalidade = 0;
    public $grat_loc_esp = 0;
    public $grat_repr_cmdo = 0;
    public $grat_repr_2 = 0;
    public $dp_excmb_art_9 = 0;

    // DESCONTOS ---------------- //
    public $pmil = 0;
    public $pmil_15 = 0;
    public $pmil_30 = 0;
    // public $fusex_3;
    // public $desc_dep_fusex;
    public $adic_natalino_valor_adiantamento = 0;
    // public $pnr;
    // public $pens_judiciaria_1;
    // public $pens_judiciaria_2;
    // public $pens_judiciaria_3;
    // public $pens_judiciaria_4;
    // public $pens_judiciaria_5;
    // public $pens_judiciaria_6;
    // public $pens_judiciaria_7;
    // public $pens_judiciaria_8;
    // public $pens_judiciaria_9;
    // public $pens_judiciaria_10;
    // public $imposto_renda;


    public function formulario()
    {
        $pg_info = \App\Models\PgConstante::all();
        return view('app.formulario', ['pg_info' => $pg_info]);
    }

    public function fichaauxiliar()
    {
        $formulario = $_POST;

        $pg_real_info = \App\Models\PgConstante::find($formulario['pg_real'])->toArray();
        $pg_soldo_info = \App\Models\PgConstante::find($formulario['pg_soldo'])->toArray();
        $adic_hab_info = \App\Models\AdicHabilitacao::where('periodo_ini', '<', $formulario['data_contracheque'])->where('periodo_fim', '>', $formulario['data_contracheque'])->get()->toArray()[0];

        //  ------------------------------------------------- TESTES -----------------------------------------------------//
        echo ('<h1>formulario</h1>');
        var_dump($formulario);
        echo ('<hr>');
        //  ------------------------------------------------- TESTES -----------------------------------------------------//

        $this->soldo($formulario, $pg_soldo_info, $pg_real_info);
        if ($this->soldo > 0 or $this->soldo_prop > 0) {
            $this->adicMil($formulario, $pg_soldo_info, $this->soldo_base);
            $this->adicHab($formulario, $adic_hab_info);
            $this->adicionaisTpSveDisp($formulario, $pg_real_info, $pg_soldo_info);
            $this->adicCompOrg($formulario);
            $this->hVoo($formulario);
            $this->adicPerm($formulario);
            $this->adicPttc($formulario);
            $this->gratLocEsp($formulario);
            $this->gratRepr2($formulario);
            $this->gratReprCmdo($formulario);
            $this->acres25Soldo($formulario);
            $this->auxTransporte($formulario);
            $this->auxFard($formulario);
            $this->auxAlimC($formulario, $pg_real_info);
            $this->auxAlim5x($formulario);
            $this->auxInvalidez($formulario);
            $this->auxNatalidade($formulario);
            $this->salarioFamilia($formulario);

            // Dependem do bruto (IR e Descontos):
            $this->auxPreEscolar($formulario);
            $this->adicFerias($formulario);
            $this->adicNatalino($formulario);

            //Exclusivo para pensionada de Ex-Cmbt:
            $this->dpExcmbArt9($formulario);


            //DESCONTOS
            $this->pMil($formulario);
            $this->pMil15($formulario);
            $this->pMil30($formulario);
        }
        $this->bruto_total = $this->brutoTotal();
        $this->bruto_ir_descontos = $this->brutoIrDescontos();


        return view('app.fichaauxiliar', [
            'soldo' => $this->soldo,
            'soldo_prop' => $this->soldo_prop,
            'compl_ct_soldo' => $this->compl_ct_soldo,
            'adic_tp_sv' => $this->adic_tp_sv,
            'adic_comp_disp' => $this->adic_comp_disp,
            'adic_hab' => $this->adic_hab,
            'adic_mil' => $this->adic_mil,
            'adic_perm' => $this->adic_perm,
            'adic_comp_org' => $this->adic_comp_org,
            'hvoo' => $this->hvoo,
            'adic_natalino' => $this->adic_natalino,
            'adic_pttc' => $this->adic_pttc,
            'adic_ferias' => $this->adic_ferias,
            'acres_25_soldo' => $this->acres_25_soldo,
            'grat_loc_esp' => $this->grat_loc_esp,
            'grat_repr_2' => $this->grat_repr_2,
            'grat_repr_cmdo' => $this->grat_repr_cmdo,
            'aux_pre_escolar' => $this->aux_pre_escolar,
            'aux_transporte' => $this->aux_transporte,
            'aux_alim_c' => $this->aux_alim_c,
            'aux_alim_5x' => $this->aux_alim_5x,
            'aux_natalidade' => $this->aux_natalidade,
            'aux_invalidez' => $this->aux_invalidez,
            'salario_familia' => $this->salario_familia,
            'aux_fard' => $this->aux_fard,
            'dp_excmb_art_9' => $this->dp_excmb_art_9,
            'adic_natalino_valor_adiantamento' => $this->adic_natalino_valor_adiantamento,
            'bruto_total' => $this->bruto_total,
            'bruto_ir_descontos' => $this->bruto_ir_descontos,

            'pmil' => $this->pmil,
            'pmil_15' => $this->pmil_15,
            'pmil_30' => $this->pmil_30,
        ]);
    }

    private function truncar($numero)
    {
        return floor($numero * 100) / 100;
    }

    private function brutoTotal()
    {
        return array_sum([
            $this->soldo_base,
            $this->compl_ct_soldo,
            $this->adic_tp_sv,
            $this->adic_comp_disp,
            $this->adic_hab,
            $this->adic_mil,
            $this->adic_perm,
            $this->adic_comp_org,
            $this->hvoo,
            $this->acres_25_soldo,
            $this->salario_familia,
            $this->adic_ferias,
            $this->adic_pttc,
            $this->adic_natalino,
            $this->aux_pre_escolar,
            $this->aux_invalidez,
            $this->aux_transporte,
            $this->aux_fard,
            $this->aux_alim_c,
            $this->aux_alim_5x,
            $this->aux_natalidade,
            $this->grat_loc_esp,
            $this->grat_repr_cmdo,
            $this->grat_repr_2
        ]);
    }

    private function brutoIrDescontos()
    {
        return array_sum([
            $this->soldo_base,
            $this->compl_ct_soldo,
            $this->adic_tp_sv,
            $this->adic_comp_disp,
            $this->adic_hab,
            $this->adic_mil,
            $this->adic_perm,
            $this->adic_comp_org,
            $this->hvoo,
            $this->acres_25_soldo,
            $this->adic_pttc,
            $this->grat_loc_esp,
            $this->grat_repr_cmdo,
            $this->grat_repr_2
        ]);
    }

    private function soldo($formulario, $pg_soldo_info, $pg_real_info)
    {
        if ($formulario["tipo_soldo"] == '1') {
            $pg_soldo_info["pg"] == "- Não recebe -" ? $this->soldo = 0 : $this->soldo = $pg_soldo_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100);
            $pg_real_info["pg"] == "- Não recebe -" ? $this->soldo_pg_real_normal = 0 : $this->soldo_pg_real_normal = $pg_real_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100);
        } elseif ($formulario["tipo_soldo"] == '2') {
            $pg_soldo_info["pg"] == "- Não recebe -" ? $this->soldo_prop = 0 : $this->soldo_prop = ($pg_soldo_info["soldo"] * ($formulario["soldo_prop_cota_porcentagem"] / 100)) * ($formulario["soldo_cota_porcentagem"] / 100);
            $pg_real_info["pg"] == "- Não recebe -" ? $this->soldo_pg_real_prop = 0 : $this->soldo_pg_real_prop = ($pg_real_info["soldo"] * ($formulario["soldo_prop_cota_porcentagem"] / 100)) * ($formulario["soldo_cota_porcentagem"] / 100);

            if ($formulario["compl_ct_soldo"] == '1') {
                $this->compl_ct_soldo = ($pg_soldo_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100)) - $this->soldo_prop;
            }
        }
        $this->soldo_base = $this->soldo + $this->soldo_prop;
        $this->soldo_pg_real_base = $this->soldo_pg_real_normal + $this->soldo_pg_real_prop;
    }

    private function adicionaisTpSveDisp($formulario, $pg_real_info, $pg_soldo_info)
    {
        $tpsv = $pg_soldo_info["soldo"] * $formulario["adic_tp_sv"];
        $adic_disp = $pg_real_info["soldo"] * $pg_real_info["adic_disp"];

        if ($tpsv > $adic_disp) {
            $this->adic_tp_sv = $this->truncar($this->soldo_base * ($formulario["adic_tp_sv"]) / 100);
            $this->adic_comp_disp = 0;
        } elseif ($formulario["adic_disp"] == '1') {
            $this->adic_comp_disp = $this->truncar($this->soldo_pg_real_base * ($pg_real_info["adic_disp"]) / 100);
            $this->adic_tp_sv = 0;
        }
    }

    private function adicHab($formulario, $adic_hab_info)
    {
        if ($formulario["adic_hab_tipo"] != 'sem_formacao') {
            $this->adic_hab = $this->truncar($adic_hab_info[$formulario["adic_hab_tipo"]] * $this->soldo_base / 100);
        }
    }

    private function adicMil($formulario, $pg_soldo_info, $soldo_base)
    {
        if ($formulario["adic_mil"] == 1) {
            $this->adic_mil = $this->truncar($pg_soldo_info["adic_mil"] * $soldo_base / 100);
        }
    }

    private function adicPerm($formulario)
    {
        if ($formulario["adic_perm"] > 0) {
            $this->adic_perm = $this->truncar($formulario["adic_perm"] * $this->soldo_base / 100);
        }
    }

    private function adicCompOrg($formulario)
    {
        if ($formulario["adic_comp_org_tipo"] != '0') {
            $soldo_base_adic = \App\Models\PgConstante::find($formulario['adic_comp_org_pg'])->toArray()["soldo"];
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_cota_porcentagem"] / 100);
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_prop_cota_porcentagem"] / 100);
            $this->adic_comp_org = $this->truncar($soldo_base_adic * $formulario['adic_comp_org_percet'] / 100);
        }
    }

    private function hVoo($formulario)
    {
        if ($formulario["f_hvoo"] == 1) {
            $soldo_base_adic = \App\Models\PgConstante::find($formulario['hvoo_pg'])->toArray()["soldo"];
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_cota_porcentagem"] / 100);
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_prop_cota_porcentagem"] / 100);
            $this->hvoo = $this->truncar($soldo_base_adic * $formulario['hvoo_percet'] / 100);
        }
    }

    private function acres25Soldo($formulario)
    {
        if ($formulario["acres_25_soldo"] == '1') {
            $this->acres_25_soldo = $this->truncar($this->soldo_base * 0.25);
        }
    }

    private function salarioFamilia($formulario)
    {
        if ($formulario["salario_familia_dep"] > 0) {
            $this->salario_familia = $formulario["salario_familia_dep"] * 0.16;
        }
    }

    private function auxInvalidez($formulario)
    {
        $valor_minimo = 1520;
        $valor_a_pagar = 0;
        if ($formulario["aux_invalidez"] == 1) {
            $valor_a_pagar = $this->soldo_base * 0.25;
            $this->aux_invalidez = $this->truncar($valor_minimo > $valor_a_pagar ? $valor_minimo : $valor_a_pagar);
        }
    }

    private function auxTransporte($formulario)
    {
        $cota_parte = $this->truncar(($this->soldo_base / 30 * 22) * 0.06);
        if ($formulario["aux_transporte"] > 0) {
            $this->aux_transporte = $formulario["aux_transporte"] - $cota_parte;
        }
    }

    private function auxFard($formulario)
    {
        if ($formulario["aux_fard"] == 1) {
            $this->aux_fard = $this->soldo_base;

            if ($formulario["aux_fard_primeiro"] == 1) {
                $this->aux_fard = $this->aux_fard + ($this->soldo_base / 2);
            }
        }
    }

    private function gratReprCmdo($formulario)
    {
        if ($formulario["grat_repr_cmdo"] == 1) {
            $this->grat_repr_cmdo = $this->truncar($this->soldo_base * 0.10);
        }
    }

    private function adicFerias($formulario)
    {
        if ($formulario["adic_ferias"] == 1) {
            if ($formulario["adic_pttc"] == 1) {
                $this->adic_ferias = $this->truncar($this->adic_pttc / 3);
            } else {
                $this->adic_ferias = $this->truncar($this->brutoIrDescontos() / 3);
            }
        }
    }

    private function adicPttc($formulario)
    {
        if ($formulario["adic_pttc"] == 1) {
            $this->adic_pttc = $this->truncar(array_sum([
                $this->soldo_base,
                $this->adic_tp_sv,
                $this->adic_comp_disp,
                $this->adic_hab,
                $this->adic_mil,
                $this->adic_perm,
                $this->adic_comp_org,
                $this->hvoo,
                $this->acres_25_soldo,
                $this->grat_loc_esp,
                $this->grat_repr_cmdo,
            ]) * 0.3);
        }
    }

    private function adicNatalino($formulario)
    {
        if ($formulario["adic_natalino"] == 1) {
            $this->adic_natalino = $this->truncar($formulario["adic_natalino_qtd_meses"] / 12 * ($this->brutoIrDescontos()));
        }

        if ($formulario["adic_natalino_valor_adiantamento"] > 0) {
            $this->adic_natalino_valor_adiantamento = $formulario["adic_natalino_valor_adiantamento"];
        }
    }

    private function auxPreEscolar($formulario)
    {
        $valor_base_pres_escolar = 321;
        $bruto = $this->brutoIrDescontos();
        $soldo_Sd = \App\Models\PgConstante::where('pg', '=', 'SOLDADO DO EXERCITO')->get()->toArray()[0]['soldo'];
        $cota_parte = $bruto / $soldo_Sd;

        if ($formulario["aux_pre_escolar_qtd"] > 0) {
            if ($cota_parte > 0 and $cota_parte <= 5) {
                $cota_parte = 0.05;
            } elseif ($cota_parte > 5 and $cota_parte <= 10) {
                $cota_parte = 0.10;
            } elseif ($cota_parte > 10 and $cota_parte <= 15) {
                $cota_parte = 0.15;
            } elseif ($cota_parte > 15 and $cota_parte <= 20) {
                $cota_parte = 0.20;
            } elseif ($cota_parte > 20) {
                $cota_parte = 0.25;
            }

            $this->aux_pre_escolar = $valor_base_pres_escolar - ($cota_parte * $valor_base_pres_escolar);
        }
    }

    private function auxAlimC($formulario, $pg_real_info)
    {
        if ($formulario["aux_alim_c"] == 1) {
            if (
                $pg_real_info["pg_abrev"] == 'Cb Eng' or
                $pg_real_info["pg_abrev"] == 'Cb N Eng' or
                $pg_real_info["pg_abrev"] == 'Sd Esp' or
                $pg_real_info["pg_abrev"] == 'Sd 2A Cl' or
                $pg_real_info["pg_abrev"] == 'Sd 3A Cl' or
                $pg_real_info["pg_abrev"] == 'Sd Eng' or
                $pg_real_info["pg_abrev"] == 'Sd Rcr' or
                $pg_real_info["pg_abrev"] == 'TF Mor' or
                $pg_real_info["pg_abrev"] == 'TF 1Cl' or
                $pg_real_info["pg_abrev"] == 'TF 2Cl'
            ) {
                $this->aux_alim_c = 270;
            }
        }
    }

    private function auxAlim5x($formulario)
    {
        if ($formulario["aux_alim_5x"] > 0) {
            $this->aux_alim_5x = $formulario["aux_alim_5x"] * 9;
        }
    }
    private function auxNatalidade($formulario)
    {
        if ($formulario["aux_natalidade"] > 0) {
            if ($formulario["aux_natalidade"] == 1) {
                $this->aux_natalidade = $this->soldo_base;
            } elseif ($formulario["aux_natalidade"] == 2) {
                $this->aux_natalidade = $this->soldo_base + ($this->soldo_base / 2);
            } elseif ($formulario["aux_natalidade"] > 2) {
                $this->aux_natalidade = $this->soldo_base + ($this->soldo_base / 2) + (($formulario["aux_natalidade"] - 1) * ($this->soldo_base / 2));
            }
        }
    }

    private function gratLocEsp($formulario)
    {
        if ($formulario["grat_loc_esp"] == 'A') {
            $this->grat_loc_esp = $this->soldo_base * 0.2;
        } elseif ($formulario["grat_loc_esp"] == 'B') {
            $this->grat_loc_esp = $this->soldo_base * 0.1;
        }
    }

    private function gratRepr2($formulario)
    {
        if ($formulario["grat_repr_2"] > 0) {
            $soldoBase = \App\Models\PgConstante::find($formulario['grat_repr_2_pg'])->toArray()["soldo"];
            $this->grat_repr_2 = $this->truncar($soldoBase * 2 * $formulario["grat_repr_2"] / 100);
        }
    }

    private function dpExcmbArt9($formulario)
    {
        if ($formulario["dp_excmb_art_9"] > 0) {
            $this->dp_excmb_art_9 = $formulario["dp_excmb_art_9"];
        }
    }

    private function pMil($formulario)
    {
        if ($formulario["pmil"] == '1') {
            if ($formulario["pmilmesmopg"] != '1') {
                $soldo_base_pmil = \App\Models\PgConstante::find($formulario['pmil_pg'])->toArray()["soldo"];
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_cota_porcentagem"] / 100);
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_prop_cota_porcentagem"] / 100);

                $porcentagem = (($soldo_base_pmil - $this->soldo_base) * 100) / $this->soldo_base;
                $novo_bruto = $this->brutoIrDescontos() + (($this->brutoIrDescontos() * $porcentagem) / 100);
                $this->pmil = $this->truncar($novo_bruto * 0.105);
            } else {
                $this->pmil = $this->truncar($this->brutoIrDescontos() * 0.105);
            }
        }
    }

    private function pMil15($formulario)
    {
        if ($formulario["pmil_15"] == '1') {
            if ($formulario["pmilmesmopg"] != '1') {
                $soldo_base_pmil = \App\Models\PgConstante::find($formulario['pmil_pg'])->toArray()["soldo"];
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_cota_porcentagem"] / 100);
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_prop_cota_porcentagem"] / 100);

                $porcentagem = (($soldo_base_pmil - $this->soldo_base) * 100) / $this->soldo_base;
                $novo_bruto = $this->brutoIrDescontos() + (($this->brutoIrDescontos() * $porcentagem) / 100);
                $this->pmil_15 = $this->truncar($novo_bruto * 0.015);
            } else {
                $this->pmil_15 = $this->truncar($this->brutoIrDescontos() * 0.015);
            }
        }
    }

    private function pMil30($formulario)
    {
        if ($formulario["pmil_30"] == '1') {
            if ($formulario["pmilmesmopg"] != '1') {
                $soldo_base_pmil = \App\Models\PgConstante::find($formulario['pmil_pg'])->toArray()["soldo"];
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_cota_porcentagem"] / 100);
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_prop_cota_porcentagem"] / 100);

                $porcentagem = (($soldo_base_pmil - $this->soldo_base) * 100) / $this->soldo_base;
                $novo_bruto = $this->brutoIrDescontos() + (($this->brutoIrDescontos() * $porcentagem) / 100);
                $this->pmil_30 = $this->truncar($novo_bruto * 0.03);
            } else {
                $this->pmil_30 = $this->truncar($this->brutoIrDescontos() * 0.03);
            }
        }
    }
}
