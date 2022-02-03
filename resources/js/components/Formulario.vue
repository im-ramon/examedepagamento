<template>
    <form id="formulario" v-on:submit.prevent="geraDadosFinanceiros">
        <input type="hidden" name="_token" :value="form_token" />
        <section id="form_informacoes_pessoais">
            <h2>Informações gerais</h2>
            {{ $store.state.dadosFinanceiros }} // Debug
            <fieldset class="question_root">
                <ajuda-component>
                    <p>
                        Hue Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Aperiam fugiat, magnam tempore neque error
                        assumenda a voluptates rerum tempora quibusdam aliquid
                        doloremque obcaecati eum eveniet voluptate harum
                        voluptatum vitae cumque?
                    </p>
                </ajuda-component>
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
                <ajuda-component>
                    <p>
                        Hue Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Aperiam fugiat, magnam tempore neque error
                        assumenda a voluptates rerum tempora quibusdam aliquid
                        doloremque obcaecati eum eveniet voluptate harum
                        voluptatum vitae cumque?
                    </p>
                </ajuda-component>
                <legend>Data do contracheque</legend>
                <section class="question_body">
                    <div class="question_title">
                        <p>Qual a <strong>data do contracheque</strong>?</p>
                    </div>
                    <div class="question_options">
                        <input
                            name="data_contracheque"
                            id="date"
                            type="date"
                            :value="data_contracheque"
                        />
                    </div>
                </section>
            </fieldset>

            <fieldset class="question_root">
                <ajuda-component>
                    <p>
                        Hue Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Aperiam fugiat, magnam tempore neque error
                        assumenda a voluptates rerum tempora quibusdam aliquid
                        doloremque obcaecati eum eveniet voluptate harum
                        voluptatum vitae cumque?
                    </p>
                </ajuda-component>
                <legend>Idade</legend>
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
                <ajuda-component>
                    <p>
                        Hue Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Aperiam fugiat, magnam tempore neque error
                        assumenda a voluptates rerum tempora quibusdam aliquid
                        doloremque obcaecati eum eveniet voluptate harum
                        voluptatum vitae cumque?
                    </p>
                </ajuda-component>
                <legend>Isenção de Imposto de Renda</legend>
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
                <ajuda-component>
                    <p>
                        Hue Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Aperiam fugiat, magnam tempore neque error
                        assumenda a voluptates rerum tempora quibusdam aliquid
                        doloremque obcaecati eum eveniet voluptate harum
                        voluptatum vitae cumque?
                    </p>
                </ajuda-component>
                <legend>P/G Soldo</legend>
                <section class="question_body">
                    <div class="question_title">
                        <p>
                            Qual o P/G em que o examinado recebe o
                            <strong>soldo</strong>?
                        </p>
                    </div>
                    <div class="question_options">
                        <select name="pg_soldo" v-model="pg_soldo">
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
                <ajuda-component>
                    <p>
                        Hue Lorem ipsum dolor sit amet consectetur adipisicing
                        elit. Aperiam fugiat, magnam tempore neque error
                        assumenda a voluptates rerum tempora quibusdam aliquid
                        doloremque obcaecati eum eveniet voluptate harum
                        voluptatum vitae cumque?
                    </p>
                </ajuda-component>
                <legend>P/G Real</legend>
                <section class="question_body">
                    <div class="question_title">
                        <p>Qual o P/G <strong>real</strong> do examinado?</p>
                    </div>
                    <div class="question_options">
                        <select name="pg_real" v-model="pg_real">
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Soldo</legend>
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

                <fieldset class="question_root" v-show="form_soldo_cota">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Cota-parte do Soldo</legend>
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

                <fieldset class="question_root" v-show="form_soldo_prop_cota">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Soldo Proporcional para Cota</legend>
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

                <fieldset class="question_root" v-show="form_compl_ct_soldo">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Complemento de cota de soldo</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional de Tempo de Serviço</legend>
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

                <fieldset class="question_root" v-show="form_adic_disp">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>
                        Adicional de Compensação por Disponibilidade Militar
                    </legend>
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

                <fieldset class="question_root" v-show="form_adic_hab">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional Habilitação</legend>
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

                <fieldset class="question_root" v-show="form_adic_mil">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional Militar</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional de Compensação Orgânica</legend>
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
                                <option value="0">
                                    - Selecione uma opção -
                                </option>
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

                <fieldset class="question_root" v-show="form_hvoo">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional de Horas de Voo (ART24MP)</legend>
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
                                name="f_hvoo"
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

                <fieldset class="question_root" v-show="form_acres_25_soldo">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional de Acréscimo de 25% sobre o soldo</legend>
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

                <fieldset class="question_root" v-show="form_adic_perm">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional de Permanência</legend>
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

                <fieldset
                    class="question_root"
                    v-show="form_salario_familia_ir"
                >
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Salário família/ Imposto de Renda</legend>
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

                <fieldset class="question_root" v-show="form_adic_ferias">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional de Férias</legend>
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

                <fieldset class="question_root" v-show="form_adic_pttc">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional PTTC</legend>
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

                <fieldset class="question_root" v-show="form_adic_natalino">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Adicional Natalino</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Pré-escolar</legend>
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
            </section>

            <section id="form_informacoes_financeiras_col2">
                <fieldset class="question_root" v-show="form_aux_invalidez">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Inavalidez</legend>
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
                <fieldset class="question_root" v-show="form_aux_transporte">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Transporte</legend>
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

                <fieldset class="question_root" v-show="form_aux_fard">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Fardamento</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Alimentação - Tipo "C"</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Alimentação - 5x</legend>
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

                <fieldset class="question_root" v-show="form_aux_natalidade">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Auxílio Natalidade</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Gratificação de Localidade Especial</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Gratificação de Representação de Comando</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Gratificação de Representação 2%</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>
                        Pensionada Pensionista de Ex-Combatente - Art. 9
                    </legend>
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

                <fieldset class="question_root" v-show="form_pmil">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Pensão Militar</legend>
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

                <fieldset class="question_root" v-show="form_pmil_15">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Pensão Militar 1.5%</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Pensão Militar 3.0%</legend>
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

                <fieldset class="question_root" v-show="form_fusex_3">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>FuSEx 3%</legend>
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

                <fieldset class="question_root" v-show="form_desc_dep_fusex">
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Desconto de dependentes no FuSEx</legend>
                    <section class="question_body">
                        <div class="question_title">
                            <p>
                                Possui quantos dependentes,
                                <u>excluíndo a esposa</u>, como dependente no
                                <strong>FuSEx</strong>?
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>PNR</legend>
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
                    <ajuda-component>
                        <p>
                            Hue Lorem ipsum dolor sit amet consectetur
                            adipisicing elit. Aperiam fugiat, magnam tempore
                            neque error assumenda a voluptates rerum tempora
                            quibusdam aliquid doloremque obcaecati eum eveniet
                            voluptate harum voluptatum vitae cumque?
                        </p>
                    </ajuda-component>
                    <legend>Pensão Judiciária</legend>
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
        <button type="submit" id="gerar">Gerar contracheque</button>
    </form>
</template>

<script>
import axios from "axios";

export default {
    props: ["form_token"],
    computed: {
        token() {
            let token = document.cookie.split(";").find((indice) => {
                return indice.startsWith("token=");
            });

            token = token.split("=")[1];
            token = "Bearer " + token;

            return token;
        },
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
    data() {
        return {
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
    methods: {
        carregaSelectPg() {
            let config = {
                headers: {
                    Accept: "application/json",
                    Authorization: this.token,
                },
            };

            axios
                .get("http://localhost:8000/api/pg-constantes", config)
                .then((r) => (this.selectPg = r.data))
                .catch((e) => console.log(e));
        },

        geraDadosFinanceiros() {
            let data = `_token=${this.token}&universo=${this.universo}&data_contracheque=${this.data_contracheque}&maior_65=${this.maior_65}&isento_ir=${this.isento_ir}&pg_soldo=${this.pg_soldo}&pg_real=${this.pg_real}&tipo_soldo=${this.tipo_soldo}&soldo_cota_porcentagem=${this.soldo_cota_porcentagem}&soldo_prop_cota_porcentagem=${this.soldo_prop_cota_porcentagem}&compl_ct_soldo=${this.compl_ct_soldo}&adic_tp_sv=${this.adic_tp_sv}&adic_disp=${this.adic_disp}&adic_hab_tipo=${this.adic_hab_tipo}&adic_mil=${this.adic_mil}&adic_comp_org_tipo=${this.adic_comp_org_tipo}&adic_comp_org_percet=${this.adic_comp_org_percet}&adic_comp_org_pg=${this.adic_comp_org_pg}&hvoo_percet=${this.hvoo_percet}&hvoo_pg=${this.hvoo_pg}&acres_25_soldo=${this.acres_25_soldo}&adic_perm=${this.adic_perm}&salario_familia_dep=${this.salario_familia_dep}&imposto_renda_dep=${this.imposto_renda_dep}&adic_ferias=${this.adic_ferias}&adic_pttc=${this.adic_pttc}&adic_natalino=${this.adic_natalino}&adic_natalino_qtd_meses=${this.adic_natalino_qtd_meses}&adic_natalino_valor_adiantamento=${this.adic_natalino_valor_adiantamento}&aux_pre_escolar_qtd=${this.aux_pre_escolar_qtd}&aux_invalidez=${this.aux_invalidez}&aux_transporte=${this.aux_transporte}&aux_fard=${this.aux_fard}&aux_fard_primeiro=${this.aux_fard_primeiro}&aux_alim_c=${this.aux_alim_c}&aux_alim_5x=${this.aux_alim_5x}&aux_natalidade=${this.aux_natalidade}&grat_loc_esp=${this.grat_loc_esp}&grat_repr_cmdo=${this.grat_repr_cmdo}&grat_repr_2=${this.grat_repr_2}&grat_repr_2_pg=${this.grat_repr_2_pg}&dp_excmb_art_9=${this.dp_excmb_art_9}&pmil=${this.pmil}&pmilmesmopg=${this.pmilmesmopg}&pmil_pg=${this.pmil_pg}&pmil_15=${this.pmil_15}&pmil_30=${this.pmil_30}&fusex_3=${this.fusex_3}&desc_dep_fusex=${this.desc_dep_fusex}&pnr=${this.pnr}&pens_judiciaria_1=${this.pens_judiciaria_1}&pens_judiciaria_2=${this.pens_judiciaria_2}&pens_judiciaria_3=${this.pens_judiciaria_3}&pens_judiciaria_4=${this.pens_judiciaria_4}&pens_judiciaria_5=${this.pens_judiciaria_5}&pens_judiciaria_6=${this.pens_judiciaria_6}&pens_judiciaria_adic_natal_1=${this.pens_judiciaria_adic_natal_1}&pens_judiciaria_adic_natal_2=${this.pens_judiciaria_adic_natal_2}&pens_judiciaria_adic_natal_3=${this.pens_judiciaria_adic_natal_3}&pens_judiciaria_adic_natal_4=${this.pens_judiciaria_adic_natal_4}&pens_judiciaria_adic_natal_5=${this.pens_judiciaria_adic_natal_5}&pens_judiciaria_adic_natal_6=${this.pens_judiciaria_adic_natal_6}`;
            let config = {
                headers: {
                    Accept: "application/json",
                    Authorization: this.token,
                    // 'Content-Type': 'multipart/form-data'
                },
            };

            axios
                .get("http://localhost:8000/api/ficha-auxiliar?" + data, config)
                .then((r) => (this.$store.state.dadosFinanceiros = r.data))
                .catch((e) => alert(e));
        },
    },
    mounted() {
        this.carregaSelectPg();
    },
};
</script>
