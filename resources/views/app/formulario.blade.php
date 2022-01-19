    <style>
        #gerar {
            position: fixed;
            top: 0;
            right: 0;
            background: #000;
            color: aliceblue;
            width: 150px;
            height: 30px;
            border-radius: 0%;
            cursor: pointer;
            transition: all 1s;
        }

        #gerar:hover {
            opacity: 75%;
            transition: all 1s;
        }

        #formulario {
            width: 100%;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        legend {
            font-weight: bold;
            background: rgb(24, 24, 24);
            color: white;
            padding: 0 2em;
            border: 3px double rgb(21, 78, 10);
            text-transform: uppercase;
        }

        fieldset {
            margin: 1em;
            border: 1px solid #000;
        }

        * {
            border-radius: 8px;
        }

        input {
            text-align: center;
        }

        .question_root {
            display: block;
            background: #e2e2e2;
        }

        .question_body {
            display: grid;
            grid-template-columns: 3fr 1fr;
            border: 1px solid #000;
            padding: 4px 8px;
            margin: 4px 0;
        }

        .question_options {
            display: flex;
            align-items: center;
            justify-content: end;
        }

        p {
            display: inline-block;
        }

        #remuneracoes {
            border: 1px solid blueviolet;
        }

    </style>

    <form id="formulario" action="{{ route('app.fichaauxiliar') }}" method="post">
        @csrf

        <input name="data_contracheque" id="date" type="date" value="2022-01-12">

        <fieldset class="question_root">
            <legend>Idade</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado tem <strong>mais de 65 anos</strong>?
                    <p>
                </div>
                <div class="question_options">
                    <input type="radio" name="maior_65" value="1" id="maior_65sim">
                    <label for="maior_65sim">Sim</label>
                    <input type="radio" name="maior_65" value="0" id="maior_65nao" checked>
                    <label for="maior_65nao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Idade</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado é <strong>isento de Imposrto de Renda</strong>?
                    <p>
                </div>
                <div class="question_options">
                    <input type="radio" name="isento_ir" value="1" id="isento_irsim">
                    <label for="isento_irsim">Sim</label>
                    <input type="radio" name="isento_ir" value="0" id="isento_irnao" checked>
                    <label for="isento_irnao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>P/G Soldo</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual o P/G em que o examinado recebe o <strong>soldo</strong>?</p>
                </div>
                <div class="question_options">
                    <select name="pg_soldo">
                        @include('app.layouts._partials.select_pg')
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>P/G Real</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual o P/G <strong>real</strong> do examinado?</p>
                </div>
                <div class="question_options">
                    <select name="pg_real">
                        @include('app.layouts._partials.select_pg')
                    </select>
                </div>
            </section>
        </fieldset>

        <hr>
        .
        <hr>
        .
        <hr>
        .

        <fieldset class="question_root">
            <legend>Soldo</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual tipo de <strong>soldo</strong> o examinado recebe?</p>
                </div>
                <div class="question_options">
                    <select name="tipo_soldo" id="tipo_soldo">
                        <option value="1">Normal/ Integral</option>
                        <option value="2">Soldo Proporcional para Cota</option>
                    </select>
                </div>
            </section>
        </fieldset>

        {{-- Filtra só pra pensionistas aqui --}}
        <fieldset class="question_root">
            <legend>Cota-parte do Soldo</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual porcetagem de <strong>cota-parte</strong> a pensionista recebe?</p>
                </div>
                <div class="question_options">
                    <input type="number" min="0" max="100" value="100.00" step="0.01" name="soldo_cota_porcentagem"
                        id="soldo_cota_porcentagem"> %
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Soldo Proporcional para Cota</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual porcentagem de <strong>soldo proporcional para cota</strong> o examinado recebe?</p>
                </div>
                <div class="question_options">
                    <input type="number" min="0" max="100" value="100.00" step="0.01" name="soldo_prop_cota_porcentagem"
                        id="soldo_prop_cota_porcentagem"> %
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Complemento de cota de soldo</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Recebe <strong>complemento de cota de soldo</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="compl_ct_soldo" value="1" id="complementocotasoldosim"><label
                        for="complementocotasoldosim">Sim</label>
                    <input type="radio" name="compl_ct_soldo" value="0" id="complementocotasoldonao" checked><label
                        for="complementocotasoldonao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional de Tempo de Serviço</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual o percentual que o examinado faz jus de <strong>Adicional de Tempo de Serviço</strong>?
                    </p>
                </div>
                <div class="question_options">
                    <input type="number" name="adic_tp_sv" id="adic_tp_sv" min="0" value="0" max="100">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional de Compensação por Disponibilidade Militar</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O militar recebe <strong>Adicional de Compensação por Disponibilidade Militar</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="adic_disp" value="1" id="adic_dispsim" checked>
                    <label for="adic_dispsim">Sim</label>

                    <input type="radio" name="adic_disp" value="0" id="adic_dispnao">
                    <label for="adic_dispnao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional Habilitação</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Qual nível de babilitação do examinado?</p>
                </div>
                <div class="question_options">
                    <select name="adic_hab_tipo" required>
                        <option value="sem_formacao">- Selecione o tipo -</option>
                        <option value="altos_estudos_I">Altos estudos Categoria I</option>
                        <option value="altos_estudos_II">Altos estudos Categoria II</option>
                        <option value="aperfeicoamento">Apefeiçoamento</option>
                        <option value="especializacao">Especialização</option>
                        <option value="formacao">Formação</option>
                        <option value="sem_formacao">Sem formação</option>
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional Militar</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>O militar receber <strong>Adicional Militar</strong></p>
                </div>
                <div class="question_options">
                    <input type="radio" name="adic_mil" value="1" id="adic_mil_sim" checked><label
                        for="adic_hab_sim">Sim</label>
                    <input type="radio" name="adic_mil" value="0" id="adic_mil_nao"><label
                        for="adic_hab_nao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional de Permanência</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Qual o percentual que o examinado recebe de <strong>Adicional de Permanência</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="adic_perm" value="0" min="0" max="100" step="5">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional de Compensação Organica</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Recebe <strong>Adicional de Compensação Organica</strong>?</p>
                </div>
                <div class="question_options">
                    <select name="adic_comp_org_tipo">
                        <option value="0">- Não recebe -</option>
                        <option value="PDQT">Paraquedista</option>
                        <option value="RAIOX">Raio-X</option>
                        <option value="TO/ OMA/ FO">Tripulante Orgânico</option>
                        <option value="TO/ OMA/ FO">Observador Meteorológico</option>
                        <option value="TO/ OMA/ FO">Observador Fotogramétrico</option>
                        <option value="IM/ MG/ CTA">Imersão a bordo de submarino</option>
                        <option value="IM/ MG/ CTA">Mergulho com escafandro ou com aparelho</option>
                        <option value="IM/ MG/ CTA">Controle de tráfego aéreo</option>
                    </select>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Qual percentual?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="adic_comp_org_percet" value="0" min="0" max="100">
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Sobre o soldo de qual posto/ gradução?</p>
                </div>
                <div class="question_options">
                    <select name="adic_comp_org_pg">
                        @include('app.layouts._partials.select_pg')
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional de Horas de Voo (ART24MP)</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Recebe <strong>Adicional de Horas de Voo</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="f_hvoo" value="1" id="hvoosim"><label for="hvoosim">Sim</label>
                    <input type="radio" name="f_hvoo" value="0" id="hvoonao" checked><label for="hvoonao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Qual percentual?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="hvoo_percet" value="0" step="0.01" min="0" max="100">
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Sobre o soldo de qual soldo?</p>
                </div>
                <div class="question_options">
                    <select name="hvoo_pg">
                        @include('app.layouts._partials.select_pg')
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional de Acréscimo de 25% sobre o soldo</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Recebe <strong>acréscimo de 25% sobre o soldo</strong>?</p>
                </div>
                <div class="question_options">
                    <section>
                        <input type="radio" value="1" name="acres_25_soldo" id="acres25soldosim"><label
                            for="acres25soldosim">Sim</label>
                        <input type="radio" value="0" name="acres_25_soldo" id="acres25soldonao" checked><label
                            for="acres25soldonao">Não</label>
                    </section>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Salário família/ Imposto de Renda</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Possui quantos dependentes para fins de <strong>Salário Família</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="salario_familia_dep" value="0" min="0" max="30">
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Possui quantos dependentes para fins de <strong>Imposto de Renda</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="imposto_renda_dep" value="0" min="0" max="30">
                    </div>
                </div>
            </section>
        </fieldset>


        <fieldset class="question_root">
            <legend>Adicional de Férias</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá gozar <strong>Férias</strong>?</p>
                </div>
                <div class="question_options">
                    <section>
                        <input type="radio" value="1" name="adic_ferias" id="feriassim"><label
                            for="feriassim">Sim</label>
                        <input type="radio" value="0" name="adic_ferias" id="feriasnao" checked><label
                            for="feriasnao">Não</label>
                    </section>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional PTTC</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado é Prestador de Trabalho por Tempo Certo <strong>(PTTC)</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="adic_pttc" id="pttcsim"><label for="pttcsim">Sim</label>
                    <input type="radio" value="0" name="adic_pttc" id="pttcnao" checked><label for="pttcnao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Adicional Natalino</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado receberá <strong>Adicional Natalino</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="adic_natalino" id="adicnatalinosim"><label
                        for="adicnatalinosim">Sim</label>
                    <input type="radio" value="0" name="adic_natalino" id="adicnatalinonao" checked><label
                        for="adicnatalinonao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Referenta a quantos meses?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="adic_natalino_qtd_meses" value="1" min="0" max="12">
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>O examinado já recebeu algum <strong>Adiantamento do Adicional Natino</strong> durante o ano?
                        Se sim, qual valor?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="adic_natalino_valor_adiantamento" value="0" min="0" step="0.01"
                        max="99999">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Auxílio Pré-escolar</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Possui quantos filhos que recebem <strong>Auxílio Pré-escolar</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_pre_escolar_qtd" value="0" min="0" max="30">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Auxílio Inavalidez</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado recebe<strong>Auxílio Inavalidez</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_invalidez" id="auxinvsim"><label for="auxinvsim">Sim</label>
                    <input type="radio" value="0" name="aux_invalidez" id="auxinvnao" checked><label
                        for="auxinvnao">Não</label>
                </div>
            </section>
        </fieldset>


        <fieldset class="question_root">
            <legend>Auxílio Transporte</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado recebe <strong>Auxílio Transporte</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="1" name="f_aux_transporte" id="f_aux_transportesim"><label
                            for="f_aux_transportesim">Sim</label>
                        <input type="radio" value="0" name="f_aux_transporte" id="f_aux_transportenao" checked><label
                            for="f_aux_transportenao">Não</label>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Qual valor solictado na SAT?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_transporte" min="0" value="0" step="0.01" max="10000">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Auxílio Fardamento</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Fardamento</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_fard" id="auxfardsim"><label for="auxfardsim">Sim</label>
                    <input type="radio" value="0" name="aux_fard" id="auxfardnao" checked><label
                        for="auxfardnao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>É a primeira vez que receberá o <strong>Auxílio Fardamento</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_fard_primeiro" id="auxfardprimeirosim"><label
                        for="auxfardprimeiro">Sim</label>
                    <input type="radio" value="0" name="aux_fard_primeiro" id="auxfardprimeironao" checked><label
                        for="auxfardprimeiro">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Auxílio Alimentação - Tipo "C"</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Alimentação - Tipo "C"</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_alim_c" id="auxalimcsim"><label
                        for="auxalimcsim">Sim</label>
                    <input type="radio" value="0" name="aux_alim_c" id="auxalimcnao" checked><label
                        for="auxalimcnao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Auxílio Alimentação - 5x</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Alimentação - 5x</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="f_aux_alim_5x" id="auxalim5xsim"><label
                        for="auxalim5xsim">Sim</label>
                    <input type="radio" value="0" name="f_aux_alim_5x" id="auxalim5xnao" checked><label
                        for="auxalim5xsim">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Referente a quantos dias?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_alim_5x" min="0" value="0" max="365">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Auxílio Natalidade</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Natalidade</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="f_aux_natalidade" id="auxnatalidadesim"><label
                        for="auxnatalidadesim">Sim</label>
                    <input type="radio" value="0" name="f_aux_natalidade" id="auxnatalidadenao" checked><label
                        for="auxnatalidadenao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Referente a quantos filhos?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_natalidade" min="0" value="0" step="1" max="10">
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Gratificação de Localidade Especial</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual tipo de <strong>Gratificação de Localidade Especial</strong> o examinado recebe?
                    </p>
                </div>
                <div class="question_options">
                    <input type="radio" value="0" id="grat_loc_esp_nao" name="grat_loc_esp" checked min="0" value="0"
                        step="0.01" max="99999"><label for="grat_loc_esp_nao">Não recebe</label>
                    <input type="radio" value="A" id="grat_loc_esp_A" name="grat_loc_esp" min="0" value="A" step="0.01"
                        max="99999"><label for="grat_loc_esp_A">Tipo "A"</label>
                    <input type="radio" value="B" id="grat_loc_esp_B" name="grat_loc_esp" min="0" value="B" step="0.01"
                        max="99999"><label for="grat_loc_esp_B">Tipo "B"</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Gratificação de Representação de Comando</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado recebe <strong>Gratificação de Representação de Comando</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="grat_repr_cmdo" id="gratrepcmdosim"><label
                        for="gratrepcmdosim">Sim</label>
                    <input type="radio" value="0" name="grat_repr_cmdo" id="gratrepcmdonao" checked><label
                        for="gratrepcmdonao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Gratificação de Representação 2%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Gratificação de Representação 2%</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="f_grat_repr_2" id="gratrep2sim"><label
                        for="gratrep2">Sim</label>
                    <input type="radio" value="0" name="f_grat_repr_2" id="gratrep2nao" checked><label
                        for="gratrep2">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Referente a quantos dias?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="grat_repr_2" max="365" min="0" value="0">
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Sobre qual posto ou graduação?</strong>?</p>
                </div>
                <div class="question_options">
                    <select name="grat_repr_2_pg">
                        @include('app.layouts._partials.select_pg')
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Pensionada Pensionista de Ex-Combatente - Art. 9</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>A pensionista é <strong>Pensionada de Ex-Combatente</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="f_dp_excmb_art_9" id="dp_excmb_art_9_sim"><label
                        for="dp_excmb_art_9_sim">Sim</label>
                    <input type="radio" value="0" name="f_dp_excmb_art_9" id="dp_excmb_art_9_nao" checked><label
                        for="dp_excmb_art_9_nao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Quanto a pensionista recebe?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="dp_excmb_art_9" max="99999" min="0" value="0" step="0.01">
                </div>
            </section>
        </fieldset>

        {{-- DESCONTOS --}}
        <hr>
        .
        <hr>
        .
        <hr>
        .

        <fieldset class="question_root">
            <legend>Pensão Militar</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado contribui para a <strong>Pensão Militar</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="1" name="pmil" id="pmilsim" checked><label for="pmilsim">Sim</label>
                        <input type="radio" value="0" name="pmil" id="pmilnao"><label for="pmilnao">Não</label>
                    </div>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>Sobre o mesmo posto/ gradução?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="pmilmesmopg" id="pmilmesmopgsim" checked>
                    <label for="pmilpgsim">Sim</label>
                    <input type="radio" value="0" name="pmilmesmopg" id="pmilmesmopgnao">
                    <label for="pmilmesmopgnao">Não</label>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>Sobre qual posto/ gradução o examinado contribui para a Pensão Militar?</p>
                </div>
                <div class="question_options">
                    <select name="pmil_pg">
                        @include('app.layouts._partials.select_pg')
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Pensão Militar 1.5%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Fez a opção pelo desconto de <strong>Pensão Militar de 1.5%</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="1" name="pmil_15" id="pmil15sim"><label for="pmil15sim">Sim</label>
                        <input type="radio" value="0" name="pmil_15" id="pmil15nao" checked><label
                            for="pmil15nao">Não</label>
                    </div>
                </div>
            </section>
        </fieldset>

        {{-- <fieldset class="question_root">
            <legend>PensãO examinado 3%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>A Pensionista é <strong>filha do instituidor da pensão</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pmil3filha" id="pmil3filhasim"><label for="pmil3filha">Sim</label>
                        <input type="radio" name="pmil3filha" id="pmil3filhanao"><label for="pmil3filha">Não</label>
                    </div>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>A Pensionista é <strong>pensionista vitalícia ou temporária</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pmil3vital" id="pmil3vitalsim"><label for="pmil3vital">Sim</label>
                        <input type="radio" name="pmil3vital" id="pmil3vitalnao"><label for="pmil3vital">Não</label>
                    </div>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>É <strong>Pensionista de Ex-combatente</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pmil3excmbt" id="pmil3excmbtsim"><label for="pmil3excmbt">Sim</label>
                        <input type="radio" name="pmil3excmbt" id="pmil3excmbtnao"><label for="pmil3excmbt">Não</label>
                    </div>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>A Pensionista é <strong>inválida</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pmil3invalida" id="pmil3invalidasim"><label
                            for="pmil3invalida">Sim</label>
                        <input type="radio" name="pmil3invalida" id="pmil3invalidanao"><label
                            for="pmil3invalida">Não</label>
                    </div>
                </div>
            </section>
        </fieldset> --}}

        <fieldset class="question_root">
            <legend>Pensão Militar 3.0%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>A pensionista contribui com o desconto <strong>extraordinário de Pensão Militar de 3.0%</strong>?
                    </p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="1" name="pmil_30" id="pmil30sim"><label for="pmil30sim">Sim</label>
                        <input type="radio" value="0" name="pmil_30" id="pmil30nao" checked><label
                            for="pmil30nao">Não</label>
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>FuSEx 3%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Contribui para o <strong>FuSEx</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="1" name="fusex_3" id="fusexsim" checked><label
                            for="fusexsim">Sim</label>
                        <input type="radio" value="0" name="fusex_3" id="fusexnao"><label for="fusexnao">Não</label>
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Desconto de dependentes no FuSEx</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Possui quantos dependentes, <u>excluíndo a esposa</u>, como dependente no
                        <strong>FuSEx</strong>?
                    </p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="0" name="desc_dep_fusex" id="desc_dep_fusex_nao" checked>
                        <label for="desc_dep_fusex_nao">Não desconta</label>
                        <input type="radio" value="0.4" name="desc_dep_fusex" id="desc_dep_fusex_04">
                        <label for="desc_dep_fusex_04">0.4%</label>
                        <input type="radio" value="0.5" name="desc_dep_fusex" id="desc_dep_fusex_05">
                        <label for="desc_dep_fusex_05">0.5%</label>
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>PNR</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado reside em <strong>PNR</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" value="1" name="f_pnr" id="pnrsim">
                        <label for="pnrsim">Sim</label>

                        <input type="radio" value="0" name="f_pnr" id="pnrnao" checked>
                        <label for="pnrnao">Não</label>
                    </div>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual o tipo de desconto de <strong>PNR</strong> da unidade?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <select name="pnr">
                            <option value="0">- Selecione um tipo -</option>
                            <option value="1">Desconto normal - 5%</option>
                            <option value="2">Desconto especial - 3,5%</option>
                        </select>
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>Pensão Judiciária</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado paga <strong>Pensão Judiciária</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="f_pens_judiciaria" id="pjsim">
                    <label for="pjsim">Sim</label>
                    <input type="radio" value="0" name="f_pens_judiciaria" id="pjnao" checked>
                    <label for="pjnao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária nº 1:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_1" min="0" value="0" step="0.01" max="99999"
                            required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária nº 2:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_2" min="0" value="0" step="0.01" max="99999"
                            required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária nº 3:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_3" min="0" value="0" step="0.01" max="99999"
                            required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária nº 4:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_4" min="0" value="0" step="0.01" max="99999"
                            required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária nº 5:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_5" min="0" value="0" step="0.01" max="99999"
                            required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária nº 6:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_6" min="0" value="0" step="0.01" max="99999"
                            required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária do Adicional Natalino nº 1:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_adic_natal_1" min="0" value="0" step="0.01"
                            max="99999" required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária do Adicional Natalino nº 2:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_adic_natal_2" min="0" value="0" step="0.01"
                            max="99999" required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária do Adicional Natalino nº 3:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_adic_natal_3" min="0" value="0" step="0.01"
                            max="99999" required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária do Adicional Natalino nº 4:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_adic_natal_4" min="0" value="0" step="0.01"
                            max="99999" required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária do Adicional Natalino nº 5:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_adic_natal_5" min="0" value="0" step="0.01"
                            max="99999" required>
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Valor da Pensão Judiciária do Adicional Natalino nº 6:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" name="pens_judiciaria_adic_natal_6" min="0" value="0" step="0.01"
                            max="99999" required>
                    </div>
                </div>
            </section>

            <button type="submit" id="gerar">GERAR</button>
    </form>
