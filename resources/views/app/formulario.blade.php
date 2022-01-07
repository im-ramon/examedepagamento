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

    <form action="{{ route('app.fichaauxiliar') }}" method="post">
        @csrf

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

        <!-- Filtra só pra pensionistas aqui -->
        <fieldset class="question_root">
            <legend>Cota-parte do Soldo</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual porcetagem de <strong>cota-parte</strong>a pensionista recebe?</p>
                </div>
                <div class="question_options">
                    <input type="number" min="0" max="100" value="100.00" step="0.01" name="soldo_cota_porcentagem"
                        id="soldo_cota_porcentagem"> %
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Soldo Proporcional para Cota</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual proporção do <strong>soldo proporcional para cota</strong> o examinado recebe?</p>
                </div>
                <div class="question_options">
                    <input type="number" value="1" min="1" max="100" name="soldo_prop_divisor"
                        id="soldo_prop_divisor">_/_
                    <input type="number" value="1" min="1" max="100" name="soldo_prop_dividendo"
                        id="soldo_prop_dividendo">
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Complemento de cota de soldo</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Recebe <strong>complemento de cota de soldo</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="compl_ct_soldo" value="1" id="complementocotasoldosim"><label
                        for="complementocotasoldosim">Sim</label>
                    <input type="radio" name="compl_ct_soldo" value="0" id="complementocotasoldonao"><label
                        for="complementocotasoldonao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
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

        <fieldset class="body_question">
            <legend>Adicional de Compensação por Disponibilidade Militar</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual o percentual/ posto ou gradução que o examinado recebe de <strong>Adicional de Compensação
                            por Disponibilidade Militar</strong>?</p>
                </div>
                <div class="question_options">
                    <select name="adic_comp_disp">
                        <option value="0">- Não recebe -</option>
                        <option value="41">Gen Ex Inat - 41%</option>
                        <option value="40">Gen Ex - 40%</option>
                        {{-- COMPLETAR DINAMICAMENTE --}}
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Adicional Habilitação</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Qual nível de babilitação do examinado?</p>
                </div>
                <div class="question_options">
                    <select name="adic_hab_tipo" required>
                        <option value="0">- Selecione o tipo -</option>
                        <option value="Altos estudos Categoria I">Altos estudos Categoria I</option>
                        <option value="Altos estudos Categoria II">Altos estudos Categoria II</option>
                        <option value="Apefeiçoamento">Apefeiçoamento</option>
                        <option value="Especialização">Especialização</option>
                        <option value="Formação">Formação</option>
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
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

        <fieldset class="body_question">
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
                        <option value="0">- Selecione o Post/Grad -</option>
                        <option value="1">Gen Ex</option>
                        <option value="2">Gen Div</option>
                        {{-- SOLDOS - PG - ARRAY --}}
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Adicional de Horas de Voo (ART24MP)</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Recebe <strong>Adicional de Horas de Voo</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="hvoo" value="1" id="hvoosim"><label for="hvoosim">Sim</label>
                    <input type="radio" name="hvoo" value="0" id="hvoonao"><label for="hvoonao">Não</label>
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
                    <select name="select_comporg_pg">
                        <option value="0">- Selecione o Post/Grad -</option>
                        <option value="1">Gen Ex</option>
                        <option value="2">Gen Div</option>
                        {{-- SOLDOS - PG - ARRAY --}}
                    </select>
                </div>
            </section>
        </fieldset>

        {{-- <fieldset class="body_question">
            <legend>Adicional Militar</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Analizar a implementação</p>
                </div>
                <div class="question_options">
                    <select name="select_comporg_pg" required>
                        <option value="0">- Selecione o tipo -</option>
                    </select>
                </div>
            </section>
        </fieldset> --}}


        <fieldset class="body_question">
            <legend>Adicional de Acréscimo de 25% sobre o soldo</legend>
            <section class="question_body">

                <div class="question_title">
                    <p>Recebe <strong>acréscimo de 25% sobre o soldo</strong>?</p>
                </div>
                <div class="question_options">
                    <section>
                        <input type="radio" value="1" name="acres_25_soldo" id="acres25soldosim"><label
                            for="acres25soldosim">Sim</label>
                        <input type="radio" value="0" name="acres_25_soldo" id="acres25soldonao"><label
                            for="acres25soldonao">Não</label>
                    </section>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
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


        <fieldset class="body_question">
            <legend>Adicional de Férias</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá gozar <strong>Férias</strong>?</p>
                </div>
                <div class="question_options">
                    <section>
                        <input type="radio" value="1" name=" adic_ferias" id="feriassim"><label
                            for="feriassim">Sim</label>
                        <input type="radio" value="0" name="adic_ferias" id="feriasnao"><label
                            for="feriasnao">Não</label>
                    </section>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Adicional PTTC</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado é Prestador de Trabalho por Tempo Certo <strong>(PTTC)</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="adic_pttc" id="pttcsim"><label for="pttcsim">Sim</label>
                    <input type="radio" value="0" name="adic_pttc" id="pttcnao"><label for="pttcnao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Adicional Natalino</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado receberá <strong>Adicional Natalino</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="adic_natalino" id="adicnatalinosim"><label
                        for="adicnatalinosim">Sim</label>
                    <input type="radio" value="0" name="adic_natalino" id="adicnatalinonao"><label
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

        <fieldset class="body_question">
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

        <fieldset class="body_question">
            <legend>Auxílio Inavalidez</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado recebe<strong>Auxílio Inavalidez</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_invalidez" id="auxinvsim"><label for="auxinvsim">Sim</label>
                    <input type="radio" value="0" name="aux_invalidez" id="auxinvnao"><label for="auxinvnao">Não</label>
                </div>
            </section>
        </fieldset>


        <fieldset class="body_question">
            <legend>Auxílio Transporte</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado recebe <strong>Auxílio Transporte</strong>? Se sim, qual valor solicitado na
                        <u>SAT</u>?
                    </p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_transporte" min="0" value="0" step="0.01" max="10000">
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Auxílio Fardamento</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Fardamento</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_fard" id="auxfardsim"><label for="auxfardsim">Sim</label>
                    <input type="radio" value="0" name="aux_fard" id="auxfardnao"><label for="auxfardnao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>É a primeira vez que receberá o <strong>Auxílio Fardamento</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_fard_primeiro" id="auxfardprimeirosim"><label
                        for="auxfardprimeiro">Sim</label>
                    <input type="radio" value="0" name="aux_fard_primeiro" id="auxfardprimeironao"><label
                        for="auxfardprimeiro">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Auxílio Alimentação - Tipo "C"</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Alimentação - Tipo "C"</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_alim_c" id="auxalimcsim"><label
                        for="auxalimcsim">Sim</label>
                    <input type="radio" value="0" name="aux_alim_c" id="auxalimcnao"><label
                        for="auxalimcnao">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Auxílio Alimentação - 5x</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Alimentação - 5x</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_alim_5x" id="auxalim5xsim"><label
                        for="auxalim5xsim">Sim</label>
                    <input type="radio" value="0" name="aux_alim_5x" id="auxalim5xsim"><label
                        for="auxalim5xsim">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Referente a quantos dias?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_alim_5x_qtd_dias" min="0" value="0" max="365">
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Auxílio Natalidade</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Auxílio Natalidade</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" value="1" name="aux_natalidade" id="auxnatalidadesim"><label
                        for="auxnatalidadesim">Sim</label>
                    <input type="radio" value="0" name="aux_natalidade" id="auxnatalidadenao"><label
                        for="auxnatalidadenao">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Referente a quantos filhos?</p>
                </div>
                <div class="question_options">
                    <input type="number" name="aux_natalidade_qtd_filhos" min="0" value="0" step="1" max="10">
                </div>
            </section>
        </fieldset>
        {{-- PAREI AQUI --}}
        <fieldset class="body_question">
            <legend>Gratificação de Localidade Especial</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Gratificação de Localidade Especial</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="gratlocesp" id="gratlocespsim"><label for="gratlocesp">Sim</label>
                    <input type="radio" name="gratlocesp" id="gratlocespnao"><label for="gratlocesp">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Qual valor?</p>
                </div>
                <div class="question_options">
                    <input type="number" min="0" value="0">
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Gratificação de Representação de Comando</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado recebe <strong>Gratificação de Representação de Comando</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="gratrepcmdo" id="gratrepcmdosim"><label for="gratrepcmdo">Sim</label>
                    <input type="radio" name="gratrepcmdo" id="gratrepcmdonao"><label for="gratrepcmdo">Não</label>
                </div>
            </section>
        </fieldset>

        <fieldset class="body_question">
            <legend>Gratificação de Representação 2%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado irá receber <strong>Gratificação de Representação 2%</strong>?</p>
                </div>
                <div class="question_options">
                    <input type="radio" name="gratrep2" id="gratrep2sim"><label for="gratrep2">Sim</label>
                    <input type="radio" name="gratrep2" id="gratrep2nao"><label for="gratrep2">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>Sobre qual posto ou graduação?</strong>?</p>
                </div>
                <div class="question_options">
                    <select name="select_pg">
                        <option value="0">- Não recebe -</option>
                        <option value="1">Gen Ex Inat</option>
                        <option value="2">Gen Ex</option>
                        <option value="3">Gen Div</option>
                    </select>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>PensãO examinado</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado contribui para a <strong>PensãO examinado</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pmil" id="pmilsim"><label for="pmil">Sim</label>
                        <input type="radio" name="pmil" id="pmilnao"><label for="pmil">Não</label>
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>PensãO examinado 1.5%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Fez a opção pelo desconto de <strong>PensãO examinado 1.5%</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pmil15" id="pmil15sim"><label for="pmil15">Sim</label>
                        <input type="radio" name="pmil15" id="pmil15nao"><label for="pmil15">Não</label>
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
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
        </fieldset>

        <fieldset class="question_root">
            <legend>FuSEx 3%</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>Contribui para o <strong>FuSEx</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="fusex" id="fusexsim"><label for="fusex">Sim</label>
                        <input type="radio" name="fusex" id="fusexnao"><label for="fusex">Não</label>
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
                        <input type="number" min="0" step="1">
                    </div>
                </div>
            </section>
        </fieldset>

        <fieldset class="question_root">
            <legend>PNR</legend>
            <section class="question_body">
                <div class="question_title">
                    <p>O examinado mora em <strong>PNR</strong>?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="radio" name="pnr" id="pnrsim"><label for="pnr">Sim</label>
                        <input type="radio" name="pnr" id="pnrnao"><label for="pnr">Não</label>
                    </div>
                </div>
            </section>
            <section class="question_body">
                <div class="question_title">
                    <p>Qual o tipo de desconto de <strong>PNR</strong> da unidade?</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <select name="select_pnr">
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
                    <input type="radio" name="pj" id="pjsim"><label for="pj">Sim</label>
                    <input type="radio" name="pj" id="pjnao"><label for="pj">Não</label>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>1. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>2. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>3. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>4. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>5. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>6. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>7. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>8. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>9. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>

            <section class="question_body">
                <div class="question_title">
                    <p>10. Valor da Pensão Judiciária:</p>
                </div>
                <div class="question_options">
                    <div class="question_options">
                        <input type="number" min="0" value="0">
                    </div>
                </div>
            </section>
        </fieldset>
        <button type="submit" id="gerar">GERAR</button>
    </form>
