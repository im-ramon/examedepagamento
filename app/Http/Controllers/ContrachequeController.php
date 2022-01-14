<?php

namespace App\Http\Controllers;

use App\Models\Contracheque;
use App\Http\Requests\StoreContrachequeRequest;
use App\Http\Requests\UpdateContrachequeRequest;
use Illuminate\Http\Request;

class ContrachequeController extends Controller
{
    // SAQUES
    public $data_contracheque = 0;

    public $soldo = 0;
    public $soldo_prop = 0;
    public $soldo_base = 0; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um "IF" para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.

    public $soldo_pg_real_base = 0; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um IF para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    public $soldo_pg_real_normal = 0; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    public $soldo_pg_real_prop = 0; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.

    public $compl_ct_soldo = 0;
    public $adic_tp_sv = 0;
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

    // DESCONTOS
    // public $pmil;
    // public $pmil_15;
    // public $pmil_30;
    // public $fusex_3;
    // public $desc_dep_fusex;
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

        $todos_pg_info = \App\Models\PgConstante::all()->toArray();
        $pg_real_info = \App\Models\PgConstante::find($formulario['pg_real'])->toArray();
        $pg_soldo_info = \App\Models\PgConstante::find($formulario['pg_soldo'])->toArray();
        $adic_hab_info = \App\Models\AdicHabilitacao::where('periodo_ini', '<', $formulario['data_contracheque'])
            ->where('periodo_fim', '>', $formulario['data_contracheque'])
            ->get()
            ->toArray()[0];


        //  ------------------------------------------------- TESTES -----------------------------------------------------//
        echo ('<pre>');

        echo ('<h1>pg_real_info</h1>');
        var_dump($pg_real_info);
        echo ('<hr>');

        echo ('<h1>pg_soldo_info</h1>');
        var_dump($pg_soldo_info);
        echo ('<hr>');

        // echo ('<h1>adic_hab_info</h1>');
        // var_dump($adic_hab_info);
        // echo ('<hr>');

        echo ('<h1>formulario</h1>');
        var_dump($formulario);
        echo ('<hr>');

        echo ('<h1>formulario</h1>');
        // dd($formulario);
        echo ('<hr>');

        echo ('</pre>');
        //  ------------------------------------------------- TESTES -----------------------------------------------------//


        $this->soldo($formulario, $pg_soldo_info, $pg_real_info);
        if ($this->soldo > 0 or $this->soldo_prop > 0) {
            $this->adicionaisTpSveDisp($formulario, $pg_real_info, $pg_soldo_info);
        }


        return view('app.fichaauxiliar', [
            'soldo' => $this->soldo,
            'soldo_prop' => $this->soldo_prop,
            'compl_ct_soldo' => $this->compl_ct_soldo,
            'adic_tp_sv' => $this->adic_tp_sv,
            'adic_comp_disp' => $this->adic_comp_disp,
        ]);
    }

    public function truncar($numero)
    {
        return floor($numero * 100) / 100;
    }

    public function soldo($formulario, $pg_soldo_info, $pg_real_info)
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

    public function adicionaisTpSveDisp($formulario, $pg_real_info, $pg_soldo_info)
    {
        $tpsv = $pg_soldo_info["soldo"] * $formulario["adic_tp_sv"];
        $adic_disp = $pg_real_info["soldo"] * $pg_real_info["adic_disp"];

        if ($tpsv > $adic_disp) {
            $this->adic_tp_sv = $this->truncar($this->soldo_base * ($formulario["adic_tp_sv"]) / 100);
            $this->adic_comp_disp = 0;
        } else {
            $this->adic_comp_disp = $this->truncar($this->soldo_pg_real_base * ($pg_real_info["adic_disp"]) / 100);
            $this->adic_tp_sv = 0;
        }
    }
}
