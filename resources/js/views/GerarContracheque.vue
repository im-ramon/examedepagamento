<template>
    <form id="formulario" v-on:submit.prevent v-if="!loading">
        <input type="hidden" name="_token" :value="form_token" />
        <div id="gerar_contracheque-head">
            <div id="contrachequeAtivo">
                <label>Código do contracheque ativo: </label>
                <input
                    type="text"
                    disabled
                    :value="
                        $store.state.contrachequeAtivo || 'Novo contracheque'
                    "
                />
            </div>
        </div>
        <section id="form_informacoes_pessoais">
            <h2>Informações gerais</h2>
            <fieldset class="question_root">
                <legend>Universo/ Classificação</legend>
                <section class="question_body">
                    <div class="question_title">
                        <p>
                            Qual <strong>universo/ classificação</strong> do
                            examinado?
                        </p>
                    </div>
                    <div class="question_options">
                        <select
                            name="universo"
                            v-model="universo"
                            id="tipo_soldo"
                        >
                            <option value="ativa">Militar da Ativa</option>
                            <option value="inativo">Militar da Inativo</option>
                            <option value="pens_mil">
                                Pensionista Militar
                            </option>
                            <option value="pens_excmbt_2ten">
                                Pensionista Ex-Combatente (2º Ten)
                            </option>
                            <option value="pens_excmbt_2sgt">
                                Pensionista Ex-Combatente (2º Sgt)
                            </option>
                        </select>
                    </div>
                </section>
            </fieldset>
            <fieldset class="question_root">
                <legend>Data do contracheque</legend>
                <ajuda-component>
                    <p>
                        Escolha o mês de referêcia do contracheque que quer
                        gerar.
                        <strong
                            >Esta não é data de assintura da ficha
                            auxiliar.</strong
                        >
                    </p>
                </ajuda-component>

                <section class="question_body">
                    <div class="question_title">
                        <p>Qual a <strong>data do contracheque</strong>?</p>
                    </div>
                    <div class="question_options">
                        <input
                            name="data_contracheque"
                            id="date"
                            type="date"
                            v-model="data_contracheque"
                        />
                    </div>
                </section>
            </fieldset>

            <fieldset class="question_root">
                <legend>Idade</legend>
                <ajuda-component>
                    <p>
                        Essa informação irá influenciar no valor final do
                        imposto de renda.
                    </p>
                </ajuda-component>
                <section class="question_body">
                    <div class="question_title">
                        <p>O examinado tem <strong>mais de 65 anos</strong>?</p>
                    </div>
                    <div class="question_options">
                        <input
                            type="radio"
                            name="maior_65"
                            value="1"
                            v-model="maior_65"
                            id="maior_65sim"
                        />
                        <label for="maior_65sim">Sim</label>
                        <input
                            type="radio"
                            name="maior_65"
                            value="0"
                            v-model="maior_65"
                            id="maior_65nao"
                            checked
                        />
                        <label for="maior_65nao">Não</label>
                    </div>
                </section>
            </fieldset>

            <fieldset class="question_root">
                <legend>Isenção de Imposto de Renda</legend>
                <ajuda-component>
                    <p>
                        Poderá encontrar essa informções nos seguintes
                        documentos: <br />
                        <strong>Militares inativos: </strong> Essa informação
                        está presente na <u>Ficha de Controle</u> do Inativo ou
                        existe em sua PHPM uma
                        <u>Portaria de Isenção de Imposto de Renda.</u
                        ><br /><br />
                        <strong>Pensionistas: </strong> A informação pode está
                        presente no <u>Título de Pensão</u> ou <u>Apostila</u>.
                        A Pensionista Especial de Ex-combatente que recebe o
                        soldo de 2º Sgt (Lei nº 4.242/63) é isenta de imposto de
                        renda, mesmo que em seu título de pensão não exista essa
                        informação. Já a Pensionista Especial de Ex-combatente
                        que recebe o soldo de 2º Sgt (Lei nº 8.059/90) não é
                        automaticamente isenta de imposto de renda. <br /><br />
                        *Observação: Ao contrário que muitos pensam, maiores de
                        65 anos
                        <strong>não são isentos de imposto de renda</strong>.
                        Esses recebem um abatimento no valor final.
                    </p>
                </ajuda-component>
                <section class="question_body">
                    <div class="question_title">
                        <p>
                            O examinado é
                            <strong>isento de Imposto de Renda</strong>?
                        </p>
                    </div>
                    <div class="question_options">
                        <input
                            type="radio"
                            name="isento_ir"
                            value="1"
                            v-model="isento_ir"
                            id="isento_irsim"
                        />
                        <label for="isento_irsim">Sim</label>
                        <input
                            type="radio"
                            name="isento_ir"
                            value="0"
                            v-model="isento_ir"
                            id="isento_irnao"
                            checked
                        />
                        <label for="isento_irnao">Não</label>
                    </div>
                </section>
            </fieldset>

            <fieldset class="question_root">
                <legend>P/G Soldo</legend>
                <ajuda-component>
                    <p>
                        Deve ser selecionado o Posto/ Graduação em que o
                        examinado recebe o soldo. No caso dos miltiares da
                        ativa, o P/G para soldo e P/G Real são os mesmos,
                        entretanto, no caso dos Militares Inativos e
                        Pensionistas, essas informações poderão ser difirentes:
                    </p>
                </ajuda-component>
                <section class="question_body">
                    <div class="question_title">
                        <p>
                            Qual o P/G em que o examinado recebe o
                            <strong>soldo</strong>?
                        </p>
                    </div>
                    <div class="question_options">
                        <img
                            v-if="loading_select"
                            src="/svg/loading.svg"
                            style="width: 25px"
                            alt="Ícone de carregamento"
                        />
                        <select v-else name="pg_soldo" v-model="pg_soldo">
                            <option
                                v-for="(pg, key) in selectPg"
                                :key="key"
                                :value="pg.id"
                            >
                                {{ pg.pg_abrev }}
                            </option>
                        </select>
                    </div>
                </section>
            </fieldset>

            <fieldset class="question_root">
                <legend>P/G Real</legend>
                <ajuda-component>
                    <p>
                        O P/G real é o último Posto ou Graduação do militar (ou
                        instituidor de pensão) enquanto na ativa. Não deve ser
                        considerado: <br /><br />
                        - Postos ou graduações alcançados pelo militar como
                        benefício, na forma prevista em lei, em decorrência de
                        reforma, morte ou transferência para a reserva;
                        <br /><br />
                        - Percepção de soldo ou de remuneração correspondente a
                        grau hierárquico superior ao alcançado na ativa, em
                        decorrência de reforma, morte ou transferência para a
                        reserva; e
                        <br /><br />
                        - Percepção de pensão militar correspondente a grau
                        hierárquico superior ao alcançado pelo militar em
                        atividade, em decorrência de benefícios concedidos pela
                        <a
                            href="http://www.planalto.gov.br/ccivil_03/leis/l3765.htm"
                            target="_BLANK"
                            >Lei nº 3.765, de 4 de maio de 1960.</a
                        >
                    </p>
                </ajuda-component>
                <section class="question_body">
                    <div class="question_title">
                        <p>Qual o P/G <strong>real</strong> do examinado?</p>
                    </div>
                    <div class="question_options">
                        <img
                            v-if="loading_select"
                            src="/svg/loading.svg"
                            style="width: 25px"
                            alt="Ícone de carregamento"
                        />
                        <select v-else name="pg_real" v-model="pg_real">
                            <option
                                v-for="(pg, key) in selectPg"
                                :key="key"
                                :value="pg.id"
                            >
                                {{ pg.pg_abrev }}
                            </option>
                        </select>
                    </div>
                </section>
            </fieldset>
        </section>

        <section id="form_informacoes_financeiras">
            <h2>Informações financeiras</h2>

            <section id="form_informacoes_financeiras_col1">
                <fieldset class="question_root">
                    <legend>Soldo</legend>
                    <ajuda-component>
                        <p>
                            Escolha a categoria de soldo que o examinado recebe.
                            São duas opções, a primeira "Normal/Integral"
                            significa que o examinado recebe o valor do seu
                            soldo por completo, normalmente militares da ativa,
                            inativos que completaram o tempo mínimo para reserva
                            e seus pensionistas recebem essa categoria de soldo.
                            A categoria " Soldo Proporcional para Cota" é
                            devida, normalmente, aos militares que fora para a
                            reserva antes do tempo mínimo, como no caso de
                            militares reformados por ser julgado incapaz
                            definitivamente. <br /><br />
                            <strong>Referência: </strong>
                            <a
                                href="http://www.planalto.gov.br/ccivil_03/leis/l6880.htm"
                                target="_BLANK"
                                >Lei nº 6.880, de 9 de dezembro de 1980.</a
                            >
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual tipo de <strong>soldo</strong> o examinado
                                recebe?
                            </p>
                        </div>
                        <div class="question_options">
                            <select
                                name="tipo_soldo"
                                id="tipo_soldo"
                                v-model="tipo_soldo"
                            >
                                <option value="1">Normal/ Integral</option>
                                <option value="2">
                                    Soldo Proporcional para Cota
                                </option>
                            </select>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_soldo_prop_cota">
                    <legend>Soldo Proporcional para Cota</legend>
                    <ajuda-component>
                        <p>
                            O <strong>soldo proporcional para cota</strong> é
                            difirente da <strong>cota-parte do soldo</strong>. O
                            soldo proporcional para cota é devido, normalmente,
                            aos militares que foram para a reserva antes do
                            tempo mínimo, como no caso de militares reformados
                            por ser julgado incapaz definitivamente. Os
                            pensionistas desses militares também pode receber o
                            soldo proporcional para cota. Por exemplo, o
                            instituidor da pensão poderia receber soldo
                            proporcional para cota de 29/30 e ao falecer deixar
                            a pensão de 1/3 para cada dependente, logo, a pensão
                            será calculada primeiro sobre o soldo proporcional
                            depois será dividida por cota-parte para cada
                            beneficiário.<br /><br />
                            <strong>Referência: </strong>
                            <a
                                href="http://www.planalto.gov.br/ccivil_03/leis/l6880.htm"
                                target="_BLANK"
                                >Lei nº 6.880, de 9 de dezembro de 1980.</a
                            >
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual porcentagem de
                                <strong>soldo proporcional para cota</strong> o
                                examinado recebe?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                min="0"
                                max="100"
                                v-model="soldo_prop_cota_porcentagem"
                                step="0.01"
                                name="soldo_prop_cota_porcentagem"
                                id="soldo_prop_cota_porcentagem"
                            />
                            %
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_disp">
                    <legend>
                        Adicional de Compensação por Disponibilidade Militar
                    </legend>
                    <ajuda-component>
                        <p>
                            O Adicional de compensação por disponibilidade
                            militar é a parcela remuneratória mensal devida ao
                            militar em razão da disponibilidade permanente e da
                            dedicação exclusiva. É vedada a concessão cumulativa
                            do adicional de compensação por disponibilidade
                            militar com o adicional de tempo de serviço, sendo
                            assegurado, caso o militar faça jus a ambos os
                            adicionais, o recebimento do mais vantajoso. O
                            percentual do adicional de compensação por
                            disponibilidade militar é irredutível e corresponde
                            sempre ao maior percentual inerente aos postos ou
                            graduações alcançados pelo militar durante sua
                            carreira no serviço ativo, independentemente de
                            mudança de círculos hierárquicos, postos ou
                            graduações. O percentual do adicional de compensação
                            por disponibilidade militar a que o militar faz jus
                            incidirá sobre o soldo do posto ou da graduação
                            atual, e não serão considerados: <br />I - postos ou
                            graduações alcançados pelo militar como benefício,
                            na forma prevista em lei, em decorrência de reforma,
                            morte ou transferência para a reserva;
                            <br />
                            percepção de soldo ou de remuneração correspondente
                            a grau hierárquico superior ao alcançado na ativa,
                            em decorrência de reforma, morte ou transferência
                            para a reserva; e
                            <br />
                            percepção de pensão militar correspondente a grau
                            hierárquico superior ao alcançado pelo militar em
                            atividade, em decorrência de benefícios concedidos
                            pela Lei nº 3.765, de 4 de maio de 1960.<br /><br />
                            <strong>Referência: </strong>
                            <a
                                href="planalto.gov.br/ccivil_03/_ato2019-2022/2019/lei/l13954.htm"
                                target="_BLANK"
                                >Lei nº 13.954, de 16 de dezembro de 2019.</a
                            >
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O militar recebe
                                <strong
                                    >Adicional de Compensação por
                                    Disponibilidade Militar</strong
                                >?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                name="adic_disp"
                                v-model="adic_disp"
                                value="1"
                                id="adic_dispsim"
                                checked
                            />
                            <label for="adic_dispsim">Sim</label>

                            <input
                                type="radio"
                                name="adic_disp"
                                v-model="adic_disp"
                                value="0"
                                id="adic_dispnao"
                            />
                            <label for="adic_dispnao">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_mil">
                    <legend>Adicional Militar</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a rerum empora quibusdam
                            aliquid doloremque obcaecati eum eveniet voluptate
                            harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O militar receber
                                <strong>Adicional Militar</strong>
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                name="adic_mil"
                                v-model="adic_mil"
                                value="1"
                                id="adic_mil_sim"
                                checked
                            /><label for="adic_hab_sim">Sim</label>
                            <input
                                type="radio"
                                name="adic_mil"
                                v-model="adic_mil"
                                value="0"
                                id="adic_mil_nao"
                            /><label for="adic_hab_nao">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_comp_org">
                    <legend>Adicional de Compensação Orgânica</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Recebe
                                <strong
                                    >Adicional de Compensação Orgânica</strong
                                >?
                            </p>
                        </div>
                        <div class="question_options">
                            <select
                                name="adic_comp_org_tipo"
                                v-model="adic_comp_org_tipo"
                                @change="adic_comp_org_percet = 0"
                            >
                                <option value="0">- Não recebe -</option>
                                <option value="PDQT">Paraquedista</option>
                                <option value="RAIOX">Raio-X</option>
                                <option value="TO/ OMA/ FO">
                                    Tripulante Orgânico
                                </option>
                                <option value="TO/ OMA/ FO">
                                    Observador Meteorológico
                                </option>
                                <option value="TO/ OMA/ FO">
                                    Observador Fotogramétrico
                                </option>
                                <option value="IM/ MG/ CTA">
                                    Imersão a bordo de submarino
                                </option>
                                <option value="IM/ MG/ CTA">
                                    Mergulho com escafandro ou com aparelho
                                </option>
                                <option value="IM/ MG/ CTA">
                                    Controle de tráfego aéreo
                                </option>
                            </select>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="adic_comp_org_tipo != '0'"
                    >
                        <div class="question_title">
                            <p>Qual percentual?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="adic_comp_org_percet"
                                v-model="adic_comp_org_percet"
                                min="0"
                                max="100"
                            />
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="adic_comp_org_tipo != '0'"
                    >
                        <div class="question_title">
                            <p>Sobre o soldo de qual posto/ gradução?</p>
                        </div>
                        <div class="question_options">
                            <select
                                name="adic_comp_org_pg"
                                v-model="adic_comp_org_pg"
                            >
                                <option
                                    v-for="(pg, key) in selectPg"
                                    :key="key"
                                    :value="pg.id"
                                >
                                    {{ pg.pg_abrev }}
                                </option>
                            </select>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_acres_25_soldo">
                    <legend>Adicional de Acréscimo de 25% sobre o soldo</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Recebe
                                <strong>acréscimo de 25% sobre o soldo</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <section>
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="acres_25_soldo"
                                    name="acres_25_soldo"
                                    id="acres25soldosim"
                                /><label for="acres25soldosim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="acres_25_soldo"
                                    name="acres_25_soldo"
                                    id="acres25soldonao"
                                    checked
                                /><label for="acres25soldonao">Não</label>
                            </section>
                        </div>
                    </section>
                </fieldset>

                <fieldset
                    class="question_root"
                    v-show="form_salario_familia_ir"
                >
                    <legend>Salário família/ Imposto de Renda</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Possui quantos dependentes para fins de
                                <strong>Salário Família</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="salario_familia_dep"
                                v-model="salario_familia_dep"
                                min="0"
                                max="30"
                            />
                        </div>
                    </section>

                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Possui quantos dependentes para fins de
                                <strong>Imposto de Renda</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="imposto_renda_dep"
                                    v-model="imposto_renda_dep"
                                    min="0"
                                    max="30"
                                />
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_invalidez">
                    <legend>Auxílio Inavalidez</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado recebe
                                <strong>Auxílio Inavalidez</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="aux_invalidez"
                                name="aux_invalidez"
                                id="auxinvsim"
                            /><label for="auxinvsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="aux_invalidez"
                                name="aux_invalidez"
                                id="auxinvnao"
                                checked
                            /><label for="auxinvnao">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_natalino">
                    <legend>Adicional Natalino</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado receberá
                                <strong>Adicional Natalino</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="adic_natalino"
                                name="adic_natalino"
                                id="adicnatalinosim"
                            /><label for="adicnatalinosim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="adic_natalino"
                                @change="
                                    adic_natalino_qtd_meses = 1;
                                    adic_natalino_valor_adiantamento = 0;
                                "
                                name="adic_natalino"
                                id="adicnatalinonao"
                            /><label for="adicnatalinonao">Não</label>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="adic_natalino == '1'"
                    >
                        <div class="question_title">
                            <p>Referenta a quantos meses?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="adic_natalino_qtd_meses"
                                v-model="adic_natalino_qtd_meses"
                                min="0"
                                max="12"
                            />
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="adic_natalino == '1'"
                    >
                        <div class="question_title">
                            <p>
                                O examinado já recebeu algum
                                <strong
                                    >Adiantamento do Adicional Natino</strong
                                >
                                durante o ano? Se sim, qual valor?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="adic_natalino_valor_adiantamento"
                                v-model="adic_natalino_valor_adiantamento"
                                min="0"
                                step="0.01"
                                max="99999"
                            />
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_pre_escolar">
                    <legend>Auxílio Pré-escolar</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Possui quantos filhos que recebem
                                <strong>Auxílio Pré-escolar</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="aux_pre_escolar_qtd"
                                v-model="aux_pre_escolar_qtd"
                                min="0"
                                max="30"
                            />
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_fard">
                    <legend>Auxílio Fardamento</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado irá receber
                                <strong>Auxílio Fardamento</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="aux_fard"
                                name="aux_fard"
                                id="auxfardsim"
                            /><label for="auxfardsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="aux_fard"
                                name="aux_fard"
                                id="auxfardnao"
                                v-on:change="aux_fard_primeiro = 0"
                                checked
                            /><label for="auxfardnao">Não</label>
                        </div>
                    </section>

                    <section class="question_body" v-show="aux_fard == '1'">
                        <div class="question_title">
                            <p>
                                É a primeira vez que receberá o
                                <strong>Auxílio Fardamento</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="aux_fard_primeiro"
                                name="aux_fard_primeiro"
                                id="auxfardprimeirosim"
                            /><label for="auxfardprimeiro">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="aux_fard_primeiro"
                                name="aux_fard_primeiro"
                                id="auxfardprimeironao"
                                checked
                            /><label for="auxfardprimeiro">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_alim_c">
                    <legend>Auxílio Alimentação - Tipo "C"</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado irá receber
                                <strong>Auxílio Alimentação - Tipo "C"</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="aux_alim_c"
                                name="aux_alim_c"
                                id="auxalimcsim"
                            /><label for="auxalimcsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="aux_alim_c"
                                name="aux_alim_c"
                                id="auxalimcnao"
                                checked
                            /><label for="auxalimcnao">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_alim_5x">
                    <legend>Auxílio Alimentação - 5x</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado irá receber
                                <strong>Auxílio Alimentação - 5x</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="f_aux_alim_5x"
                                name="f_aux_alim_5x"
                                id="auxalim5xsim"
                            /><label for="auxalim5xsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="f_aux_alim_5x"
                                name="f_aux_alim_5x"
                                id="auxalim5xnao"
                                v-on:change="aux_alim_5x = 0"
                                checked
                            /><label for="auxalim5xsim">Não</label>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_aux_alim_5x == '1'"
                    >
                        <div class="question_title">
                            <p>Referente a quantos dias?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="aux_alim_5x"
                                min="0"
                                v-model="aux_alim_5x"
                                max="365"
                            />
                        </div>
                    </section>
                </fieldset>
                <fieldset class="question_root" v-show="form_pmil">
                    <legend>Pensão Militar</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado contribui para a
                                <strong>Pensão Militar</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="pmil"
                                    name="pmil"
                                    id="pmilsim"
                                    checked
                                /><label for="pmilsim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="pmil"
                                    name="pmil"
                                    id="pmilnao"
                                /><label for="pmilnao">Não</label>
                            </div>
                        </div>
                    </section>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Contribui sobre o soldo do mesmo posto/
                                gradução?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="pmilmesmopg"
                                name="pmilmesmopg"
                                id="pmilmesmopgsim"
                                checked
                            />
                            <label for="pmilpgsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="pmilmesmopg"
                                name="pmilmesmopg"
                                id="pmilmesmopgnao"
                            />
                            <label for="pmilmesmopgnao">Não</label>
                        </div>
                    </section>
                    <section class="question_body" v-show="pmilmesmopg == '0'">
                        <div class="question_title">
                            <p>
                                Sobre qual posto/ gradução o examinado contribui
                                para a Pensão Militar?
                            </p>
                        </div>
                        <div class="question_options">
                            <select name="pmil_pg" v-model="pmil_pg">
                                <option
                                    v-for="(pg, key) in selectPg"
                                    :key="key"
                                    :value="pg.id"
                                >
                                    {{ pg.pg_abrev }}
                                </option>
                            </select>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_fusex_3">
                    <legend>FuSEx 3%</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>Contribui para o <strong>FuSEx</strong>?</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="fusex_3"
                                    name="fusex_3"
                                    id="fusexsim"
                                    checked
                                /><label for="fusexsim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="fusex_3"
                                    name="fusex_3"
                                    id="fusexnao"
                                /><label for="fusexnao">Não</label>
                            </div>
                        </div>
                    </section>
                </fieldset>
            </section>

            <section id="form_informacoes_financeiras_col2">
                <fieldset class="question_root" v-show="form_soldo_cota">
                    <legend>Cota-parte do Soldo</legend>
                    <ajuda-component>
                        <p>
                            Esse campo é exclusivo para pensionistas. Aqui deve
                            ser informado qual porcentagem de cota-parte o(a)
                            pensionista recebe. Essa informação fica disponível
                            no <strong>título de pensão</strong> ou na
                            <strong>apostila</strong>, na PHPM do(a)
                            examinado(a). Em documentos mais antigos, é
                            informado o percentual em fração, então, para
                            inserir a informação no campo, converta a fração em
                            porcentagem, por exemplo: 1/2 = 50%.<br /><br />
                            <strong>Referência: </strong>
                            <a
                                href="http://www.planalto.gov.br/ccivil_03/leis/l6880.htm"
                                target="_BLANK"
                                >Lei nº 6.880, de 9 de dezembro de 1980.</a
                            >
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual porcetagem de <strong>cota-parte</strong> a
                                pensionista recebe?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                min="0"
                                max="100"
                                v-model="soldo_cota_porcentagem"
                                step="0.01"
                                name="soldo_cota_porcentagem"
                                id="soldo_cota_porcentagem"
                            />
                            %
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_compl_ct_soldo">
                    <legend>Complemento de cota de soldo</legend>
                    <ajuda-component>
                        <p>?</p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Recebe
                                <strong>complemento de cota de soldo</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                name="compl_ct_soldo"
                                v-model="compl_ct_soldo"
                                value="1"
                                id="complementocotasoldosim"
                            /><label for="complementocotasoldosim">Sim</label>
                            <input
                                type="radio"
                                name="compl_ct_soldo"
                                v-model="compl_ct_soldo"
                                value="0"
                                id="complementocotasoldonao"
                                checked
                            /><label for="complementocotasoldonao">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_tp_sv">
                    <legend>Adicional de Tempo de Serviço</legend>
                    <ajuda-component>
                        <p>
                            Adicional de Tempo de Serviço é a parcela
                            remuneratória mensal devida ao militar, inerente ao
                            tempo de serviço e os acréscimos permitidos por lei,
                            observado o disposto no art. 30 da Medida Provisória
                            2215/01. Será computado 1% para cada ano de serviço
                            anterior a 31 DEZ 2000. É vedada a concessão
                            cumulativa do adicional de compensação por
                            disponibilidade militar com o adicional de tempo de
                            serviço, sendo assegurado, caso o militar faça jus a
                            ambos os adicionais, o recebimento do mais
                            vantajoso.

                            <br /><br />
                            <strong>Referência: </strong><br />
                            <a
                                href="http://www.planalto.gov.br/ccivil_03/mpv/2215-10.htm"
                                target="_BLANK"
                                >MP 2215-10, de 31 de agosto de 2001.</a
                            >
                            <br />
                            <a
                                href="planalto.gov.br/ccivil_03/_ato2019-2022/2019/lei/l13954.htm"
                                target="_BLANK"
                                >Lei nº 13.954, de 16 de dezembro de 2019.</a
                            >
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual o percentual que o examinado faz jus de
                                <strong>Adicional de Tempo de Serviço</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="adic_tp_sv"
                                id="adic_tp_sv"
                                min="0"
                                v-model="adic_tp_sv"
                                max="100"
                            />
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_hab">
                    <legend>Adicional Habilitação</legend>
                    <ajuda-component>
                        <p>
                            O Adicional de habilitação é a parcela remuneratória
                            mensal devida ao militar, inerente aos cursos
                            realizados com aproveitamento. Os percentuais podem
                            ser consultados no ANEXO III da Lei nº 13.954, de 16
                            de dezembro de 2019.
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>Qual nível de habilitação do examinado?</p>
                        </div>
                        <div class="question_options">
                            <select
                                name="adic_hab_tipo"
                                v-model="adic_hab_tipo"
                                required
                            >
                                <option value="sem_formacao">
                                    - Selecione o tipo -
                                </option>
                                <option value="altos_estudos_I">
                                    Altos estudos Categoria I
                                </option>
                                <option value="altos_estudos_II">
                                    Altos estudos Categoria II
                                </option>
                                <option value="aperfeicoamento">
                                    Apefeiçoamento
                                </option>
                                <option value="especializacao">
                                    Especialização
                                </option>
                                <option value="formacao">Formação</option>
                                <option value="sem_formacao">
                                    Sem formação
                                </option>
                            </select>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_hvoo">
                    <legend>Adicional de Horas de Voo (ART24MP)</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Recebe
                                <strong>Adicional de Horas de Voo</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                name="hvhvoo"
                                v-model="f_hvoo"
                                value="1"
                                id="hvoosim"
                            /><label for="hvoosim">Sim</label>
                            <input
                                type="radio"
                                name="f_hvoo"
                                v-model="f_hvoo"
                                value="0"
                                @change="hvoo_percet = 0"
                                id="hvoonao"
                                checked
                            /><label for="hvoonao">Não</label>
                        </div>
                    </section>

                    <section class="question_body" v-show="f_hvoo != '0'">
                        <div class="question_title">
                            <p>Qual percentual?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="hvoo_percet"
                                v-model="hvoo_percet"
                                step="0.01"
                                min="0"
                                max="100"
                            />
                        </div>
                    </section>

                    <section class="question_body" v-show="f_hvoo != '0'">
                        <div class="question_title">
                            <p>Sobre o soldo de qual soldo?</p>
                        </div>
                        <div class="question_options">
                            <select name="hvoo_pg" v-model="hvoo_pg">
                                <option
                                    v-for="(pg, key) in selectPg"
                                    :key="key"
                                    :value="pg.id"
                                >
                                    {{ pg.pg_abrev }}
                                </option>
                            </select>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_perm">
                    <legend>Adicional de Permanência</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual o percentual que o examinado recebe de
                                <strong>Adicional de Permanência</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="adic_perm"
                                v-model="adic_perm"
                                min="0"
                                max="100"
                                step="5"
                            />
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_adic_pttc">
                    <legend>Adicional PTTC</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado é Prestador de Trabalho por Tempo
                                Certo <strong>(PTTC)</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="adic_pttc"
                                name="adic_pttc"
                                id="pttcsim"
                            /><label for="pttcsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="adic_pttc"
                                name="adic_pttc"
                                id="pttcnao"
                                checked
                            /><label for="pttcnao">Não</label>
                        </div>
                    </section>
                </fieldset>
                <fieldset class="question_root" v-show="form_adic_ferias">
                    <legend>Adicional de Férias</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado irá gozar <strong>Férias</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <section>
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="adic_ferias"
                                    name="adic_ferias"
                                    id="feriassim"
                                /><label for="feriassim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="adic_ferias"
                                    name="adic_ferias"
                                    id="feriasnao"
                                    checked
                                /><label for="feriasnao">Não</label>
                            </section>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_transporte">
                    <legend>Auxílio Transporte</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado recebe
                                <strong>Auxílio Transporte</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="f_aux_transporte"
                                    name="f_aux_transporte"
                                    id="f_aux_transportesim"
                                /><label for="f_aux_transportesim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="f_aux_transporte"
                                    name="f_aux_transporte"
                                    id="f_aux_transportenao"
                                    v-on:change="aux_transporte = 0"
                                    checked
                                /><label for="f_aux_transportenao">Não</label>
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_aux_transporte == 1"
                    >
                        <div class="question_title">
                            <p>Qual valor solictado na SAT?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="aux_transporte"
                                min="0"
                                v-model="aux_transporte"
                                step="0.01"
                                max="10000"
                            />
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_aux_natalidade">
                    <legend>Auxílio Natalidade</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado irá receber
                                <strong>Auxílio Natalidade</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="f_aux_natalidade"
                                name="f_aux_natalidade"
                                id="auxnatalidadesim"
                            /><label for="auxnatalidadesim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="f_aux_natalidade"
                                name="f_aux_natalidade"
                                id="auxnatalidadenao"
                                @change="aux_natalidade = 0"
                                checked
                            /><label for="auxnatalidadenao">Não</label>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_aux_natalidade != '0'"
                    >
                        <div class="question_title">
                            <p>Referente a quantos filhos?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="aux_natalidade"
                                min="0"
                                v-model="aux_natalidade"
                                step="1"
                                max="10"
                            />
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_grat_loc_esp">
                    <legend>Gratificação de Localidade Especial</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual tipo de
                                <strong
                                    >Gratificação de Localidade Especial</strong
                                >
                                o examinado recebe?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="0"
                                v-model="grat_loc_esp"
                                id="grat_loc_esp_nao"
                                name="grat_loc_esp"
                                checked
                                min="0"
                                step="0.01"
                                max="99999"
                            /><label for="grat_loc_esp_nao">Não recebe</label>
                            <input
                                type="radio"
                                value="A"
                                v-model="grat_loc_esp"
                                id="grat_loc_esp_A"
                                name="grat_loc_esp"
                                min="0"
                                step="0.01"
                                max="99999"
                            /><label for="grat_loc_esp_A">Tipo "A"</label>
                            <input
                                type="radio"
                                value="B"
                                v-model="grat_loc_esp"
                                id="grat_loc_esp_B"
                                name="grat_loc_esp"
                                min="0"
                                step="0.01"
                                max="99999"
                            /><label for="grat_loc_esp_B">Tipo "B"</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_grat_repr_cmdo">
                    <legend>Gratificação de Representação de Comando</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado recebe
                                <strong
                                    >Gratificação de Representação de
                                    Comando</strong
                                >?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="grat_repr_cmdo"
                                name="grat_repr_cmdo"
                                id="gratrepcmdosim"
                            /><label for="gratrepcmdosim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="grat_repr_cmdo"
                                name="grat_repr_cmdo"
                                id="gratrepcmdonao"
                                checked
                            /><label for="gratrepcmdonao">Não</label>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_grat_repr_2">
                    <legend>Gratificação de Representação 2%</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado irá receber
                                <strong>Gratificação de Representação 2%</strong
                                >?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="f_grat_repr_2"
                                name="f_grat_repr_2"
                                id="gratrep2sim"
                            /><label for="gratrep2">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="f_grat_repr_2"
                                name="f_grat_repr_2"
                                id="gratrep2nao"
                                @change="grat_repr_2 = '0'"
                                checked
                            /><label for="gratrep2">Não</label>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_grat_repr_2 != '0'"
                    >
                        <div class="question_title">
                            <p>Referente a quantos dias?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="grat_repr_2"
                                max="365"
                                min="0"
                                v-model="grat_repr_2"
                            />
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_grat_repr_2 != '0'"
                    >
                        <div class="question_title">
                            <p>Sobre qual posto ou graduação?</p>
                        </div>
                        <div class="question_options">
                            <select
                                name="grat_repr_2_pg"
                                v-model="grat_repr_2_pg"
                            >
                                <option
                                    v-for="(pg, key) in selectPg"
                                    :key="key"
                                    :value="pg.id"
                                >
                                    {{ pg.pg_abrev }}
                                </option>
                            </select>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_dp_excmb_art_9">
                    <legend>
                        Pensionada Pensionista de Ex-Combatente - Art. 9
                    </legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>

                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                A pensionista é
                                <strong>Pensionada de Ex-Combatente</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                name="f_dp_excmb_art_9"
                                id="dp_excmb_art_9_sim"
                            /><label for="dp_excmb_art_9_sim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                name="f_dp_excmb_art_9"
                                id="dp_excmb_art_9_nao"
                                checked
                            /><label for="dp_excmb_art_9_nao">Não</label>
                        </div>
                    </section>

                    <section class="question_body">
                        <div class="question_title">
                            <p>Quanto a pensionista recebe?</p>
                        </div>
                        <div class="question_options">
                            <input
                                type="number"
                                name="dp_excmb_art_9"
                                max="99999"
                                min="0"
                                v-model="dp_excmb_art_9"
                                step="0.01"
                            />
                        </div>
                    </section>
                </fieldset>

                <!-- {{-- DESCONTOS --}} -->

                <fieldset class="question_root" v-show="form_pmil_15">
                    <legend>Pensão Militar 1.5%</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Fez a opção pelo desconto de
                                <strong>Pensão Militar de 1.5%</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="pmil_15"
                                    name="pmil_15"
                                    id="pmil15sim"
                                /><label for="pmil15sim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="pmil_15"
                                    name="pmil_15"
                                    id="pmil15nao"
                                    checked
                                /><label for="pmil15nao">Não</label>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_pmil_30">
                    <legend>Pensão Militar 3.0%</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                A pensionista contribui com o desconto
                                <strong
                                    >extraordinário de Pensão Militar de
                                    3.0%</strong
                                >?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="1"
                                    v-model="pmil_30"
                                    name="pmil_30"
                                    id="pmil30sim"
                                /><label for="pmil30sim">Sim</label>
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="pmil_30"
                                    name="pmil_30"
                                    id="pmil30nao"
                                    checked
                                /><label for="pmil30nao">Não</label>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_desc_dep_fusex">
                    <legend>Desconto de dependentes no FuSEx</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Qual percentual de
                                <strong>desconto de dependentes no FuSEx</strong
                                >?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="0"
                                    v-model="desc_dep_fusex"
                                    name="desc_dep_fusex"
                                    id="desc_dep_fusex_nao"
                                    checked
                                />
                                <label for="desc_dep_fusex_nao"
                                    >Não desconta</label
                                >
                                <input
                                    type="radio"
                                    value="0.4"
                                    v-model="desc_dep_fusex"
                                    name="desc_dep_fusex"
                                    id="desc_dep_fusex_04"
                                />
                                <label for="desc_dep_fusex_04">0.4%</label>
                                <input
                                    type="radio"
                                    value="0.5"
                                    v-model="desc_dep_fusex"
                                    name="desc_dep_fusex"
                                    id="desc_dep_fusex_05"
                                />
                                <label for="desc_dep_fusex_05">0.5%</label>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_pnr">
                    <legend>PNR</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>O examinado reside em <strong>PNR</strong>?</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="radio"
                                    value="1"
                                    name="f_pnr"
                                    v-model="f_pnr"
                                    id="pnrsim"
                                />
                                <label for="pnrsim">Sim</label>

                                <input
                                    type="radio"
                                    value="0"
                                    name="f_pnr"
                                    v-model="f_pnr"
                                    id="pnrnao"
                                    @change="pnr = 0"
                                    checked
                                />
                                <label for="pnrnao">Não</label>
                            </div>
                        </div>
                    </section>
                    <section class="question_body" v-show="f_pnr == '1'">
                        <div class="question_title">
                            <p>
                                Qual o tipo de desconto de
                                <strong>PNR</strong> da unidade?
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <select name="pnr" v-model="pnr">
                                    <option value="0">
                                        - Selecione um tipo -
                                    </option>
                                    <option value="1">
                                        Desconto normal - 5%
                                    </option>
                                    <option value="2">
                                        Desconto especial - 3,5%
                                    </option>
                                </select>
                            </div>
                        </div>
                    </section>
                </fieldset>

                <fieldset class="question_root" v-show="form_pens_judiciaria">
                    <legend>Pensão Judiciária</legend>
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                O examinado paga
                                <strong>Pensão Judiciária</strong>?
                            </p>
                        </div>
                        <div class="question_options">
                            <input
                                type="radio"
                                value="1"
                                v-model="f_pens_judiciaria"
                                name="f_pens_judiciaria"
                                id="pjsim"
                            />
                            <label for="pjsim">Sim</label>
                            <input
                                type="radio"
                                value="0"
                                v-model="f_pens_judiciaria"
                                name="f_pens_judiciaria"
                                @change="
                                    pens_judiciaria_1 = '0';
                                    pens_judiciaria_2 = '0';
                                    pens_judiciaria_3 = '0';
                                    pens_judiciaria_4 = '0';
                                    pens_judiciaria_5 = '0';
                                    pens_judiciaria_6 = '0';
                                    pens_judiciaria_adic_natal_1 = '0';
                                    pens_judiciaria_adic_natal_2 = '0';
                                    pens_judiciaria_adic_natal_3 = '0';
                                    pens_judiciaria_adic_natal_4 = '0';
                                    pens_judiciaria_adic_natal_5 = '0';
                                    pens_judiciaria_adic_natal_6 = '0';
                                "
                                id="pjnao"
                                checked
                            />
                            <label for="pjnao">Não</label>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>Valor da Pensão Judiciária nº 1:</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_1"
                                    min="0"
                                    v-model="pens_judiciaria_1"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>Valor da Pensão Judiciária nº 2:</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_2"
                                    min="0"
                                    v-model="pens_judiciaria_2"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>Valor da Pensão Judiciária nº 3:</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_3"
                                    min="0"
                                    v-model="pens_judiciaria_3"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>Valor da Pensão Judiciária nº 4:</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_4"
                                    min="0"
                                    v-model="pens_judiciaria_4"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>Valor da Pensão Judiciária nº 5:</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_5"
                                    min="0"
                                    v-model="pens_judiciaria_5"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>Valor da Pensão Judiciária nº 6:</p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_6"
                                    min="0"
                                    v-model="pens_judiciaria_6"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>
                                Valor da Pensão Judiciária do Adicional Natalino
                                nº 1:
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_adic_natal_1"
                                    min="0"
                                    v-model="pens_judiciaria_adic_natal_1"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>
                                Valor da Pensão Judiciária do Adicional Natalino
                                nº 2:
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_adic_natal_2"
                                    min="0"
                                    v-model="pens_judiciaria_adic_natal_2"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>
                                Valor da Pensão Judiciária do Adicional Natalino
                                nº 3:
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_adic_natal_3"
                                    min="0"
                                    v-model="pens_judiciaria_adic_natal_3"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>
                                Valor da Pensão Judiciária do Adicional Natalino
                                nº 4:
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_adic_natal_4"
                                    min="0"
                                    v-model="pens_judiciaria_adic_natal_4"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>
                                Valor da Pensão Judiciária do Adicional Natalino
                                nº 5:
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_adic_natal_5"
                                    min="0"
                                    v-model="pens_judiciaria_adic_natal_5"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>

                    <section
                        class="question_body"
                        v-show="f_pens_judiciaria == '1'"
                    >
                        <div class="question_title">
                            <p>
                                Valor da Pensão Judiciária do Adicional Natalino
                                nº 6:
                            </p>
                        </div>
                        <div class="question_options">
                            <div class="question_options">
                                <input
                                    type="number"
                                    name="pens_judiciaria_adic_natal_6"
                                    min="0"
                                    v-model="pens_judiciaria_adic_natal_6"
                                    step="0.01"
                                    max="99999"
                                    required
                                />
                            </div>
                        </div>
                    </section>
                </fieldset>
            </section>
        </section>
        <router-link class="btn_gerar" to="/ficha-auxiliar">
            <span>GERAR CONTRACHEQUE</span>
        </router-link>
        <a @click="cleanForm" class="btn_gerar resetar">LIMPAR FORMULÁRIO</a>
    </form>
    <loading-component v-else></loading-component>
</template>

<script>
import axios from "axios";

export default {
    props: ["form_token"],
    data() {
        return {
            loading: false,
            loading_select: false,
            selectPg: [],
            universo: "ativa",
            data_contracheque: "2022-01-01",
            maior_65: "0",
            isento_ir: "0",
            pg_soldo: "1",
            pg_real: "1",
            tipo_soldo: "1",
            soldo_cota_porcentagem: "100.00",
            soldo_prop_cota_porcentagem: "100.00",
            compl_ct_soldo: "0",
            adic_tp_sv: "0",
            adic_disp: "1",
            adic_hab_tipo: "sem_formacao",
            adic_mil: "1",
            adic_comp_org_tipo: "0",
            adic_comp_org_percet: "0",
            adic_comp_org_pg: "1",
            hvoo_percet: "0",
            hvoo_pg: "1",
            acres_25_soldo: "0",
            adic_perm: "0",
            salario_familia_dep: "0",
            imposto_renda_dep: "0",
            adic_ferias: "0",
            adic_pttc: "0",
            adic_natalino: "0",
            adic_natalino_qtd_meses: "1",
            adic_natalino_valor_adiantamento: "0",
            aux_pre_escolar_qtd: "0",
            aux_invalidez: "0",
            aux_transporte: "0",
            aux_fard: "0",
            aux_fard_primeiro: "0",
            aux_alim_c: "0",
            aux_alim_5x: "0",
            aux_natalidade: "0",
            grat_loc_esp: "0",
            grat_repr_cmdo: "0",
            grat_repr_2: "0",
            grat_repr_2_pg: "1",
            dp_excmb_art_9: "0",
            pmil: "1",
            pmilmesmopg: "1",
            pmil_pg: "1",
            pmil_15: "0",
            pmil_30: "0",
            fusex_3: "1",
            desc_dep_fusex: "0",
            pnr: "0",
            pens_judiciaria_1: "0",
            pens_judiciaria_2: "0",
            pens_judiciaria_3: "0",
            pens_judiciaria_4: "0",
            pens_judiciaria_5: "0",
            pens_judiciaria_6: "0",
            pens_judiciaria_adic_natal_1: "0",
            pens_judiciaria_adic_natal_2: "0",
            pens_judiciaria_adic_natal_3: "0",
            pens_judiciaria_adic_natal_4: "0",
            pens_judiciaria_adic_natal_5: "0",
            pens_judiciaria_adic_natal_6: "0",

            form_soldo_cota: false,
            form_soldo_prop_cota: false,
            form_compl_ct_soldo: false,
            form_adic_tp_sv: true,
            form_adic_disp: true,
            form_adic_hab: true,
            form_adic_mil: true,
            form_adic_comp_org: true,
            form_hvoo: true,
            form_acres_25_soldo: true,
            form_adic_perm: true,
            form_salario_familia_ir: true,
            form_adic_ferias: true,
            form_adic_pttc: true,
            form_adic_natalino: true,
            form_aux_pre_escolar: true,
            form_aux_invalidez: true,
            form_aux_transporte: true,
            form_aux_fard: true,
            form_aux_fard_primeiro: true,
            form_aux_alim_c: true,
            form_aux_alim_5x: true,
            form_aux_natalidade: true,
            form_grat_loc_esp: true,
            form_grat_repr_cmdo: true,
            form_grat_repr_2: true,
            form_dp_excmb_art_9: false,
            form_pmil: true,
            form_pmil_15: true,
            form_pmil_30: true,
            form_fusex_3: true,
            form_desc_dep_fusex: true,
            form_pnr: true,
            form_pens_judiciaria: true,

            f_aux_transporte: "0",
            f_aux_alim_5x: "0",
            f_aux_natalidade: "0",
            f_hvoo: "0",
            f_grat_repr_2: "0",
            f_pnr: "0",
            f_pens_judiciaria: "0",
        };
    },
    computed: {
        token() {
            let token = document.cookie.split(";").find((indice) => {
                return indice.includes("token=");
            });

            token = token.split("=")[1];
            token = "Bearer " + token;

            return token;
        },
        nowPath() {
            let path = window.location.href;
            return `${path.split("/")[0]}//${path.split("/")[1]}${
                path.split("/")[2]
            }`;
        },
    },
    beforeRouteLeave(to, from, next) {
        if (to.path == "/ficha-auxiliar") {
            if (this.pg_soldo == 1 || this.pg_real == 1) {
                alert(
                    'Volte até a área "Informações gerais" e selecione o Posto ou Graduação para poder continuar.'
                );
            } else {
                this.loading = true;
                this.saveForm();
                this.geraDadosFinanceiros().then((r) => {
                    this.loading = false;
                    next();
                });
            }
        } else {
            next();
        }
    },
    watch: {
        universo(newValue, oldValue) {
            if (newValue == "ativa") {
                this.form_soldo_cota = false;
                this.soldo_cota_porcentagem = "100.00";
                this.form_soldo_prop_cota = false;
                this.soldo_prop_cota_porcentagem = "100.00";
                this.form_compl_ct_soldo = false;
                this.compl_ct_soldo = "0";
                this.form_dp_excmb_art_9 = false;
                this.dp_excmb_art_9 = "0";
            } else if (newValue == "inativo") {
                this.form_soldo_cota = false;
                this.soldo_cota_porcentagem = "100.00";
                this.form_soldo_prop_cota = true;
                this.soldo_prop_cota_porcentagem = "100.00";
                this.form_compl_ct_soldo = true;
                this.compl_ct_soldo = "0";
                this.form_dp_excmb_art_9 = false;
                this.dp_excmb_art_9 = "0";
            } else if (newValue == "pens_mil") {
                this.form_soldo_cota = true;
                this.soldo_cota_porcentagem = "100.00";
                this.form_soldo_prop_cota = true;
                this.soldo_prop_cota_porcentagem = "100.00";
                this.form_compl_ct_soldo = true;
                this.compl_ct_soldo = "0";
                this.form_dp_excmb_art_9 = false;
                this.dp_excmb_art_9 = "0";
            } else if (
                newValue == "pens_excmbt_2ten" ||
                newValue == "pens_excmbt_2sgt"
            ) {
                this.form_soldo_cota = true;
                this.soldo_cota_porcentagem = "100.00";
                this.form_soldo_prop_cota = true;
                this.soldo_prop_cota_porcentagem = "100.00";
                this.form_compl_ct_soldo = true;
                this.compl_ct_soldo = "0";
                this.form_dp_excmb_art_9 = true;
                this.dp_excmb_art_9 = "0";
            }
        },
    },
    methods: {
        carregaSelectPg() {
            this.loading_select = true;

            axios
                .get(`${this.nowPath}/api/pg-constantes`)
                .then((r) => {
                    this.selectPg = r.data;
                    this.loading_select = false;
                })
                .catch((e) => console.log(e));
        },

        async geraDadosFinanceiros() {
            let data = `_token=${this.token}&universo=${this.universo}&data_contracheque=${this.data_contracheque}&maior_65=${this.maior_65}&isento_ir=${this.isento_ir}&pg_soldo=${this.pg_soldo}&pg_real=${this.pg_real}&tipo_soldo=${this.tipo_soldo}&soldo_cota_porcentagem=${this.soldo_cota_porcentagem}&soldo_prop_cota_porcentagem=${this.soldo_prop_cota_porcentagem}&compl_ct_soldo=${this.compl_ct_soldo}&adic_tp_sv=${this.adic_tp_sv}&adic_disp=${this.adic_disp}&adic_hab_tipo=${this.adic_hab_tipo}&adic_mil=${this.adic_mil}&adic_comp_org_tipo=${this.adic_comp_org_tipo}&adic_comp_org_percet=${this.adic_comp_org_percet}&adic_comp_org_pg=${this.adic_comp_org_pg}&f_hvoo=${this.f_hvoo}&hvoo_percet=${this.hvoo_percet}&hvoo_pg=${this.hvoo_pg}&acres_25_soldo=${this.acres_25_soldo}&adic_perm=${this.adic_perm}&salario_familia_dep=${this.salario_familia_dep}&imposto_renda_dep=${this.imposto_renda_dep}&adic_ferias=${this.adic_ferias}&adic_pttc=${this.adic_pttc}&adic_natalino=${this.adic_natalino}&adic_natalino_qtd_meses=${this.adic_natalino_qtd_meses}&adic_natalino_valor_adiantamento=${this.adic_natalino_valor_adiantamento}&aux_pre_escolar_qtd=${this.aux_pre_escolar_qtd}&aux_invalidez=${this.aux_invalidez}&aux_transporte=${this.aux_transporte}&aux_fard=${this.aux_fard}&aux_fard_primeiro=${this.aux_fard_primeiro}&aux_alim_c=${this.aux_alim_c}&aux_alim_5x=${this.aux_alim_5x}&aux_natalidade=${this.aux_natalidade}&grat_loc_esp=${this.grat_loc_esp}&grat_repr_cmdo=${this.grat_repr_cmdo}&grat_repr_2=${this.grat_repr_2}&grat_repr_2_pg=${this.grat_repr_2_pg}&dp_excmb_art_9=${this.dp_excmb_art_9}&pmil=${this.pmil}&pmilmesmopg=${this.pmilmesmopg}&pmil_pg=${this.pmil_pg}&pmil_15=${this.pmil_15}&pmil_30=${this.pmil_30}&fusex_3=${this.fusex_3}&desc_dep_fusex=${this.desc_dep_fusex}&pnr=${this.pnr}&pens_judiciaria_1=${this.pens_judiciaria_1}&pens_judiciaria_2=${this.pens_judiciaria_2}&pens_judiciaria_3=${this.pens_judiciaria_3}&pens_judiciaria_4=${this.pens_judiciaria_4}&pens_judiciaria_5=${this.pens_judiciaria_5}&pens_judiciaria_6=${this.pens_judiciaria_6}&pens_judiciaria_adic_natal_1=${this.pens_judiciaria_adic_natal_1}&pens_judiciaria_adic_natal_2=${this.pens_judiciaria_adic_natal_2}&pens_judiciaria_adic_natal_3=${this.pens_judiciaria_adic_natal_3}&pens_judiciaria_adic_natal_4=${this.pens_judiciaria_adic_natal_4}&pens_judiciaria_adic_natal_5=${this.pens_judiciaria_adic_natal_5}&pens_judiciaria_adic_natal_6=${this.pens_judiciaria_adic_natal_6}`;

            await axios
                .get(`${this.nowPath}/api/ficha-auxiliar?${data}`)
                .then((r) => (this.$store.state.dadosFinanceiros = r.data))
                .catch((e) => alert(e));
        },
        saveForm() {
            let formSaved = {
                universo: this.universo,
                data_contracheque: this.data_contracheque,
                maior_65: this.maior_65,
                isento_ir: this.isento_ir,
                pg_soldo: this.pg_soldo,
                pg_real: this.pg_real,
                tipo_soldo: this.tipo_soldo,
                soldo_cota_porcentagem: this.soldo_cota_porcentagem,
                soldo_prop_cota_porcentagem: this.soldo_prop_cota_porcentagem,
                compl_ct_soldo: this.compl_ct_soldo,
                adic_tp_sv: this.adic_tp_sv,
                adic_disp: this.adic_disp,
                adic_hab_tipo: this.adic_hab_tipo,
                adic_mil: this.adic_mil,
                adic_comp_org_tipo: this.adic_comp_org_tipo,
                adic_comp_org_percet: this.adic_comp_org_percet,
                adic_comp_org_pg: this.adic_comp_org_pg,
                hvoo_percet: this.hvoo_percet,
                hvoo_pg: this.hvoo_pg,
                acres_25_soldo: this.acres_25_soldo,
                adic_perm: this.adic_perm,
                salario_familia_dep: this.salario_familia_dep,
                imposto_renda_dep: this.imposto_renda_dep,
                adic_ferias: this.adic_ferias,
                adic_pttc: this.adic_pttc,
                adic_natalino: this.adic_natalino,
                adic_natalino_qtd_meses: this.adic_natalino_qtd_meses,
                adic_natalino_valor_adiantamento:
                    this.adic_natalino_valor_adiantamento,
                aux_pre_escolar_qtd: this.aux_pre_escolar_qtd,
                aux_invalidez: this.aux_invalidez,
                aux_transporte: this.aux_transporte,
                aux_fard: this.aux_fard,
                aux_fard_primeiro: this.aux_fard_primeiro,
                aux_alim_c: this.aux_alim_c,
                aux_alim_5x: this.aux_alim_5x,
                aux_natalidade: this.aux_natalidade,
                grat_loc_esp: this.grat_loc_esp,
                grat_repr_cmdo: this.grat_repr_cmdo,
                grat_repr_2: this.grat_repr_2,
                grat_repr_2_pg: this.grat_repr_2_pg,
                dp_excmb_art_9: this.dp_excmb_art_9,
                pmil: this.pmil,
                pmilmesmopg: this.pmilmesmopg,
                pmil_pg: this.pmil_pg,
                pmil_15: this.pmil_15,
                pmil_30: this.pmil_30,
                fusex_3: this.fusex_3,
                desc_dep_fusex: this.desc_dep_fusex,
                pnr: this.pnr,
                pens_judiciaria_1: this.pens_judiciaria_1,
                pens_judiciaria_2: this.pens_judiciaria_2,
                pens_judiciaria_3: this.pens_judiciaria_3,
                pens_judiciaria_4: this.pens_judiciaria_4,
                pens_judiciaria_5: this.pens_judiciaria_5,
                pens_judiciaria_6: this.pens_judiciaria_6,
                pens_judiciaria_adic_natal_1: this.pens_judiciaria_adic_natal_1,
                pens_judiciaria_adic_natal_2: this.pens_judiciaria_adic_natal_2,
                pens_judiciaria_adic_natal_3: this.pens_judiciaria_adic_natal_3,
                pens_judiciaria_adic_natal_4: this.pens_judiciaria_adic_natal_4,
                pens_judiciaria_adic_natal_5: this.pens_judiciaria_adic_natal_5,
                pens_judiciaria_adic_natal_6: this.pens_judiciaria_adic_natal_6,
                form_soldo_cota: this.form_soldo_cota,
                form_soldo_prop_cota: this.form_soldo_prop_cota,
                form_compl_ct_soldo: this.form_compl_ct_soldo,
                form_adic_tp_sv: this.form_adic_tp_sv,
                form_adic_disp: this.form_adic_disp,
                form_adic_hab: this.form_adic_hab,
                form_adic_mil: this.form_adic_mil,
                form_adic_comp_org: this.form_adic_comp_org,
                form_hvoo: this.form_hvoo,
                form_acres_25_soldo: this.form_acres_25_soldo,
                form_adic_perm: this.form_adic_perm,
                form_salario_familia_ir: this.form_salario_familia_ir,
                form_adic_ferias: this.form_adic_ferias,
                form_adic_pttc: this.form_adic_pttc,
                form_adic_natalino: this.form_adic_natalino,
                form_aux_pre_escolar: this.form_aux_pre_escolar,
                form_aux_invalidez: this.form_aux_invalidez,
                form_aux_transporte: this.form_aux_transporte,
                form_aux_fard: this.form_aux_fard,
                form_aux_fard_primeiro: this.form_aux_fard_primeiro,
                form_aux_alim_c: this.form_aux_alim_c,
                form_aux_alim_5x: this.form_aux_alim_5x,
                form_aux_natalidade: this.form_aux_natalidade,
                form_grat_loc_esp: this.form_grat_loc_esp,
                form_grat_repr_cmdo: this.form_grat_repr_cmdo,
                form_grat_repr_2: this.form_grat_repr_2,
                form_dp_excmb_art_9: this.form_dp_excmb_art_9,
                form_pmil: this.form_pmil,
                form_pmil_15: this.form_pmil_15,
                form_pmil_30: this.form_pmil_30,
                form_fusex_3: this.form_fusex_3,
                form_desc_dep_fusex: this.form_desc_dep_fusex,
                form_pnr: this.form_pnr,
                form_pens_judiciaria: this.form_pens_judiciaria,
                f_aux_transporte: this.f_aux_transporte,
                f_aux_alim_5x: this.f_aux_alim_5x,
                f_aux_natalidade: this.f_aux_natalidade,
                f_hvoo: this.f_hvoo,
                f_grat_repr_2: this.f_grat_repr_2,
                f_pnr: this.f_pnr,
                f_pens_judiciaria: this.f_pens_judiciaria,
            };

            this.$store.state.backupForm = formSaved;
        },
        cleanForm() {
            this.$store.state.contrachequeAtivo = false;
            window.location.reload();
        },
        restoreForm() {
            let form = this.$store.state.backupForm;
            if (form) {
                this.universo = form.universo;
                this.data_contracheque = form.data_contracheque;
                this.maior_65 = form.maior_65;
                this.isento_ir = form.isento_ir;
                this.pg_soldo = form.pg_soldo;
                this.pg_real = form.pg_real;
                this.tipo_soldo = form.tipo_soldo;
                this.soldo_cota_porcentagem = form.soldo_cota_porcentagem;
                this.soldo_prop_cota_porcentagem =
                    form.soldo_prop_cota_porcentagem;
                this.compl_ct_soldo = form.compl_ct_soldo;
                this.adic_tp_sv = form.adic_tp_sv;
                this.adic_disp = form.adic_disp;
                this.adic_hab_tipo = form.adic_hab_tipo;
                this.adic_mil = form.adic_mil;
                this.adic_comp_org_tipo = form.adic_comp_org_tipo;
                this.adic_comp_org_percet = form.adic_comp_org_percet;
                this.adic_comp_org_pg = form.adic_comp_org_pg;
                this.hvoo_percet = form.hvoo_percet;
                this.hvoo_pg = form.hvoo_pg;
                this.acres_25_soldo = form.acres_25_soldo;
                this.adic_perm = form.adic_perm;
                this.salario_familia_dep = form.salario_familia_dep;
                this.imposto_renda_dep = form.imposto_renda_dep;
                this.adic_ferias = form.adic_ferias;
                this.adic_pttc = form.adic_pttc;
                this.adic_natalino = form.adic_natalino;
                this.adic_natalino_qtd_meses = form.adic_natalino_qtd_meses;
                this.adic_natalino_valor_adiantamento =
                    form.adic_natalino_valor_adiantamento;
                this.aux_pre_escolar_qtd = form.aux_pre_escolar_qtd;
                this.aux_invalidez = form.aux_invalidez;
                this.aux_transporte = form.aux_transporte;
                this.aux_fard = form.aux_fard;
                this.aux_fard_primeiro = form.aux_fard_primeiro;
                this.aux_alim_c = form.aux_alim_c;
                this.aux_alim_5x = form.aux_alim_5x;
                this.aux_natalidade = form.aux_natalidade;
                this.grat_loc_esp = form.grat_loc_esp;
                this.grat_repr_cmdo = form.grat_repr_cmdo;
                this.grat_repr_2 = form.grat_repr_2;
                this.grat_repr_2_pg = form.grat_repr_2_pg;
                this.dp_excmb_art_9 = form.dp_excmb_art_9;
                this.pmil = form.pmil;
                this.pmilmesmopg = form.pmilmesmopg;
                this.pmil_pg = form.pmil_pg;
                this.pmil_15 = form.pmil_15;
                this.pmil_30 = form.pmil_30;
                this.fusex_3 = form.fusex_3;
                this.desc_dep_fusex = form.desc_dep_fusex;
                this.pnr = form.pnr;
                this.pens_judiciaria_1 = form.pens_judiciaria_1;
                this.pens_judiciaria_2 = form.pens_judiciaria_2;
                this.pens_judiciaria_3 = form.pens_judiciaria_3;
                this.pens_judiciaria_4 = form.pens_judiciaria_4;
                this.pens_judiciaria_5 = form.pens_judiciaria_5;
                this.pens_judiciaria_6 = form.pens_judiciaria_6;
                this.pens_judiciaria_adic_natal_1 =
                    form.pens_judiciaria_adic_natal_1;
                this.pens_judiciaria_adic_natal_2 =
                    form.pens_judiciaria_adic_natal_2;
                this.pens_judiciaria_adic_natal_3 =
                    form.pens_judiciaria_adic_natal_3;
                this.pens_judiciaria_adic_natal_4 =
                    form.pens_judiciaria_adic_natal_4;
                this.pens_judiciaria_adic_natal_5 =
                    form.pens_judiciaria_adic_natal_5;
                this.pens_judiciaria_adic_natal_6 =
                    form.pens_judiciaria_adic_natal_6;
                this.form_soldo_cota = form.form_soldo_cota;
                this.form_soldo_prop_cota = form.form_soldo_prop_cota;
                this.form_compl_ct_soldo = form.form_compl_ct_soldo;
                this.form_adic_tp_sv = form.form_adic_tp_sv;
                this.form_adic_disp = form.form_adic_disp;
                this.form_adic_hab = form.form_adic_hab;
                this.form_adic_mil = form.form_adic_mil;
                this.form_adic_comp_org = form.form_adic_comp_org;
                this.form_hvoo = form.form_hvoo;
                this.form_acres_25_soldo = form.form_acres_25_soldo;
                this.form_adic_perm = form.form_adic_perm;
                this.form_salario_familia_ir = form.form_salario_familia_ir;
                this.form_adic_ferias = form.form_adic_ferias;
                this.form_adic_pttc = form.form_adic_pttc;
                this.form_adic_natalino = form.form_adic_natalino;
                this.form_aux_pre_escolar = form.form_aux_pre_escolar;
                this.form_aux_invalidez = form.form_aux_invalidez;
                this.form_aux_transporte = form.form_aux_transporte;
                this.form_aux_fard = form.form_aux_fard;
                this.form_aux_fard_primeiro = form.form_aux_fard_primeiro;
                this.form_aux_alim_c = form.form_aux_alim_c;
                this.form_aux_alim_5x = form.form_aux_alim_5x;
                this.form_aux_natalidade = form.form_aux_natalidade;
                this.form_grat_loc_esp = form.form_grat_loc_esp;
                this.form_grat_repr_cmdo = form.form_grat_repr_cmdo;
                this.form_grat_repr_2 = form.form_grat_repr_2;
                this.form_dp_excmb_art_9 = form.form_dp_excmb_art_9;
                this.form_pmil = form.form_pmil;
                this.form_pmil_15 = form.form_pmil_15;
                this.form_pmil_30 = form.form_pmil_30;
                this.form_fusex_3 = form.form_fusex_3;
                this.form_desc_dep_fusex = form.form_desc_dep_fusex;
                this.form_pnr = form.form_pnr;
                this.form_pens_judiciaria = form.form_pens_judiciaria;
                this.f_aux_transporte = form.f_aux_transporte;
                this.f_aux_alim_5x = form.f_aux_alim_5x;
                this.f_aux_natalidade = form.f_aux_natalidade;
                this.f_hvoo = form.f_hvoo;
                this.f_grat_repr_2 = form.f_grat_repr_2;
                this.f_pnr = form.f_pnr;
                this.f_pens_judiciaria = form.f_pens_judiciaria;
            }
        },
    },
    mounted() {
        this.carregaSelectPg();
        this.restoreForm();
    },
};
</script>
