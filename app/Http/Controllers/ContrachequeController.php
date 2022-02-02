<?php

namespace App\Http\Controllers;

use App\Models\Contracheque;
use App\Http\Requests\StoreContrachequeRequest;
use App\Http\Requests\UpdateContrachequeRequest;
use Illuminate\Http\Request;

class ContrachequeController extends Controller
{
    public $data_contracheque = 0;

    public $soldo = ['valor' => 0, 'porcentagem' => 0];
    public $soldo_prop = ['valor' => 0, 'porcentagem' => 0];
    public $soldo_base = ['valor' => 0, 'porcentagem' => 0]; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um "IF" para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    public $bruto_ir_descontos = ['valor' => 0, 'porcentagem' => 0];
    public $bruto_total = ['valor' => 0, 'porcentagem' => 0];
    public $soldo_pg_real_base = ['valor' => 0, 'porcentagem' => 0]; // Atributo utilizado para realizar os cálculos dentro do sistema sem precisa usar um IF para escolher entre soldo normal e soldo proporcional e não deve ser exibido no Front-End.
    public $soldo_pg_real_normal = ['valor' => 0, 'porcentagem' => 0]; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    public $soldo_pg_real_prop = ['valor' => 0, 'porcentagem' => 0]; // Atributo utilizado para realizar os cálculos dentro do sistema do Adic Disponibilidade e não deve ser exibido no Front-End.
    public $compl_ct_soldo = ['valor' => 0, 'porcentagem' => 0];
    public $adic_tp_sv = ['valor' => 0, 'porcentagem' => 0];
    public $adic_mil = ['valor' => 0, 'porcentagem' => 0];
    public $adic_comp_disp = ['valor' => 0, 'porcentagem' => 0];
    public $adic_hab = ['valor' => 0, 'porcentagem' => 0];
    public $adic_perm = ['valor' => 0, 'porcentagem' => 0];
    public $adic_comp_org = ['valor' => 0, 'porcentagem' => 0];
    public $hvoo = ['valor' => 0, 'porcentagem' => 0];
    public $acres_25_soldo = ['valor' => 0, 'porcentagem' => 0];
    public $salario_familia = ['valor' => 0, 'porcentagem' => 0];
    public $adic_ferias = ['valor' => 0, 'porcentagem' => 0];
    public $adic_pttc = ['valor' => 0, 'porcentagem' => 0];
    public $adic_natalino = ['valor' => 0, 'porcentagem' => 0];
    public $aux_pre_escolar = ['valor' => 0, 'porcentagem' => 0];
    public $aux_invalidez = ['valor' => 0, 'porcentagem' => 0];
    public $aux_transporte = ['valor' => 0, 'porcentagem' => 0];
    public $aux_fard = ['valor' => 0, 'porcentagem' => 0];
    public $aux_alim_c = ['valor' => 0, 'porcentagem' => 0];
    public $aux_alim_5x = ['valor' => 0, 'porcentagem' => 0];
    public $aux_natalidade = ['valor' => 0, 'porcentagem' => 0];
    public $grat_loc_esp = ['valor' => 0, 'porcentagem' => 0];
    public $grat_repr_cmdo = ['valor' => 0, 'porcentagem' => 0];
    public $grat_repr_2 = ['valor' => 0, 'porcentagem' => 0];
    public $dp_excmb_art_9 = ['valor' => 0, 'porcentagem' => 0];
    public $pmil = ['valor' => 0, 'porcentagem' => 0];
    public $pmil_15 = ['valor' => 0, 'porcentagem' => 0];
    public $pmil_30 = ['valor' => 0, 'porcentagem' => 0];
    public $fusex_3 = ['valor' => 0, 'porcentagem' => 0];
    public $desc_dep_fusex = ['valor' => 0, 'porcentagem' => 0];
    public $adic_natalino_valor_adiantamento = ['valor' => 0, 'porcentagem' => 0];
    public $pnr = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_1 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_2 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_3 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_4 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_5 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_6 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_adic_natal_1 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_adic_natal_2 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_adic_natal_3 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_adic_natal_4 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_adic_natal_5 = ['valor' => 0, 'porcentagem' => 0];
    public $pens_judiciaria_adic_natal_6 = ['valor' => 0, 'porcentagem' => 0];
    public $imposto_renda_mensal = ['valor' => 0, 'porcentagem' => 0];
    public $imposto_renda_adic_natal = ['valor' => 0, 'porcentagem' => 0];
    public $imposto_renda_adic_ferias = ['valor' => 0, 'porcentagem' => 0];
    public $descontos_ir = ['valor' => 0, 'porcentagem' => 0];
    public $descontos_total = ['valor' => 0, 'porcentagem' => 0];

    public function gerarFormulario()
    {
        $pg_info = \App\Models\PgConstante::all();
        return view('app.formulario', ['pg_info' => $pg_info]);
    }

    public function fichaauxiliar()
    {
        return 'ok';
    }

    public function index() //GET
    {
        if ($_GET) {
            $formulario = $_GET;
            $todos_pg_info = \App\Models\PgConstante::all()->toArray();
            $pg_real_info = \App\Models\PgConstante::find($formulario['pg_real'])->toArray();
            $pg_soldo_info = \App\Models\PgConstante::find($formulario['pg_soldo'])->toArray();
            $adic_hab_info = \App\Models\AdicHabilitacao::where('periodo_ini', '<', $formulario['data_contracheque'])->where('periodo_fim', '>', $formulario['data_contracheque'])->get()->toArray()[0];

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
                $this->auxAlim5x($formulario);
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
                $this->impostoRendaMensal($formulario);
                $this->impostoRendaAdicNatal($formulario);
                $this->impostoRendaAdicFerias($formulario);
            }
            $this->bruto_total['valor'] = $this->brutoTotal();
            $this->bruto_ir_descontos['valor'] = $this->brutoDescontoIR();
            $this->descontos_ir['valor'] = $this->somaDescontosParaIRMensal();
            $this->descontos_total['valor'] = $this->somaDescontosTotal();

            // return  $formulario;
            return [
                'receitas' => [
                    'soldo' => ['financeiro' => $this->soldo, 'rubrica' => 'SOLDO'],
                    'soldo_prop' => ['financeiro' => $this->soldo_prop, 'rubrica' => 'SLD PROP P/COTA'],
                    'compl_ct_soldo' => ['financeiro' => $this->compl_ct_soldo, 'rubrica' => 'COMPL COTA SOLDO'],
                    'adic_tp_sv' => ['financeiro' => $this->adic_tp_sv, 'rubrica' => 'ADIC TP SV'],
                    'adic_comp_disp' => ['financeiro' => $this->adic_comp_disp, 'rubrica' => 'AD C DISP MIL'],
                    'adic_hab' => ['financeiro' => $this->adic_hab, 'rubrica' => 'ADIC HAB'],
                    'adic_mil' => ['financeiro' => $this->adic_mil, 'rubrica' => 'ADIC MILITAR'],
                    'adic_perm' => ['financeiro' => $this->adic_perm, 'rubrica' => 'ADIC PERMANENCIA'],
                    'adic_comp_org' => ['financeiro' => $this->adic_comp_org, 'rubrica' => 'AD C ORG'],
                    'hvoo' => ['financeiro' => $this->hvoo, 'rubrica' => 'AD C ORG H VOO'],
                    'adic_natalino' => ['financeiro' => $this->adic_natalino, 'rubrica' => 'ADIC NATAL'],
                    'adic_pttc' => ['financeiro' => $this->adic_pttc, 'rubrica' => 'ADICIONAL PTTC'],
                    'adic_ferias' => ['financeiro' => $this->adic_ferias, 'rubrica' => 'ADICIONAL FERIAS'],
                    'acres_25_soldo' => ['financeiro' => $this->acres_25_soldo, 'rubrica' => 'ACRESC 25% SOLDO'],
                    'grat_loc_esp' => ['financeiro' => $this->grat_loc_esp, 'rubrica' => 'GRAT LOC ESP'],
                    'grat_repr_2' => ['financeiro' => $this->grat_repr_2, 'rubrica' => 'GRAT REPRES 2%'],
                    'grat_repr_cmdo' => ['financeiro' => $this->grat_repr_cmdo, 'rubrica' => 'GRAT REPR CMDO'],
                    'aux_pre_escolar' => ['financeiro' => $this->aux_pre_escolar, 'rubrica' => 'ASSIST PRE-ESC'],
                    'aux_transporte' => ['financeiro' => $this->aux_transporte, 'rubrica' => 'AUX TRANSPORTE'],
                    'aux_alim_c' => ['financeiro' => $this->aux_alim_c, 'rubrica' => 'AUX ALIM C'],
                    'aux_alim_5x' => ['financeiro' => $this->aux_alim_5x, 'rubrica' => 'AUX ALIM 5X'],
                    'aux_natalidade' => ['financeiro' => $this->aux_natalidade, 'rubrica' => 'AUX NATALIDADE'],
                    'aux_invalidez' => ['financeiro' => $this->aux_invalidez, 'rubrica' => 'AUX INVALIDEZ'],
                    'salario_familia' => ['financeiro' => $this->salario_familia, 'rubrica' => 'SAL FAMILIA'],
                    'aux_fard' => ['financeiro' => $this->aux_fard, 'rubrica' => 'AUX FARD'],
                    'dp_excmb_art_9' => ['financeiro' => $this->dp_excmb_art_9, 'rubrica' => 'DP EXCMB ART 9'],
                    'bruto_total' => ['financeiro' => $this->bruto_total, 'rubrica' => 'BRUTO TOTAL'],
                    'bruto_ir_descontos' => ['financeiro' => $this->bruto_ir_descontos, 'rubrica' => 'BRUTO PARA IR'],
                ],
                'descontos' => [
                    'pmil' => ['financeiro' => $this->pmil, 'rubrica' => 'P MIL 10.5%'],
                    'pmil_15' => ['financeiro' => $this->pmil_15, 'rubrica' => 'P MIL 1.5%'],
                    'pmil_30' => ['financeiro' => $this->pmil_30, 'rubrica' => 'P MIL 3.0%'],
                    'fusex_3' => ['financeiro' => $this->fusex_3, 'rubrica' => 'FUSEX 3%'],
                    'desc_dep_fusex' => ['financeiro' => $this->desc_dep_fusex, 'rubrica' => 'DESC DEP FUSEX'],
                    'adic_natalino_valor_adiantamento' => ['financeiro' => $this->adic_natalino_valor_adiantamento, 'rubrica' => 'DED AD AD NATAL'],
                    'pnr' => ['financeiro' => $this->pnr, 'rubrica' => 'PNR'],
                    'pens_judiciaria_1' => ['financeiro' => $this->pens_judiciaria_1, 'rubrica' => 'PENS JUDICIARIA'],
                    'pens_judiciaria_2' => ['financeiro' => $this->pens_judiciaria_2, 'rubrica' => 'PENS JUDICIARIA'],
                    'pens_judiciaria_3' => ['financeiro' => $this->pens_judiciaria_3, 'rubrica' => 'PENS JUDICIARIA'],
                    'pens_judiciaria_4' => ['financeiro' => $this->pens_judiciaria_4, 'rubrica' => 'PENS JUDICIARIA'],
                    'pens_judiciaria_5' => ['financeiro' => $this->pens_judiciaria_5, 'rubrica' => 'PENS JUDICIARIA'],
                    'pens_judiciaria_6' => ['financeiro' => $this->pens_judiciaria_6, 'rubrica' => 'PENS JUDICIARIA'],
                    'pens_judiciaria_adic_natal_1' => ['financeiro' => $this->pens_judiciaria_adic_natal_1, 'rubrica' => 'PENS JUDICIARIA AD13'],
                    'pens_judiciaria_adic_natal_2' => ['financeiro' => $this->pens_judiciaria_adic_natal_2, 'rubrica' => 'PENS JUDICIARIA AD13'],
                    'pens_judiciaria_adic_natal_3' => ['financeiro' => $this->pens_judiciaria_adic_natal_3, 'rubrica' => 'PENS JUDICIARIA AD13'],
                    'pens_judiciaria_adic_natal_4' => ['financeiro' => $this->pens_judiciaria_adic_natal_4, 'rubrica' => 'PENS JUDICIARIA AD13'],
                    'pens_judiciaria_adic_natal_5' => ['financeiro' => $this->pens_judiciaria_adic_natal_5, 'rubrica' => 'PENS JUDICIARIA AD13'],
                    'pens_judiciaria_adic_natal_6' => ['financeiro' => $this->pens_judiciaria_adic_natal_6, 'rubrica' => 'PENS JUDICIARIA AD13'],
                    'imposto_renda_mensal' => ['financeiro' => $this->imposto_renda_mensal, 'rubrica' => 'IMPOSTO RENDA'],
                    'imposto_renda_adic_natal' => ['financeiro' => $this->imposto_renda_adic_natal, 'rubrica' => 'IRRF-ADIC NATAL'],
                    'imposto_renda_adic_ferias' => ['financeiro' => $this->imposto_renda_adic_ferias, 'rubrica' => 'IRRF-ADIC FERIAS'],
                    'descontos_total' => ['financeiro' => $this->descontos_total, 'rubrica' => 'DESCONTOS TOTAL'],
                    'descontos_ir' => ['financeiro' => $this->descontos_ir, 'rubrica' => 'DESCONTOS PARA IR'],
                ],
                'informacoes' => [
                    'pg_real_info' => $pg_real_info,
                ]
            ];
        } else {
            return response()->json(['erro' => 'Não foi possível realizar os cálculos. Provavelmente, não foi fornecido o body da requisição.'], 404);
        }
    }

    public function create()
    {
        //
    }

    public function store(StoreContrachequeRequest $request)
    {
        //
    }

    public function show(Contracheque $Contracheque)
    {
        //
    }

    public function edit(Contracheque $Contracheque)
    {
        //
    }

    public function update(UpdateContrachequeRequest $request, Contracheque $Contracheque)
    {
        //
    }

    public function destroy(Contracheque $Contracheque)
    {
        //
    }

    // ----- Metódos internos ----- //
    private function truncar($numero)
    {
        return floor($numero * 100) / 100;
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

    private function brutoTotal()
    {
        return array_sum([
            $this->soldo_base['valor'],
            $this->compl_ct_soldo['valor'],
            $this->adic_tp_sv['valor'],
            $this->adic_comp_disp['valor'],
            $this->adic_hab['valor'],
            $this->adic_mil['valor'],
            $this->adic_perm['valor'],
            $this->adic_comp_org['valor'],
            $this->hvoo['valor'],
            $this->acres_25_soldo['valor'],
            $this->salario_familia['valor'],
            $this->adic_ferias['valor'],
            $this->adic_pttc['valor'],
            $this->adic_natalino['valor'],
            $this->aux_pre_escolar['valor'],
            $this->aux_invalidez['valor'],
            $this->aux_transporte['valor'],
            $this->aux_fard['valor'],
            $this->aux_alim_c['valor'],
            $this->aux_alim_5x['valor'],
            $this->dp_excmb_art_9['valor'],
            $this->aux_natalidade['valor'],
            $this->grat_loc_esp['valor'],
            $this->grat_repr_cmdo['valor'],
            $this->grat_repr_2
        ]);
    }

    private function brutoDescontoIR()
    {
        return array_sum([
            $this->soldo_base['valor'],
            $this->compl_ct_soldo['valor'],
            $this->adic_tp_sv['valor'],
            $this->adic_comp_disp['valor'],
            $this->adic_hab['valor'],
            $this->adic_mil['valor'],
            $this->adic_perm['valor'],
            $this->adic_comp_org['valor'],
            $this->hvoo['valor'],
            $this->acres_25_soldo['valor'],
            $this->adic_pttc['valor'],
            $this->grat_loc_esp['valor'],
            $this->grat_repr_cmdo['valor'],
            $this->grat_repr_2
        ]);
    }

    private function somaDescontosParaIRMensal()
    {
        return array_sum([
            $this->pmil['valor'],
            $this->pmil_15['valor'],
            $this->pmil_30['valor'],
            $this->fusex_3['valor'],
            $this->desc_dep_fusex['valor'],
            $this->pens_judiciaria_1['valor'],
            $this->pens_judiciaria_2['valor'],
            $this->pens_judiciaria_3['valor'],
            $this->pens_judiciaria_4['valor'],
            $this->pens_judiciaria_5['valor'],
            $this->pens_judiciaria_6
        ]);
    }

    private function somaDescontosTotal()
    {
        return array_sum([
            $this->pmil['valor'],
            $this->pmil_15['valor'],
            $this->pmil_30['valor'],
            $this->fusex_3['valor'],
            $this->desc_dep_fusex['valor'],
            $this->adic_natalino_valor_adiantamento['valor'],
            $this->pnr['valor'],
            $this->pens_judiciaria_1['valor'],
            $this->pens_judiciaria_2['valor'],
            $this->pens_judiciaria_3['valor'],
            $this->pens_judiciaria_4['valor'],
            $this->pens_judiciaria_5['valor'],
            $this->pens_judiciaria_6['valor'],
            $this->pens_judiciaria_adic_natal_1['valor'],
            $this->pens_judiciaria_adic_natal_2['valor'],
            $this->pens_judiciaria_adic_natal_3['valor'],
            $this->pens_judiciaria_adic_natal_4['valor'],
            $this->pens_judiciaria_adic_natal_5['valor'],
            $this->pens_judiciaria_adic_natal_6['valor'],
            $this->imposto_renda_mensal['valor'],
            $this->imposto_renda_adic_natal['valor'],
            $this->imposto_renda_adic_ferias['valor'],
        ]);
    }

    private function somaDescontosParaIRAdicNatal()
    {
        return array_sum([
            $this->pens_judiciaria_adic_natal_1['valor'],
            $this->pens_judiciaria_adic_natal_2['valor'],
            $this->pens_judiciaria_adic_natal_3['valor'],
            $this->pens_judiciaria_adic_natal_4['valor'],
            $this->pens_judiciaria_adic_natal_5['valor'],
            $this->pens_judiciaria_adic_natal_6['valor'],
        ]);
    }

    private function soldo($formulario, $pg_soldo_info, $pg_real_info)
    {
        if ($formulario["tipo_soldo"] == '1') {
            $pg_soldo_info["pg"] == " - Selecione uma opção -" ? $this->soldo['valor'] = 0 : $this->soldo['valor'] = $pg_soldo_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100);
            $pg_real_info["pg"] == " - Selecione uma opção -" ? $this->soldo_pg_real_normal['valor'] = 0 : $this->soldo_pg_real_normal['valor'] = $pg_real_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100);
        } elseif ($formulario["tipo_soldo"] == '2') {
            $pg_soldo_info["pg"] == " - Selecione uma opção -" ? $this->soldo_prop['valor'] = 0 : $this->soldo_prop['valor'] = ($pg_soldo_info["soldo"] * ($formulario["soldo_prop_cota_porcentagem"] / 100)) * ($formulario["soldo_cota_porcentagem"] / 100);
            $pg_real_info["pg"] == " - Selecione uma opção -" ? $this->soldo_pg_real_prop['valor'] = 0 : $this->soldo_pg_real_prop['valor'] = ($pg_real_info["soldo"] * ($formulario["soldo_prop_cota_porcentagem"] / 100)) * ($formulario["soldo_cota_porcentagem"] / 100);

            if ($formulario["compl_ct_soldo"] == '1') {
                $this->compl_ct_soldo['valor'] = ($pg_soldo_info["soldo"] * ($formulario["soldo_cota_porcentagem"] / 100)) - $this->soldo_prop['valor'];
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
            $this->adic_tp_sv['valor'] = $this->truncar($this->soldo_base['valor'] * ($formulario["adic_tp_sv"]) / 100);
            $this->adic_comp_disp['valor'] = 0;
        } elseif ($formulario["adic_disp"] == '1') {
            $this->adic_comp_disp['valor'] = $this->truncar($this->soldo_pg_real_base['valor'] * ($pg_real_info["adic_disp"]) / 100);
            $this->adic_tp_sv['valor'] = 0;
        }
    }

    private function adicHab($formulario, $adic_hab_info)
    {
        if ($formulario["adic_hab_tipo"] != 'sem_formacao') {
            $this->adic_hab['valor'] = $this->truncar($adic_hab_info[$formulario["adic_hab_tipo"]] * $this->soldo_base['valor'] / 100);
        }
    }

    private function adicMil($formulario, $pg_soldo_info, $soldo_base)
    {
        if ($formulario["adic_mil"] == 1) {
            $this->adic_mil['valor'] = $this->truncar($pg_soldo_info["adic_mil"] * $soldo_base / 100);
        }
    }

    private function adicPerm($formulario)
    {
        if ($formulario["adic_perm"] > 0) {
            $this->adic_perm['valor'] = $this->truncar($formulario["adic_perm"] * $this->soldo_base['valor'] / 100);
        }
    }

    private function adicCompOrg($formulario, $todos_pg_info)
    {
        if ($formulario["adic_comp_org_tipo"] != '0') {
            $soldo_base_adic = $todos_pg_info[$formulario['adic_comp_org_pg']]["soldo"];
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_cota_porcentagem"] / 100);
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_prop_cota_porcentagem"] / 100);
            $this->adic_comp_org['valor'] = $this->truncar($soldo_base_adic * $formulario['adic_comp_org_percet'] / 100);
        }
    }

    private function hVoo($formulario, $todos_pg_info)
    {
        if ($formulario["f_hvoo"] == 1) {
            $soldo_base_adic = $todos_pg_info[$formulario['hvoo_pg']]["soldo"];
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_cota_porcentagem"] / 100);
            $soldo_base_adic = $soldo_base_adic * ($formulario["soldo_prop_cota_porcentagem"] / 100);
            $this->hvoo['valor'] = $this->truncar($soldo_base_adic * $formulario['hvoo_percet'] / 100);
        }
    }

    private function acres25Soldo($formulario)
    {
        if ($formulario["acres_25_soldo"] == '1') {
            $this->acres_25_soldo['valor'] = $this->truncar($this->soldo_base['valor'] * 0.25);
        }
    }

    private function salarioFamilia($formulario)
    {
        if ($formulario["salario_familia_dep"] > 0) {
            $this->salario_familia['valor'] = $formulario["salario_familia_dep"] * 0.16;
        }
    }

    private function auxInvalidez($formulario)
    {
        $valor_minimo = 1520;
        $valor_a_pagar = 0;
        if ($formulario["aux_invalidez"] == 1) {
            $valor_a_pagar = $this->soldo_base['valor'] * 0.25;
            $this->aux_invalidez['valor'] = $this->truncar($valor_minimo > $valor_a_pagar ? $valor_minimo : $valor_a_pagar);
        }
    }

    private function auxTransporte($formulario)
    {
        if ($formulario["aux_transporte"] > 0) {
            $cota_parte = $this->truncar(($this->soldo_base['valor'] / 30 * 22) * 0.06);
            $this->aux_transporte['valor'] = $formulario["aux_transporte"] - $cota_parte;
        }
    }

    private function auxFard($formulario)
    {
        if ($formulario["aux_fard"] == 1) {
            $this->aux_fard['valor'] = $this->soldo_base['valor'];

            if ($formulario["aux_fard_primeiro"] == 1) {
                $this->aux_fard['valor'] = $this->aux_fard['valor'] + ($this->soldo_base['valor'] / 2);
            }
        }
    }

    private function gratReprCmdo($formulario)
    {
        if ($formulario["grat_repr_cmdo"] == 1) {
            $this->grat_repr_cmdo['valor'] = $this->truncar($this->soldo_base['valor'] * 0.10);
        }
    }

    private function adicFerias($formulario)
    {
        if ($formulario["adic_ferias"] == 1) {
            if ($formulario["adic_pttc"] == 1) {
                $this->adic_ferias['valor'] = $this->truncar($this->adic_pttc['valor'] / 3);
            } else {
                $this->adic_ferias['valor'] = $this->truncar($this->brutoDescontoIR() / 3);
            }
        }
    }

    private function adicPttc($formulario)
    {
        if ($formulario["adic_pttc"] == 1) {
            $this->adic_pttc['valor'] = $this->truncar(array_sum([
                $this->soldo_base['valor'],
                $this->adic_tp_sv['valor'],
                $this->adic_comp_disp['valor'],
                $this->adic_hab['valor'],
                $this->adic_mil['valor'],
                $this->adic_perm['valor'],
                $this->adic_comp_org['valor'],
                $this->hvoo['valor'],
                $this->acres_25_soldo['valor'],
                $this->grat_loc_esp['valor'],
                $this->grat_repr_cmdo['valor'],
            ]) * 0.3);
        }
    }

    private function adicNatalino($formulario)
    {
        if ($formulario["adic_natalino"] == 1) {
            $this->adic_natalino['valor'] = $this->truncar($formulario["adic_natalino_qtd_meses"] / 12 * ($this->brutoDescontoIR()));
        }

        if ($formulario["adic_natalino_valor_adiantamento"] > 0) {
            $this->adic_natalino_valor_adiantamento['valor'] = $formulario["adic_natalino_valor_adiantamento"];
        }
    }

    private function auxPreEscolar($formulario)
    {
        $valor_base_pres_escolar = 321;
        $bruto = $this->brutoDescontoIR();
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

            $this->aux_pre_escolar['valor'] = $valor_base_pres_escolar - ($cota_parte * $valor_base_pres_escolar);
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
                $this->aux_alim_c['valor'] = 270;
            }
        }
    }

    private function auxAlim5x($formulario)
    {
        if ($formulario["aux_alim_5x"] > 0) {
            $this->aux_alim_5x['valor'] = $formulario["aux_alim_5x"] * 9;
        }
    }
    private function auxNatalidade($formulario)
    {
        if ($formulario["aux_natalidade"] > 0) {
            if ($formulario["aux_natalidade"] == 1) {
                $this->aux_natalidade['valor'] = $this->soldo_base['valor'];
            } elseif ($formulario["aux_natalidade"] == 2) {
                $this->aux_natalidade['valor'] = $this->soldo_base['valor'] + ($this->soldo_base['valor'] / 2);
            } elseif ($formulario["aux_natalidade"] > 2) {
                $this->aux_natalidade['valor'] = $this->soldo_base['valor'] + ($this->soldo_base['valor'] / 2) + (($formulario["aux_natalidade"] - 1) * ($this->soldo_base['valor'] / 2));
            }
        }
    }

    private function gratLocEsp($formulario)
    {
        if ($formulario["grat_loc_esp"] == 'A') {
            $this->grat_loc_esp['valor'] = $this->soldo_base['valor'] * 0.2;
        } elseif ($formulario["grat_loc_esp"] == 'B') {
            $this->grat_loc_esp['valor'] = $this->soldo_base['valor'] * 0.1;
        }
    }

    private function gratRepr2($formulario, $todos_pg_info)
    {
        if ($formulario["grat_repr_2"] > 0) {
            $soldoBase = $todos_pg_info[$formulario['grat_repr_2_pg']]["soldo"];
            $this->grat_repr_2['valor'] = $this->truncar($soldoBase * 2 * $formulario["grat_repr_2"] / 100);
        }
    }

    private function dpExcmbArt9($formulario)
    {
        if ($formulario["dp_excmb_art_9"] > 0) {
            $this->dp_excmb_art_9['valor'] = $formulario["dp_excmb_art_9"];
            $this->soldo_base['valor'] = $formulario["dp_excmb_art_9"];

            $this->pmil['valor'] = $this->truncar($this->soldo_base['valor'] * 0.105);
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
                $novo_bruto = $this->brutoDescontoIR() + (($this->brutoDescontoIR() * $porcentagem) / 100);
                $this->pmil['valor'] = $this->truncar($novo_bruto * 0.105);
            } else {
                $this->pmil['valor'] = $this->truncar($this->brutoDescontoIR() * 0.105);
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
                $novo_bruto = $this->brutoDescontoIR() + (($this->brutoDescontoIR() * $porcentagem) / 100);
                $this->pmil_15['valor'] = $this->truncar($novo_bruto * 0.015);
            } else {
                $this->pmil_15['valor'] = $this->truncar($this->brutoDescontoIR() * 0.015);
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
                $novo_bruto = $this->brutoDescontoIR() + (($this->brutoDescontoIR() * $porcentagem) / 100);
                $this->pmil_30['valor'] = $this->truncar($novo_bruto * 0.03);
            } else {
                $this->pmil_30['valor'] = $this->truncar($this->brutoDescontoIR() * 0.03);
            }
        }
    }

    private function fusex3($formulario)
    {
        if ($formulario["fusex_3"] == '1') {
            $this->fusex_3['valor'] = $this->truncar($this->brutoDescontoIR() * 0.03);
        }
    }

    private function descDepFusex($formulario)
    {
        if ($formulario["desc_dep_fusex"] == '0.4') {
            $this->desc_dep_fusex['valor'] = $this->truncar($this->brutoDescontoIR() * 0.004);
        } elseif ($formulario["desc_dep_fusex"] == '0.5') {
            $this->desc_dep_fusex['valor'] = $this->truncar($this->brutoDescontoIR() * 0.005);
        }
    }

    private function pnr($formulario)
    {
        if ($formulario["pnr"] == '1') {
            $this->pnr['valor'] = $this->truncar($this->soldo_base['valor'] * 0.05);
        } elseif ($formulario["pnr"] == '2') {
            $this->pnr['valor'] = $this->truncar($this->soldo_base['valor'] * 0.035);
        }
    }

    private function pensJudiciaria($formulario)
    {
        $this->pens_judiciaria_1['valor'] = $formulario["pens_judiciaria_1"];
        $this->pens_judiciaria_2['valor'] = $formulario["pens_judiciaria_2"];
        $this->pens_judiciaria_3['valor'] = $formulario["pens_judiciaria_3"];
        $this->pens_judiciaria_4['valor'] = $formulario["pens_judiciaria_4"];
        $this->pens_judiciaria_5['valor'] = $formulario["pens_judiciaria_5"];
        $this->pens_judiciaria_6['valor'] = $formulario["pens_judiciaria_6"];
        $this->pens_judiciaria_adic_natal_1['valor'] = $formulario["pens_judiciaria_adic_natal_1"];
        $this->pens_judiciaria_adic_natal_2['valor'] = $formulario["pens_judiciaria_adic_natal_2"];
        $this->pens_judiciaria_adic_natal_3['valor'] = $formulario["pens_judiciaria_adic_natal_3"];
        $this->pens_judiciaria_adic_natal_4['valor'] = $formulario["pens_judiciaria_adic_natal_4"];
        $this->pens_judiciaria_adic_natal_5['valor'] = $formulario["pens_judiciaria_adic_natal_5"];
        $this->pens_judiciaria_adic_natal_6['valor'] = $formulario["pens_judiciaria_adic_natal_6"];
    }

    private function impostoRendaMensal($formulario)
    {
        if (!$formulario["isento_ir"]) {
            $this->imposto_renda_mensal['valor'] = $this->impostoRenda($this->brutoDescontoIR(),  $this->somaDescontosParaIRMensal(), $formulario["imposto_renda_dep"], $formulario["maior_65"]);
        }
    }

    private function impostoRendaAdicNatal($formulario)
    {
        if (!$formulario["isento_ir"] and $this->adic_natalino['valor'] > 0 and $this->adic_natalino_valor_adiantamento['valor'] > 0) {
            $this->imposto_renda_adic_natal['valor'] = $this->impostoRenda($this->adic_natalino['valor'],  $this->somaDescontosParaIRAdicNatal(), $formulario["imposto_renda_dep"], $formulario["maior_65"]);
        }
    }

    private function impostoRendaAdicFerias($formulario)
    {
        if (!$formulario["isento_ir"] and $this->adic_ferias['valor'] > 0) {
            $this->imposto_renda_adic_ferias['valor'] = $this->impostoRenda($this->adic_ferias['valor'],  $this->somaDescontosParaIRMensal(), $formulario["imposto_renda_dep"], $formulario["maior_65"]);
        }
    }
}
