<?php

namespace App\Http\Controllers;

use App\Models\Contracheque;
use App\Http\Requests\StoreContrachequeRequest;
use App\Http\Requests\UpdateContrachequeRequest;
use Illuminate\Http\Request;

class ContrachequeController extends Controller
{
    public $data_contracheque = 0;

    public $valoresNaoPrevisto = [];

    public $calculos = [
        'receitas' => [
            'bruto_total' => ['financeiro' => ['valor' => 0, 'porcentagem' => '-'], 'rubrica' => 'BRUTO TOTAL'],
            // 'bruto_ir_descontos' => ['financeiro' => ['valor' => 0, 'porcentagem' => '-'], 'rubrica' => 'BRUTO PARA IR'],
        ],
        'descontos' => [
            'descontos_total' => ['financeiro' => ['valor' => 0, 'porcentagem' => '-'], 'rubrica' => 'DESCONTOS TOTAL']
        ]
    ];

    public $soldo = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $soldo_prop = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $soldo_base = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um "IF" para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    public $soldo_pg_real_base = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um IF para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    public $soldo_pg_real_normal = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    public $soldo_pg_real_prop = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    public $compl_ct_soldo = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $adic_natal_bruto = 0; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $adic_pttc = 0; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $soma_para_descontos = 0; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $bruto_ir = 0; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $abatimentos_ir = 0; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $abatimentos_ir_adic_natal = 0; // Atributo utilizado para realizar os cálculos dentro do sistema
    public $dp_excmb_art_9 = ['valor' => 0, 'porcentagem' => '-']; // Atributo utilizado para realizar os cálculos dentro do sistema

    public function gerarContracheque() //GET
    {
        if ($_GET) {
            $formulario = $_GET;
            $todos_pg_info = \App\Models\PgConstante::all()->toArray();
            $pg_real_info = \App\Models\PgConstante::find($formulario['pg_real'])->toArray();
            $pg_soldo_info = \App\Models\PgConstante::find($formulario['pg_soldo'])->toArray();
            $adic_hab_info = \App\Models\AdicHabilitacao::where('periodo_ini', '<', $formulario['data_contracheque'])->where('periodo_fim', '>', $formulario['data_contracheque'])->get()->toArray()[0];
            $this->calculos['informacoes']['date'] = $formulario['data_contracheque'];
            $this->calculos['informacoes']['pg_real_info'] = $pg_real_info;

            $this->soldo($formulario, $pg_soldo_info, $pg_real_info);

            //Exclusivo para pensionada de Ex-Cmbt:
            $this->dpExcmbArt9($formulario);
            if ($this->soldo_base['valor'] > 0 and $this->dp_excmb_art_9['valor'] == 0) {
                $this->adicMil($formulario, $pg_soldo_info, $this->soldo_base['valor']);
                $this->adicHab($formulario, $adic_hab_info);
                $this->adicionaisTpSveDisp($formulario, $pg_real_info, $pg_soldo_info);
                $this->adicCompOrg($formulario, $todos_pg_info);
                $this->hVoo($formulario, $todos_pg_info);
                $this->adicPerm($formulario);
                $this->adicPttc($formulario);
                $this->gratLocEsp($formulario);
                $this->gratRepr2($formulario, $todos_pg_info);
                $this->gratReprCmdo($formulario);
                $this->acres25Soldo($formulario);
                $this->auxTransporte($formulario);
                $this->auxFard($formulario);
                $this->auxAlimC($formulario, $pg_real_info);
                $this->auxAlimX($formulario);
                $this->auxInvalidez($formulario);
                $this->auxNatalidade($formulario);
                $this->salarioFamilia($formulario);

                // Dependem do bruto (IR e Descontos):
                $this->auxPreEscolar($formulario);
                $this->adicFerias($formulario);
                $this->adicNatalino($formulario);

                //DESCONTOS
                $this->pMil($formulario, $todos_pg_info);
                $this->pMil15($formulario, $todos_pg_info);
                $this->pMil30($formulario, $todos_pg_info);
                $this->fusex3($formulario);
                $this->descDepFusex($formulario);
                $this->pnr($formulario);
                $this->pensJudiciaria($formulario);

                $this->gerenciaValoresIndisponiveis($formulario);

                $this->impostoRendaMensal($formulario);
                $this->impostoRendaAdicNatal($formulario);
                $this->impostoRendaAdicFerias($formulario);
            }

            return $this->calculos;
        } else {
            return response()->json(['erro' => 'Não foi possível realizar os cálculos. Erro 404.'], 404);
        }
    }

    public function create()
    {
        //
    }

    public function store(StoreContrachequeRequest $request)
    {
        $insert = \App\Models\Contracheque::create($request->all());
        return $insert;
    }

    public function recuperarContracheques(Contracheque $Contracheque, $email)
    {
        $contracheques = Contracheque::where('user_email', '=', $email)->get(['id', 'ficha_auxiliar_json', 'valorReceitasCC_array', 'valorDescontosCC_array', 'observacoes']);
        return ['contracheques' => $contracheques];
    }

    public function edit(Request $request, Contracheque $Contracheque)
    {
        //
    }

    public function update(Request $request, Contracheque $contracheque, $id) // PUT e PATCH
    {
        $update = \App\Models\Contracheque::where('id', '=', $id)->update($request->all());
        return $update;
    }

    public function destroy(Contracheque $Contracheque, $id) // DELETE
    {
        $destroy = \App\Models\Contracheque::where('id', '=', $id)->delete();
        return $destroy;
    }

    // ----- Metódos internos ----- //
    private function truncar($numero)
    {
        return floor($numero * 100) / 100;
    }

    private function push($tipo, $abrev, $valor, $rubrica, $ir, $adicNatal, $ptcc, $descontos, $porcentagem = '-')
    {

        $this->calculos[$tipo][$abrev]['financeiro'] = ['valor' => $valor, 'porcentagem' => $porcentagem];
        $this->calculos[$tipo][$abrev]['rubrica'] = $rubrica;

        if ($tipo == 'receitas') {
            $this->calculos['receitas']['bruto_total']['financeiro']['valor'] += $valor;

            if ($ir == 'ir') {
                $this->bruto_ir += $valor;
            }

            if ($adicNatal == '13S') {
                $this->adic_natal_bruto += $valor;
            }

            if ($ptcc == 'pttc') {
                $this->adic_pttc += $valor;
            }

            if ($descontos == 'descontos') {
                $this->soma_para_descontos += $valor;
            }
        } elseif ($tipo == 'descontos') {
            $this->calculos['descontos']['descontos_total']['financeiro']['valor'] += $valor;

            if ($ir == 'ir') {
                $this->abatimentos_ir += $valor;
            }

            if ($ir == 'ir_natal') {
                $this->abatimentos_ir_adic_natal += $valor;
            }
        }
    }

    private function gerenciaValoresIndisponiveis($formulario)
    {
        if ($formulario['php']) {
            $arr = explode('@', $formulario['php']);
            foreach ($arr as &$value) {
                $value = json_decode($value, true);
            };
            unset($value); // quebra a referência com o último elemento

            $this->valoresNaoPrevisto = $arr;

            foreach ($arr as $value) {
                $tipos = $value['tipo'] == 1 ? 'receitas' : 'descontos';
                $abrev = strtolower($value['descricao']);
                $abrev = '_' . str_replace(" ", "_", $abrev);
                $valor = intval($value['valor']);
                $rubrica = strtoupper($value['descricao']);
                $ir = $value['tributavel'] == 1 ? 'ir' : 'n_ir';
                $adicNatal = '13N';
                $ptcc = 'n_pttc';
                $descontos = 'n_descontos';

                $this->push($tipos, $abrev, $valor, $rubrica, $ir, $adicNatal, $ptcc, $descontos);
            }
        }
    }

    private function impostoRenda($bruto,  $deducoes, $qtd_dependentes, $maior_65)
    {
        $base = $bruto - $deducoes - ($qtd_dependentes * 189.59) - ($maior_65 ? 1903.98 : 0);

        $aliquota = 0;
        $parcela = 0;
        if ($base <= 1903.98) {
            $aliquota = 0;
            $parcela = 0;
        } elseif ($base >= 1903.99 and $base <= 2826.65) {
            $aliquota = 0.075;
            $parcela = 142.8;
        } elseif ($base >= 2826.66 and $base <= 3751.05) {
            $aliquota = 0.15;
            $parcela = 354.8;
        } elseif ($base >= 3751.06 and $base <= 4664.68) {
            $aliquota = 0.225;
            $parcela = 636.13;
        } elseif ($base >= 4664.69) {
            $aliquota = 0.275;
            $parcela = 869.36;
        }

        return round((($base * $aliquota) - $parcela), 2);
    }

    private function soldo($formulario, $pg_soldo_info, $pg_real_info)
    {
        if ($formulario["tipo_soldo"] == '1') {
            $pg_soldo_info["pg"] == " - Selecione uma opção -" ? $this->soldo['valor'] = 0 : $this->soldo['valor'] = $pg_soldo_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100);
            $pg_real_info["pg"] == " - Selecione uma opção -" ? $this->soldo_pg_real_normal['valor'] = 0 : $this->soldo_pg_real_normal['valor'] = $pg_real_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100);
            $this->push('receitas', 'soldo', $this->soldo['valor'], 'SOLDO', 'ir', '13S', 'pttc', 'descontos');
        } elseif ($formulario["tipo_soldo"] == '2') {
            $pg_soldo_info["pg"] == " - Selecione uma opção -" ? $this->soldo_prop['valor'] = 0 : $this->soldo_prop['valor'] = ($pg_soldo_info["soldo"] * ($formulario["soldo_prop_cota_porcentagem"] / 100)) * ($formulario["soldo_cota_porcentagem"] / 100);
            $pg_real_info["pg"] == " - Selecione uma opção -" ? $this->soldo_pg_real_prop['valor'] = 0 : $this->soldo_pg_real_prop['valor'] = ($pg_real_info["soldo"] * ($formulario["soldo_prop_cota_porcentagem"] / 100)) * ($formulario["soldo_cota_porcentagem"] / 100);
            $this->push('receitas', 'soldo_prop', $this->soldo_prop['valor'], 'SLD PROP P/COTA', 'ir', '13S', 'pttc', 'descontos');

            if ($formulario["compl_ct_soldo"] == '1') {
                $this->compl_ct_soldo['valor'] = ($pg_soldo_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100)) - $this->soldo_prop['valor'];
                $this->push('receitas', 'compl_ct_soldo', $this->compl_ct_soldo['valor'], 'COMPL COTA SOLDO', 'ir', '13S', 'pttc', 'descontos');
            }
        }
        $this->soldo_base['valor'] = $this->soldo['valor'] + $this->soldo_prop['valor'];
        $this->soldo_pg_real_base['valor'] = $this->soldo_pg_real_normal['valor'] + $this->soldo_pg_real_prop['valor'];
    }

    private function adicionaisTpSveDisp($formulario, $pg_real_info, $pg_soldo_info)
    {
        $tpsv = $pg_soldo_info["soldo"] * $formulario["adic_tp_sv"];
        $adic_disp = $pg_real_info["soldo"] * $pg_real_info["adic_disp"];

        if ($tpsv > $adic_disp) {
            $valor = $this->truncar($this->soldo_base['valor'] * ($formulario["adic_tp_sv"]) / 100);
            $this->push('receitas', 'adic_tp_sv', $valor, 'ADIC TP SV', 'ir', '13S', 'pttc', 'descontos', $formulario["adic_tp_sv"]);
        } elseif ($formulario["adic_disp"] == '1') {
            $valor = $this->truncar($this->soldo_pg_real_base['valor'] * ($pg_real_info["adic_disp"]) / 100);
            $this->push('receitas', 'adic_comp_disp', $valor, 'AD C DISP MIL', 'ir', '13S', 'pttc', 'descontos', $pg_real_info["adic_disp"]);
        }
    }

    private function adicHab($formulario, $adic_hab_info)
    {
        if ($formulario["adic_hab_tipo"] != 'sem_formacao') {
            $this->push('receitas', 'adic_hab', $this->truncar($adic_hab_info[$formulario["adic_hab_tipo"]] * $this->soldo_base['valor'] / 100), 'ADIC HAB', 'ir', '13S', 'pttc', 'descontos', $adic_hab_info[$formulario["adic_hab_tipo"]]);
        }
    }

    private function adicMil($formulario, $pg_soldo_info, $soldo_base)
    {
        if ($formulario["adic_mil"] == 1) {
            $this->push('receitas', 'adic_mil', $this->truncar($pg_soldo_info["adic_mil"] * $soldo_base / 100), 'ADIC MILITAR', 'ir', '13S', 'pttc', 'descontos', $pg_soldo_info["adic_mil"]);
        }
    }

    private function adicPerm($formulario)
    {
        if ($formulario["adic_perm"] > 0) {
            $this->push('receitas', 'adic_perm', $this->truncar($formulario["adic_perm"] * $this->soldo_base['valor'] / 100), 'ADIC PERMANENCIA', 'ir', '13S', 'pttc', 'descontos', $formulario["adic_perm"]);
        }
    }

    private function adicCompOrg($formulario, $todos_pg_info)
    {
        if ($formulario["adic_comp_org_tipo"] != '0') {
            $soldo_base_adic = $todos_pg_info[$formulario['adic_comp_org_pg']]["soldo"];
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_cota_porcentagem"] / 100);
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_prop_cota_porcentagem"] / 100);

            $this->push('receitas', 'adic_comp_org', $this->truncar($soldo_base_adic * $formulario['adic_comp_org_percet'] / 100), 'AD C ORG /' . $formulario["adic_comp_org_tipo"], 'ir', '13S', 'pttc', 'descontos', $formulario['adic_comp_org_percet']);
        }
    }

    private function hVoo($formulario, $todos_pg_info)
    {
        if ($formulario["f_hvoo"] == 1) {
            $soldo_base_adic = $todos_pg_info[$formulario['hvoo_pg']]["soldo"];
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_cota_porcentagem"] / 100);
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_prop_cota_porcentagem"] / 100);

            $this->push('receitas', 'hvoo', $this->truncar($soldo_base_adic * $formulario['hvoo_percet'] / 100), 'AD C ORG H VOO', 'ir', '13S', 'pttc', 'descontos', $formulario['hvoo_percet']);
        }
    }

    private function acres25Soldo($formulario)
    {
        if ($formulario["acres_25_soldo"] == '1') {
            $this->push('receitas', 'acres_25_soldo', $this->truncar($this->soldo_base['valor'] * 0.25), 'ACRESC 25% SOLDO', 'ir', '13S', 'pttc', 'descontos', 25);
        }
    }

    private function salarioFamilia($formulario)
    {
        if ($formulario["salario_familia_dep"] > 0) {
            $this->push('receitas', 'salario_familia', $formulario["salario_familia_dep"] * 0.16, 'SAL FAMILIA', 'n', '13N', 'n_pttc', 'n_descontos',);
        }
    }

    private function auxInvalidez($formulario)
    {
        $valor_minimo = 1520;
        $valor_a_pagar = 0;
        if ($formulario["aux_invalidez"] == 1) {
            $valor_a_pagar = $this->soldo_base['valor'] * 0.25;
            $this->push('receitas', 'aux_invalidez', $this->truncar($valor_minimo > $valor_a_pagar ? $valor_minimo : $valor_a_pagar), 'AUX INVALIDEZ', 'n', '13N', 'n_pttc', 'n_descontos',);
        }
    }

    private function auxTransporte($formulario)
    {
        if ($formulario["aux_transporte"] > 0) {
            $cota_parte = $this->truncar(($this->soldo_base['valor'] / 30 * 22) * 0.06);
            $this->push('receitas', 'aux_transporte', $formulario["aux_transporte"] - $cota_parte, 'AUX TRANSPORTE', 'n', '13N', 'n_pttc', 'n_descontos',);
        }
    }

    private function auxFard($formulario)
    {
        if ($formulario["aux_fard"] == 1) {
            $this->push('receitas', 'aux_fard', $this->soldo_base['valor'], 'AUX FARD 1 SLD', 'n', '13N', 'n_pttc', 'n_descontos',);

            if ($formulario["aux_fard_primeiro"] == 1) {
                $this->push('receitas', 'aux_fard', $this->aux_fard['valor'] + ($this->soldo_base['valor'] / 2), 'AUX FARD 1.5 SLD', 'n', '13N', 'n_pttc', 'n_descontos',);
            }
        }
    }

    private function gratReprCmdo($formulario)
    {
        if ($formulario["grat_repr_cmdo"] == 1) {
            $this->push('receitas', 'grat_repr_cmdo', $this->truncar($this->soldo_base['valor'] * 0.10), 'GRAT REPR CMDO', 'ir', '13S', 'pttc', 'descontos', 10);
        }
    }

    private function adicFerias($formulario)
    {
        if ($formulario["adic_ferias"] == 1) {
            if ($formulario["adic_pttc"] == 1) {
                $this->push('receitas', 'adic_ferias', $this->truncar($this->truncar($this->bruto_ir * 0.3) / 3), 'ADICIONAL FERIAS (PTTC)', 'n', '13N', 'n_pttc', 'n_descontos');
            } else {
                $this->push('receitas', 'adic_ferias', $this->truncar($this->bruto_ir / 3), 'ADICIONAL FERIAS', 'n', '13N', 'n_pttc', 'n_descontos');
            }
        }
    }

    private function gratLocEsp($formulario)
    {
        if ($formulario["grat_loc_esp"] == 'A') {
            $this->push('receitas', 'grat_loc_esp', ($this->soldo_base['valor'] * 0.2), 'GRAT LOC ESP A', 'ir', '13S', 'pttc', 'n_descontos');
        } elseif ($formulario["grat_loc_esp"] == 'B') {
            $this->push('receitas', 'grat_loc_esp', ($this->soldo_base['valor'] * 0.1), 'GRAT LOC ESP B', 'ir', '13S', 'pttc', 'n_descontos');
        }
    }

    private function gratRepr2($formulario, $todos_pg_info)
    {
        if ($formulario["grat_repr_2"] > 0) {
            $soldoBase = $todos_pg_info[$formulario['grat_repr_2_pg']]["soldo"];
            $this->push('receitas', 'grat_repr_2', $this->truncar($soldoBase * 2 * $formulario["grat_repr_2"] / 100), 'GRAT REPRES 2%', 'ir', '13S', 'pttc', 'descontos');
        }
    }

    private function adicPttc($formulario)
    {
        if ($formulario["adic_pttc"] == 1) {
            $base = $this->truncar($this->adic_pttc * 0.3);
            $this->push('receitas', 'adic_pttc', $base, 'ADICIONAL PTTC', 'ir', '13S', 'n_pttc', 'n_descontos');
        }
    }

    private function adicNatalino($formulario)
    {
        if ($formulario["adic_natalino"] == 1) {
            $this->push('receitas', 'adic_natalino', $this->truncar($formulario["adic_natalino_qtd_meses"] / 12 * ($this->adic_natal_bruto)), 'ADIC NATAL', 'n_ir', '13N', 'n_pttc', 'n_descontos');
        }
        if ($formulario["adic_natalino_valor_adiantamento"] > 0) {
            $this->push('descontos', 'adic_natalino_valor_adiantamento', ($formulario["adic_natalino_valor_adiantamento"] / 1), 'DED AD AD NATAL', 'n_ir', '13N', 'n_pttc', 'n_descontos');
        }
    }

    private function auxPreEscolar($formulario)
    {
        $valor_base_pres_escolar = 321;
        $bruto = $this->bruto_ir;
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

            $valorPreEscolar = $valor_base_pres_escolar - ($cota_parte * $valor_base_pres_escolar);
            $this->push('receitas', 'aux_pre_escolar1', $valorPreEscolar, 'ASSIST PRE-ESC', 'n', '13N', 'n_pttc', 'n_descontos');

            if ($formulario["aux_pre_escolar_qtd"] > 1) {
                $this->push('receitas', 'aux_pre_escolar2', $valorPreEscolar, 'ASSIST PRE-ESC', 'n', '13N', 'n_pttc', 'n_descontos');
            }
            if ($formulario["aux_pre_escolar_qtd"] > 2) {
                $this->push('receitas', 'aux_pre_escolar3', $valorPreEscolar, 'ASSIST PRE-ESC', 'n', '13N', 'n_pttc', 'n_descontos');
            }
            if ($formulario["aux_pre_escolar_qtd"] > 3) {
                $this->push('receitas', 'aux_pre_escolar4', $valorPreEscolar, 'ASSIST PRE-ESC', 'n', '13N', 'n_pttc', 'n_descontos');
            }
            if ($formulario["aux_pre_escolar_qtd"] > 4) {
                $this->push('receitas', 'aux_pre_escolar5', $valorPreEscolar, 'ASSIST PRE-ESC', 'n', '13N', 'n_pttc', 'n_descontos');
            }
            if ($formulario["aux_pre_escolar_qtd"] > 5) {
                $this->push('receitas', 'aux_pre_escolar6', $valorPreEscolar, 'ASSIST PRE-ESC', 'n', '13N', 'n_pttc', 'n_descontos');
            }
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
                $this->push('receitas', 'aux_alim_c', 270, 'AUX ALIM C', 'n', '13N', 'n_pttc', 'n_descontos');
            }
        }
    }

    private function auxAlimX($formulario)
    {
        if ($formulario["aux_alim_x"] > 0) {
            $this->push('receitas', 'aux_alim_x', ($formulario["aux_alim_x"] * 9), 'AUX ALIM X', 'n', '13N', 'n_pttc', 'n_descontos');
        }
    }
    private function auxNatalidade($formulario)
    {
        if ($formulario["aux_natalidade"] > 0) {
            if ($formulario["aux_natalidade"] == 1) {
                $this->push('receitas', 'aux_natalidade', $this->soldo_base['valor'], 'AUX NATALIDADE', 'n', '13N', 'n_pttc', 'n_descontos');
            } elseif ($formulario["aux_natalidade"] == 2) {
                $this->push('receitas', 'aux_natalidade', ($this->soldo_base['valor'] + ($this->soldo_base['valor'] / 2)), 'AUX NATALIDADE', 'n', '13N', 'n_pttc', 'n_descontos');
            } elseif ($formulario["aux_natalidade"] > 2) {
                $this->push('receitas', 'aux_natalidade', ($this->soldo_base['valor'] + ($this->soldo_base['valor'] / 2) + (($formulario["aux_natalidade"] - 1) * ($this->soldo_base['valor'] / 2))), 'AUX NATALIDADE', 'n', '13N', 'n_pttc', 'n_descontos');
            }
        }
    }

    private function dpExcmbArt9($formulario)
    {
        if ($formulario["dp_excmb_art_9"] > 0) {
            $this->push('receitas', 'dp_excmb_art_9', $formulario["dp_excmb_art_9"], 'DP EXCMB ART 9', 'n', '13N', 'n_pttc', 'n_descontos'); // atenção para essa lógica nos descontos
            $this->soldo_base['valor'] = $formulario["dp_excmb_art_9"];

            $this->push('descontos', 'pmil', ($this->truncar($this->soldo_base['valor'] * 0.105)), 'P MIL 10.5%', 'ir', '13N', 'n_ptcc', 'n_descontos', 10.5);
            $this->soldo['valor'] = 0;
        }
    }

    private function pMil($formulario, $todos_pg_info)
    {
        if ($formulario["pmil"] == '1') {
            if ($formulario["pmilmesmopg"] != '1') {
                $soldo_base_pmil = $todos_pg_info[$formulario['pmil_pg']]["soldo"];
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_cota_porcentagem"] / 100);
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_prop_cota_porcentagem"] / 100);

                $porcentagem = (($soldo_base_pmil - $this->soldo_base['valor']) * 100) / $this->soldo_base['valor'];
                $novo_bruto = $this->soma_para_descontos + (($this->soma_para_descontos * $porcentagem) / 100);

                $this->push('descontos', 'pmil', ($this->truncar($novo_bruto * 0.105)), 'P MIL 10.5%', 'ir', '13N', 'n_ptcc', 'n_descontos', 10.5);
            } else {
                $this->push('descontos', 'pmil', ($this->truncar($this->soma_para_descontos * 0.105)), 'P MIL 10.5%', 'ir', '13N', 'n_ptcc', 'n_descontos', 10.5);
            }
        }
    }

    private function pMil15($formulario, $todos_pg_info)
    {
        if ($formulario["pmil_15"] == '1') {
            if ($formulario["pmilmesmopg"] != '1') {
                $soldo_base_pmil = $todos_pg_info[$formulario['pmil_pg']]["soldo"];
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_cota_porcentagem"] / 100);
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_prop_cota_porcentagem"] / 100);
                $porcentagem = (($soldo_base_pmil - $this->soldo_base['valor']) * 100) / $this->soldo_base['valor'];
                $novo_bruto = $this->soma_para_descontos + (($this->soma_para_descontos * $porcentagem) / 100);

                $this->push('descontos', 'pmil_15', ($this->truncar($novo_bruto * 0.015)), 'P MIL 1.5%', 'ir', '13N', 'n_ptcc', 'n_descontos', 10.5);
            } else {
                $this->push('descontos', 'pmil_15', ($this->truncar($this->soma_para_descontos * 0.015)), 'P MIL 1.5%', 'ir', '13N', 'n_ptcc', 'n_descontos', 1.5);
            }
        }
    }

    private function pMil30($formulario, $todos_pg_info)
    {
        if ($formulario["pmil_30"] == '1') {
            if ($formulario["pmilmesmopg"] != '1') {
                $soldo_base_pmil = $todos_pg_info[$formulario['pmil_pg']]["soldo"];
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_cota_porcentagem"] / 100);
                $soldo_base_pmil = $soldo_base_pmil * ($formulario["soldo_prop_cota_porcentagem"] / 100);

                $porcentagem = (($soldo_base_pmil - $this->soldo_base['valor']) * 100) / $this->soldo_base['valor'];
                $novo_bruto = $this->soma_para_descontos + (($this->soma_para_descontos * $porcentagem) / 100);

                $this->push('descontos', 'pmil_30', ($this->truncar($novo_bruto * 0.03)), 'P MIL 3.0%', 'ir', '13N', 'n_ptcc', 'n_descontos', 3);
            } else {
                $this->push('descontos', 'pmil_30', ($this->truncar($this->soma_para_descontos * 0.03)), 'P MIL 3.0%', 'ir', '13N', 'n_ptcc', 'n_descontos', 3);
            }
        }
    }

    private function fusex3($formulario)
    {
        if ($formulario["fusex_3"] == '1') {
            $this->push('descontos', 'fusex_3', ($this->truncar($this->soma_para_descontos * 0.03)), 'FUSEX 3%', 'ir', '13N', 'n_ptcc', 'n_descontos', 3);
        }
    }

    private function descDepFusex($formulario)
    {
        if ($formulario["desc_dep_fusex"] == '0.4') {
            $this->push('descontos', 'desc_dep_fusex', ($this->truncar($this->soma_para_descontos * 0.004)), 'DESC DEP FUSEX', 'ir', '13N', 'n_ptcc', 'n_descontos', 0.4);
        } elseif ($formulario["desc_dep_fusex"] == '0.5') {
            $this->push('descontos', 'desc_dep_fusex', ($this->truncar($this->soma_para_descontos * 0.005)), 'DESC DEP FUSEX', 'ir', '13N', 'n_ptcc', 'n_descontos', 0.5);
        }
    }

    private function pnr($formulario)
    {
        if ($formulario["pnr"] !== '0') {
            $valor_base = 0;

            if ($formulario["pnr"] == '1') {
                $valor_base = $this->truncar($this->soldo_base['valor'] * 0.05);
            } elseif ($formulario["pnr"] == '2') {
                $valor_base = $this->truncar($this->soldo_base['valor'] * 0.035);
            }
            $this->push('descontos', 'pnr_f_ex_cnst', ($this->truncar($valor_base  * 0.2)), 'PNR (F EX-CNST)', 'n_ir', '13N', 'n_ptcc', 'n_descontos');
            $this->push('descontos', 'pnr_cod_ua', ($valor_base - $this->truncar($valor_base  * 0.2) - $this->truncar($valor_base  * 0.1)), 'PNR (COD/UA)', 'n_ir', '13N', 'n_ptcc', 'n_descontos');
            $this->push('descontos', 'pnr_f_ex_mnt', ($this->truncar($valor_base  * 0.1)), 'PNR (F EX-MNT)', 'n_ir', '13N', 'n_ptcc', 'n_descontos');
        }
    }

    private function pensJudiciaria($formulario)
    {
        $this->push('descontos', 'pens_judiciaria_1', ($formulario["pens_judiciaria_1"] / 1), 'PENS JUDICIARIA', 'ir', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_2', ($formulario["pens_judiciaria_2"] / 1), 'PENS JUDICIARIA', 'ir', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_3', ($formulario["pens_judiciaria_3"] / 1), 'PENS JUDICIARIA', 'ir', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_4', ($formulario["pens_judiciaria_4"] / 1), 'PENS JUDICIARIA', 'ir', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_5', ($formulario["pens_judiciaria_5"] / 1), 'PENS JUDICIARIA', 'ir', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_6', ($formulario["pens_judiciaria_6"] / 1), 'PENS JUDICIARIA', 'ir', '13N', 'n_ptcc', 'n_descontos');

        $this->push('descontos', 'pens_judiciaria_adic_natal_1', ($formulario["pens_judiciaria_adic_natal_1"] / 1), 'PENS JUDICIARIA 13º', 'ir_natal', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_adic_natal_2', ($formulario["pens_judiciaria_adic_natal_2"] / 1), 'PENS JUDICIARIA 13º', 'ir_natal', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_adic_natal_3', ($formulario["pens_judiciaria_adic_natal_3"] / 1), 'PENS JUDICIARIA 13º', 'ir_natal', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_adic_natal_4', ($formulario["pens_judiciaria_adic_natal_4"] / 1), 'PENS JUDICIARIA 13º', 'ir_natal', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_adic_natal_5', ($formulario["pens_judiciaria_adic_natal_5"] / 1), 'PENS JUDICIARIA 13º', 'ir_natal', '13N', 'n_ptcc', 'n_descontos');
        $this->push('descontos', 'pens_judiciaria_adic_natal_6', ($formulario["pens_judiciaria_adic_natal_6"] / 1), 'PENS JUDICIARIA 13º', 'ir_natal', '13N', 'n_ptcc', 'n_descontos');
    }

    private function impostoRendaMensal($formulario)
    {
        if (!$formulario["isento_ir"]) {
            $this->push('descontos', 'imposto_renda_mensal', ($this->impostoRenda($this->bruto_ir,  $this->abatimentos_ir, $formulario["imposto_renda_dep"], $formulario["maior_65"])), 'IMPOSTO DE RENDA', 'n_ir', '13N', 'n_ptcc', 'n_descontos');
        }
    }

    private function impostoRendaAdicNatal($formulario)
    {
        if (!$formulario["isento_ir"] and isset($this->calculos['receitas']['adic_natalino']['financeiro']['valor']) and isset($this->calculos['descontos']['adic_natalino_valor_adiantamento']['financeiro']['valor'])) {
            $this->push('descontos', 'imposto_renda_mensal', ($this->impostoRenda($this->calculos['receitas']['adic_natalino']['financeiro']['valor'],  $this->abatimentos_ir_adic_natal, $formulario["imposto_renda_dep"], $formulario["maior_65"])), 'IRPF - ADIC NATAL', 'n_ir', '13N', 'n_ptcc', 'n_descontos');
        }
    }

    private function impostoRendaAdicFerias($formulario)
    {
        if (!$formulario["isento_ir"] and isset($this->calculos['receitas']['adic_ferias']['financeiro']['valor'])) {
            $this->push('descontos', 'imposto_renda_adic_ferias', ($this->impostoRenda($this->calculos['receitas']['adic_ferias']['financeiro']['valor'],  $this->abatimentos_ir, $formulario["imposto_renda_dep"], $formulario["maior_65"])), 'IRRF-ADIC FERIAS', 'n_ir', '13N', 'n_ptcc', 'n_descontos');
        }
    }
}
