<template>
    <section id="ficha_auxilitar">
        <div id="contrachequeAtivo">
            <label>Código do contracheque:</label>
            <input
                type="text"
                disabled
                :value="$store.state.contrachequeAtivo || '-'"
            />
        </div>
        <button onClick="window.print()">IMPRIMIR</button>
        <button @click="salvarNoBancoDeDados">SALVAR</button>
        <table
            cellpadding="0"
            cellspacing="0"
            v-if="this.$store.state.dadosFinanceiros"
        >
            <tr>
                <th
                    class="td_cabecalho"
                    style="text-align: center"
                    colspan="11"
                >
                    <p>FICHA AUXILIAR</p>
                </th>
            </tr>
            <tr>
                <td class="td_cabecalho" style="text-align: left">
                    <p>UG:</p>
                </td>
                <td class="td_cabecalho" colspan="3">
                    <input
                        type="text"
                        placeholder="Sigla da UG"
                        name="UG"
                        id="UG"
                    />
                </td>
                <td class="td_cabecalho mes">
                    <p>M&Ecirc;S:</p>
                </td>
                <td class="td_cabecalho mes_info" colspan="6">
                    <p>
                        {{
                            $store.state.dadosFinanceiros.informacoes.date
                                | dateToDateFormated
                        }}
                    </p>
                </td>
            </tr>
            <tr>
                <td class="td_cabecalho">
                    <p>NOME:</p>
                </td>
                <td class="td_cabecalho" colspan="5">
                    <input
                        type="text"
                        placeholder="Nome completo"
                        name="nome"
                        id="nome"
                    />
                </td>
                <td class="td_cabecalho pg">
                    <p>P/G:</p>
                </td>
                <td class="td_cabecalho pg_abrev">
                    <p>
                        {{ dadosApiCompleto.informacoes.pg_real_info.pg_abrev }}
                    </p>
                </td>
            </tr>
            <tr>
                <td class="td_cabecalho">
                    <p>IDT:</p>
                </td>
                <td class="td_cabecalho" colspan="2">
                    <input
                        type="text"
                        placeholder="Número da identidade"
                        name="identidade"
                        id="identidade"
                    />
                </td>
                <td class="td_cabecalho">
                    <p>CPF:</p>
                </td>
                <td class="td_cabecalho" colspan="9">
                    <input
                        type="text"
                        placeholder="Número do CPF"
                        name="cpf"
                        id="cpf"
                    />
                </td>
            </tr>
            <tr>
                <td class="td_calculos" rowspan="18">
                    <p>R</p>
                    <p>E</p>
                    <p>C</p>
                    <p>E</p>
                    <p>I</p>
                    <p>T</p>
                    <p>A</p>
                    <p>S</p>
                </td>
                <td class="td_calculos" colspan="2">
                    <p>DISCRIMINA&Ccedil;&Atilde;O</p>
                </td>
                <td class="td_calculos">
                    <p>%</p>
                </td>
                <td class="td_calculos">
                    <p>VALOR<br />PESQUISADO</p>
                </td>
                <td class="td_calculos valor_contracheque">
                    <p>VALOR<br />CONTRACHEQUE</p>
                </td>
                <td class="td_calculos obs" colspan="5" rowspan="19">
                    <p>OBSERVA&Ccedil;&Otilde;ES</p>
                    <textarea
                        id="observacoes_receitas"
                        name="observacoes_receitas"
                        rows="18"
                    ></textarea>
                </td>
            </tr>

            <tr v-for="(data, key) in dadosApiReceitas" :key="key">
                <td class="td_calculos rubrica" colspan="2">
                    {{ data.rubrica }}
                </td>
                <td class="td_calculos">{{ data.financeiro.porcentagem }}</td>
                <td class="td_calculos valor">
                    {{ data.financeiro.valor | numeroPreco }}
                </td>
                <td class="td_calculos valor">
                    <input
                        type="text"
                        :value="data.financeiro.valor | numeroPreco"
                        step="0.01"
                    />
                </td>
            </tr>

            <tr>
                <td class="td_calculos" colspan="4">
                    <p>SOMA</p>
                </td>
                <td class="td_calculos valor">
                    {{
                        dadosApiCompleto.receitas.bruto_total.financeiro.valor
                            | numeroPreco
                    }}
                </td>
                <td class="td_calculos valor">
                    <p>
                        {{
                            dadosApiCompleto.receitas.bruto_total.financeiro
                                .valor | numeroPreco
                        }}
                    </p>
                </td>
            </tr>

            <!-- DESCONTOS -->
            <tr>
                <td class="td_calculos" rowspan="18">
                    <p>D</p>
                    <p>E</p>
                    <p>S</p>
                    <p>P</p>
                    <p>E</p>
                    <p>S</p>
                    <p>A</p>
                    <p>S</p>
                </td>
                <td class="td_calculos" colspan="2">
                    <p>DISCRIMINA&Ccedil;&Atilde;O</p>
                </td>
                <td class="td_calculos">
                    <p>%</p>
                </td>
                <td class="td_calculos">
                    <p>VALOR<br />PESQUISADO</p>
                </td>
                <td class="td_calculos">
                    <p>VALOR<br />CONTRACHEQUE</p>
                </td>
                <td class="td_calculos obs" colspan="5" rowspan="19">
                    <p>OBSERVA&Ccedil;&Otilde;ES</p>
                    <textarea
                        id="observacoes_descontos"
                        name="observacoes_descontos"
                        rows="18"
                    ></textarea>
                </td>
            </tr>

            <tr
                v-for="(data, key) in dadosApiDescontos"
                :key="key + data.rubrica"
            >
                <td class="td_calculos rubrica" colspan="2">
                    {{ data.rubrica }}
                </td>
                <td class="td_calculos">{{ data.financeiro.porcentagem }}</td>
                <td class="td_calculos valor">
                    {{ data.financeiro.valor | numeroPreco }}
                </td>
                <td class="td_calculos valor">
                    <input
                        type="text"
                        :value="data.financeiro.valor | numeroPreco"
                        step="0.01"
                    />
                </td>
            </tr>

            <tr>
                <td class="td_calculos" colspan="4">
                    <p>SOMA</p>
                </td>
                <td class="td_calculos valor">
                    {{
                        dadosApiCompleto.descontos.descontos_total.financeiro
                            .valor | numeroPreco
                    }}
                </td>
                <td class="td_calculos valor">
                    <p>
                        {{
                            dadosApiCompleto.descontos.descontos_total
                                .financeiro.valor | numeroPreco
                        }}
                    </p>
                </td>
            </tr>

            <tr>
                <td class="td_calculos" colspan="4">
                    <p>LÍQUIDO A RECEBER</p>
                </td>
                <td class="td_calculos valor">
                    <p>
                        {{
                            (dadosApiCompleto.receitas.bruto_total.financeiro
                                .valor -
                                dadosApiCompleto.descontos.descontos_total
                                    .financeiro.valor)
                                | numeroPreco
                        }}
                    </p>
                </td>
                <td class="td_calculos valor">
                    <p>
                        {{
                            (dadosApiCompleto.receitas.bruto_total.financeiro
                                .valor -
                                dadosApiCompleto.descontos.descontos_total
                                    .financeiro.valor)
                                | numeroPreco
                        }}
                    </p>
                </td>
                <td class="td_calculos" colspan="4">
                    <p>
                        <!-- OBSERVAÇÕES AQUI -->
                    </p>
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <p>
                        {{ $store.state.activeUser.local_assinatura }}, DATA DA
                        ASSINATURA AQUI!!!
                    </p>
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <p>
                        <strong
                            >{{ $store.state.activeUser.name }} -
                            {{ $store.state.activeUser.post_grad }}</strong
                        >
                    </p>
                    <p>Membro da Equipe</p>
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <p>
                        <strong
                            >{{ $store.state.activeUser.ch_equipe_name }} -
                            {{ $store.state.activeUser.ch_equipe_pg }}</strong
                        >
                    </p>
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <p>Chefe da Equipe</p>
                </td>
            </tr>
            <tr>
                <td class="td_assinatura" colspan="11">
                    <br />
                </td>
            </tr>
            <tr>
                <td class="td_assinatura fc_footer" colspan="11">
                    <p>
                        ESTA FICHA DEVER&Aacute; FICAR &Agrave;
                        DISPOSI&Ccedil;&Atilde;O DOS &Oacute;RG&Atilde;OS DE
                        CONTROLE INTERNO E EXTERNO, POR UM PER&Iacute;ODO NUNCA
                        INFERIOR A UM ANO.
                    </p>
                </td>
            </tr>
        </table>
        <transition name="fade" appear>
            <div
                v-show="modalActive"
                id="modalRespostaBD"
                :class="modalType == 'success' ? 'success' : 'erro'"
            >
                <div id="modalRespostaBD_container">
                    <span @click="modalActive = false">X</span>
                    <!-- style="background: red" -->
                    <p v-if="modalType == 'success'">
                        Contracheque salvo com sucesso! <br />
                        O código identificador do contracheque é:
                        <strong>{{ identificadoContracheque }}</strong> <br />
                        Guarde esse número!<br />
                        Você precisará dele para consultar seu contracheque
                        futuramente.
                    </p>

                    <p v-else>
                        Desculpe, o registro não pode ser inserido. <br />
                        Informe esse erro ou adminitrador do sistema: <br />
                        <strong>{{ modalType }}</strong>
                    </p>
                </div>
            </div>
        </transition>
    </section>
</template>

<style>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s, transform 0.5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
    opacity: 0;
    transform: translateY(-1em);
}
</style>

<script>
export default {
    data() {
        return {
            identificadoContracheque: "-",
            modalActive: false,
            modalType: "-",
        };
    },
    computed: {
        dadosApiReceitas() {
            let data = [];
            for (const key in this.$store.state.dadosFinanceiros.receitas) {
                if (
                    this.$store.state.dadosFinanceiros.receitas[key].financeiro
                        .valor > 0 &&
                    this.$store.state.dadosFinanceiros.receitas[key].rubrica !=
                        "BRUTO TOTAL" &&
                    this.$store.state.dadosFinanceiros.receitas[key].rubrica !=
                        "BRUTO PARA IR"
                ) {
                    data.push(this.$store.state.dadosFinanceiros.receitas[key]);
                }
            }
            for (let i = 0; data.length < 17; i++) {
                data.push({
                    financeiro: {
                        valor: "\n",
                        porcentagem: "\n",
                    },
                    rubrica: "\n",
                });
            }

            return data;
        },

        dadosApiDescontos() {
            let data = [];
            for (const key in this.$store.state.dadosFinanceiros.descontos) {
                if (
                    this.$store.state.dadosFinanceiros.descontos[key].financeiro
                        .valor > 0 &&
                    this.$store.state.dadosFinanceiros.descontos[key].rubrica !=
                        "DESCONTOS TOTAL" &&
                    this.$store.state.dadosFinanceiros.descontos[key].rubrica !=
                        "DESCONTOS PARA IR"
                ) {
                    data.push(
                        this.$store.state.dadosFinanceiros.descontos[key]
                    );
                }
            }
            for (let i = 0; data.length < 17; i++) {
                data.push({
                    financeiro: {
                        valor: "\n",
                        porcentagem: "\n",
                    },
                    rubrica: "\n",
                });
            }

            return data;
        },

        dadosApiCompleto() {
            return this.$store.state.dadosFinanceiros;
        },

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
    methods: {
        salvarNoBancoDeDados() {
            let ficha_auxiliar_json = JSON.stringify(
                this.$store.state.backupForm
            );

            let config = {
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    Authorization: this.token,
                },
            };

            if (this.$store.state.contrachequeAtivo) {
                axios
                    .patch(
                        `${this.nowPath}/api/ficha-auxiliar/${this.$store.state.contrachequeAtivo}`,
                        {
                            ficha_auxiliar_json,
                            user_email: this.$store.state.activeUser.email,
                        },
                        config
                    )
                    .then((r) => {
                        this.alertSuccess(
                            this.$store.state.contrachequeAtivo,
                            true
                        );
                        setTimeout(() => {
                            this.$router.push("/gerenciar-contracheque"); /// ATENÇÃO AQUI - PODE DAR ERRADO
                        }, 2000);
                    })
                    .catch((e) => console.log(e));
            } else {
                axios
                    .post(
                        `${this.nowPath}/api/ficha-auxiliar`,
                        {
                            ficha_auxiliar_json,
                            user_email: this.$store.state.activeUser.email,
                        },
                        config
                    )
                    .then((r) => this.alertSuccess(r.data.id, true))
                    .catch((e) => this.alertSuccess(e, false));
            }
        },
        alertSuccess(id, success) {
            if (success) {
                this.identificadoContracheque = id;
                this.modalActive = true;
                this.modalType = "success";
            } else {
                this.modalActive = true;
                this.modalType = id;
            }
        },
    },
    filters: {
        numeroPreco(value) {
            return value.toLocaleString("pt-BR", {
                style: "currency",
                currency: "BRL",
            });
        },
        dateToDateFormated(value) {
            let data = value.split("-");
            return `${data[1]}/${data[0]}`;
        },
        data_extenso(value) {
            let dia = "d";
            let mes = "m";
            value.split("-")[1] == "01" && (mes = "janeiro");
            value.split("-")[1] == "02" && (mes = "fevereiro");
            value.split("-")[1] == "03" && (mes = "março");
            value.split("-")[1] == "04" && (mes = "abril");
            value.split("-")[1] == "05" && (mes = "maio");
            value.split("-")[1] == "06" && (mes = "junho");
            value.split("-")[1] == "07" && (mes = "julho");
            value.split("-")[1] == "08" && (mes = "agosto");
            value.split("-")[1] == "09" && (mes = "setembro");
            value.split("-")[1] == "10" && (mes = "outubro");
            value.split("-")[1] == "11" && (mes = "novembro");
            value.split("-")[1] == "12" && (mes = "dezembro");
            // ----------------------------------------------//
            value.split("-")[2] == "01" && (dia = "1º");
            value.split("-")[2] == "02" && (dia = "2");
            value.split("-")[2] == "03" && (dia = "3");
            value.split("-")[2] == "04" && (dia = "4");
            value.split("-")[2] == "05" && (dia = "5");
            value.split("-")[2] == "06" && (dia = "6");
            value.split("-")[2] == "07" && (dia = "7");
            value.split("-")[2] == "08" && (dia = "8");
            value.split("-")[2] == "09" && (dia = "9");
            // ----------------------------------------------//
            return `${dia} de ${mes} de ${value.split("-")[0]}.`;
        },
    },
};
</script>
