<h1>Ficha auxiliar</h1>
<ul>
    <li>Soldo: {{ $receitas['soldo'] }}</li>
    <li>Soldo Proporcional: {{ $receitas['soldo_prop'] }}</li>
    <li>Compl Cota Soldo: {{ $receitas['compl_ct_soldo'] }}</li>

    <li><strong>Adicionais:</strong>
        <ul>
            <li>Adic Tp Sv: {{ $receitas['adic_tp_sv'] }}</li>
            <li>Adic Disponibilidade: {{ $receitas['adic_comp_disp'] }}</li>
            <li>Adic Habilitação: {{ $receitas['adic_hab'] }}</li>
            <li>Adic Militar: {{ $receitas['adic_mil'] }}</li>
            <li>Adic Férias: {{ $receitas['adic_ferias'] }}</li>
            <li>Adic Perm: {{ $receitas['adic_perm'] }}</li>
            <li>Adic Comp Org: {{ $receitas['adic_comp_org'] }}</li>
            <li>Adic H Voo: {{ $receitas['hvoo'] }}</li>
            <li>Adic PTTC: {{ $receitas['adic_pttc'] }}</li>
            <li>Adic Natalino: {{ $receitas['adic_natalino'] }}</li>
            <li>Acréscimo 25% soldo: {{ $receitas['acres_25_soldo'] }}</li>
        </ul>
    </li>

    <li><strong>Gratificações:</strong>
        <ul>
            <li>Gratificação Loc Esp: {{ $receitas['grat_loc_esp'] }}</li>
            <li>Gratificação Repr 2%: {{ $receitas['grat_repr_2'] }}</li>
            <li>Gratificação de Comando: {{ $receitas['grat_repr_cmdo'] }}</li>
        </ul>
    </li>

    <li><strong>Auxílios:</strong>
        <ul>
            <li>Aux Pré Escolar: {{ $receitas['aux_pre_escolar'] }}</li>
            <li>Aux Alimentação "C": {{ $receitas['aux_alim_c'] }}</li>
            <li>Aux Transporte: {{ $receitas['aux_transporte'] }}</li>
            <li>Aux Natalidade: {{ $receitas['aux_natalidade'] }}</li>
            <li>Aux Alimentação "5x": {{ $receitas['aux_alim_5x'] }}</li>
            <li>Auxílio Invalidez: {{ $receitas['aux_invalidez'] }}</li>
            <li>Auxílio Fardamento: {{ $receitas['aux_fard'] }}</li>
        </ul>
    </li>

    <li><strong>Outros direitos:</strong>
        <ul>
            <li>Salário Família: {{ $receitas['salario_familia'] }}</li>
        </ul>
    </li>

    <li> * Dependente Ex-Cmbt Art. 9: {{ $receitas['dp_excmb_art_9'] }}</li>
</ul>

<p>BRUTO (TOTAL): {{ $receitas['bruto_total'] }}</p>
<p>BRUTO (IR): {{ $receitas['bruto_ir_descontos'] }}</p>

<h3>Descontos</h3>
<p>P Mil 10,5%: {{ $descontos['pmil'] }}</p>
<p>P Mil 1,5%: {{ $descontos['pmil_15'] }}</p>
<p>P Mil 3,0%: {{ $descontos['pmil_30'] }}</p>
<p>FuSEx 3%: {{ $descontos['fusex_3'] }}</p>
<p>desc_dep_fusex: {{ $descontos['desc_dep_fusex'] }}</p>
<p>pnr: {{ $descontos['pnr'] }}</p>
<p>pens_judiciaria_1: {{ $descontos['pens_judiciaria_1'] }}</p>
<p>pens_judiciaria_2: {{ $descontos['pens_judiciaria_2'] }}</p>
<p>pens_judiciaria_3: {{ $descontos['pens_judiciaria_3'] }}</p>
<p>pens_judiciaria_4: {{ $descontos['pens_judiciaria_4'] }}</p>
<p>pens_judiciaria_5: {{ $descontos['pens_judiciaria_5'] }}</p>
<p>pens_judiciaria_6: {{ $descontos['pens_judiciaria_6'] }}</p>
<p>pens_judiciaria_adic_natal_1: {{ $descontos['pens_judiciaria_adic_natal_1'] }}</p>
<p> * Adic Natalino Adiantamento: {{ $descontos['adic_natalino_valor_adiantamento'] }}</p>
<p>pens_judiciaria_adic_natal_2: {{ $descontos['pens_judiciaria_adic_natal_2'] }}</p>
<p>pens_judiciaria_adic_natal_3: {{ $descontos['pens_judiciaria_adic_natal_3'] }}</p>
<p>pens_judiciaria_adic_natal_4: {{ $descontos['pens_judiciaria_adic_natal_4'] }}</p>
<p>pens_judiciaria_adic_natal_5: {{ $descontos['pens_judiciaria_adic_natal_5'] }}</p>
<p>pens_judiciaria_adic_natal_6: {{ $descontos['pens_judiciaria_adic_natal_6'] }}</p>

<p>imposto_renda_mensal: {{ $descontos['imposto_renda_mensal'] }}</p>
<p>imposto_renda_adic_natal: {{ $descontos['imposto_renda_adic_natal'] }}</p>
<p>imposto_renda_adic_ferias: {{ $descontos['imposto_renda_adic_ferias'] }}</p>
<p>descontos_ir: {{ $descontos['descontos_ir'] }}</p>
<p>descontos_total: {{ $descontos['descontos_total'] }}</p>
