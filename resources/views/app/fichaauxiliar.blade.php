<h1>Ficha auxiliar</h1>

<h3>Descontos</h3>
<p>P Mil 10,5%: {{ $pmil }}</p>
<p>P Mil 1,5%: {{ $pmil_15 }}</p>
<p>P Mil 3,0%: {{ $pmil_30 }}</p>
<p>FuSEx 3%: {{ $fusex_3 }}</p>
<p>desc_dep_fusex: {{ $desc_dep_fusex }}</p>
<p>pnr: {{ $pnr }}</p>
<p>pens_judiciaria_1: {{ $pens_judiciaria_1 }}</p>
<p>pens_judiciaria_2: {{ $pens_judiciaria_2 }}</p>
<p>pens_judiciaria_3: {{ $pens_judiciaria_3 }}</p>
<p>pens_judiciaria_4: {{ $pens_judiciaria_4 }}</p>
<p>pens_judiciaria_5: {{ $pens_judiciaria_5 }}</p>
<p>pens_judiciaria_6: {{ $pens_judiciaria_6 }}</p>
<p>pens_judiciaria_7: {{ $pens_judiciaria_7 }}</p>
<p>pens_judiciaria_8: {{ $pens_judiciaria_8 }}</p>
<p>pens_judiciaria_9: {{ $pens_judiciaria_9 }}</p>
<p>pens_judiciaria_10: {{ $pens_judiciaria_10 }}</p>
<p>imposto_renda_mensal: {{ $imposto_renda_mensal }}</p>

<ul>
    <li>Soldo: {{ $soldo }}</li>
    <li>Soldo Proporcional: {{ $soldo_prop }}</li>
    <li>Compl Cota Soldo: {{ $compl_ct_soldo }}</li>

    <li><strong>Adicionais:</strong>
        <ul>
            <li>Adic Tp Sv: {{ $adic_tp_sv }}</li>
            <li>Adic Disponibilidade: {{ $adic_comp_disp }}</li>
            <li>Adic Habilitação: {{ $adic_hab }}</li>
            <li>Adic Militar: {{ $adic_mil }}</li>
            <li>Adic Férias: {{ $adic_ferias }}</li>
            <li>Adic Perm: {{ $adic_perm }}</li>
            <li>Adic Comp Org: {{ $adic_comp_org }}</li>
            <li>Adic H Voo: {{ $hvoo }}</li>
            <li>Adic PTTC: {{ $adic_pttc }}</li>
            <li>Adic Natalino: {{ $adic_natalino }}</li>
            <li>Acréscimo 25% soldo: {{ $acres_25_soldo }}</li>
        </ul>
    </li>

    <li><strong>Gratificações:</strong>
        <ul>
            <li>Gratificação Loc Esp: {{ $grat_loc_esp }}</li>
            <li>Gratificação Repr 2%: {{ $grat_repr_2 }}</li>
            <li>Gratificação de Comando: {{ $grat_repr_cmdo }}</li>
        </ul>
    </li>

    <li><strong>Auxílios:</strong>
        <ul>
            <li>Aux Pré Escolar: {{ $aux_pre_escolar }}</li>
            <li>Aux Alimentação "C": {{ $aux_alim_c }}</li>
            <li>Aux Transporte: {{ $aux_transporte }}</li>
            <li>Aux Natalidade: {{ $aux_natalidade }}</li>
            <li>Aux Alimentação "5x": {{ $aux_alim_5x }}</li>
            <li>Auxílio Invalidez: {{ $aux_invalidez }}</li>
            <li>Auxílio Fardamento: {{ $aux_fard }}</li>
        </ul>
    </li>

    <li><strong>Outros direitos:</strong>
        <ul>
            <li>Salário Família: {{ $salario_familia }}</li>
        </ul>
    </li>

    <li> * Dependente Ex-Cmbt Art. 9: {{ $dp_excmb_art_9 }}</li>
    <li> * Adic Natalino Adiantamento: {{ $adic_natalino_valor_adiantamento }}</li>
</ul>
<hr>
<p>BRUTO (TOTAL): {{ $bruto_total }}</p>
<p>BRUTO (IR): {{ $bruto_ir_descontos }}</p>
