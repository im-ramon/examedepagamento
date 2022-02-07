<template>
    <table
        cellpadding="0"
        cellspacing="0"
        v-if="this.$store.state.dadosFinanceiros"
    >
        <tr>
            <th class="td_cabecalho" style="text-align: center" colspan="11">
                <p>FICHA AUXILIAR</p>
            </th>
        </tr>
        <tr>
            <td class="td_cabecalho" style="text-align: left">
                <p>UG:</p>
            </td>
            <td class="td_cabecalho" colspan="3">
                <p>35º BI</p>
            </td>
            <td class="td_cabecalho">
                <p>M&Ecirc;S:</p>
            </td>
            <td class="td_cabecalho" colspan="6">
                <p>SET/21</p>
            </td>
        </tr>
        <tr>
            <td class="td_cabecalho">
                <p>NOME:</p>
            </td>
            <td class="td_cabecalho" colspan="5">
                <p>RAMON OLIVEIRA DOS SANTOS</p>
            </td>
            <td class="td_cabecalho">
                <p>P/G:</p>
            </td>
            <td class="td_cabecalho">
                <p>{{ dadosApiCompleto.informacoes.pg_real_info.pg_abrev }}</p>
            </td>
        </tr>
        <tr>
            <td class="td_cabecalho">
                <p>IDT:</p>
            </td>
            <td class="td_cabecalho" colspan="2">
                <p>060134543-4</p>
            </td>
            <td class="td_cabecalho">
                <p>CPF:</p>
            </td>
            <td class="td_cabecalho" colspan="9">
                <p>000.000.000-00</p>
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
            <td class="td_calculos" colspan="2">
                <p>VALOR<br />CONTRACHEQUE</p>
            </td>
            <td class="td_calculos" colspan="4" rowspan="19">
                <p>OBSERVA&Ccedil;&Otilde;ES</p>
                <textarea
                    id="observacoes_receitas"
                    name="observacoes_receitas"
                    rows="5"
                    cols="5"
                ></textarea>
            </td>
        </tr>

        <tr v-for="(data, key) in dadosApiReceitas" :key="key">
            <td class="td_calculos" colspan="2">{{ data.rubrica }}</td>
            <td class="td_calculos">{{ data.financeiro.porcentagem }}</td>
            <td class="td_calculos">
                {{ data.financeiro.valor | numeroPreco }}
            </td>
            <td class="td_calculos" colspan="2">
                <span>R$</span>
                <input
                    type="number"
                    :value="data.financeiro.valor"
                    step="0.01"
                />
            </td>
        </tr>

        <tr>
            <td class="td_calculos" colspan="4">
                <p>SOMA</p>
            </td>
            <td class="td_calculos">
                {{
                    dadosApiCompleto.receitas.bruto_total.financeiro.valor
                        | numeroPreco
                }}
            </td>
            <td class="td_calculos" colspan="2">
                <p>
                    {{
                        dadosApiCompleto.receitas.bruto_total.financeiro.valor
                            | numeroPreco
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
            <td class="td_calculos" colspan="2">
                <p>VALOR<br />CONTRACHEQUE</p>
            </td>
            <td class="td_calculos" colspan="4" rowspan="19">
                <p>OBSERVA&Ccedil;&Otilde;ES</p>
                <textarea
                    id="observacoes_descontos"
                    name="observacoes_descontos"
                    rows="5"
                    cols="5"
                ></textarea>
            </td>
        </tr>

        <tr v-for="(data, key) in dadosApiDescontos" :key="key + data.rubrica">
            <td class="td_calculos" colspan="2">{{ data.rubrica }}</td>
            <td class="td_calculos">{{ data.financeiro.porcentagem }}</td>
            <td class="td_calculos">
                {{ data.financeiro.valor | numeroPreco }}
            </td>
            <td class="td_calculos" colspan="2">
                <span>R$</span>
                <input
                    type="number"
                    :value="data.financeiro.valor"
                    step="0.01"
                />
            </td>
        </tr>

        <tr>
            <td class="td_calculos" colspan="4">
                <p>SOMA</p>
            </td>
            <td class="td_calculos">
                {{
                    dadosApiCompleto.descontos.descontos_total.financeiro.valor
                        | numeroPreco
                }}
            </td>
            <td class="td_calculos" colspan="2">
                <p>
                    {{
                        dadosApiCompleto.descontos.descontos_total.financeiro
                            .valor | numeroPreco
                    }}
                </p>
            </td>
        </tr>

        <tr>
            <td class="td_calculos" colspan="4">
                <p>LIQUIDO A RECEBER</p>
            </td>
            <td class="td_calculos">
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
            <td class="td_calculos" colspan="2">
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
                <p>Feira de Santana/BA, 20 de janeiro de 2022.</p>
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
                <p><strong>RAMON OLIVEIRA DOS SANTOS - 3º Sgt</strong></p>
            </td>
        </tr>
        <tr>
            <td class="td_assinatura" colspan="11">
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
                <p><strong>RAMON OLIVEIRA DOS SANTOS - 3º Sgt</strong></p>
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
            <td class="td_assinatura" colspan="11">
                <p>
                    ESTA FICHA DEVER&Aacute; FICAR &Agrave;
                    DISPOSI&Ccedil;&Atilde;O DOS &Oacute;RG&Atilde;OS DE
                    CONTROLE INTERNO E EXTERNO, POR UM PER&Iacute;ODO NUNCA
                    INFERIOR A UM ANO.
                </p>
            </td>
        </tr>
    </table>
</template>

<script>
export default {
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
    },
    beforeEnter: (to, from, next) => {
        alert("ok");
    },
    filters: {
        numeroPreco(value) {
            return value.toLocaleString("pt-BR", {
                style: "currency",
                currency: "BRL",
            });
        },
    },
};
</script>

<style>
table {
    background: #fff;
}
input {
    border: none;
}

@media print {
    table {
        visibility: visible;
        position: absolute;
        top: 0;
        left: 0;
    }
}

td.td_calculos {
    border: 1px solid rgb(54, 54, 54);
    text-align: center;
}

td.td_assinatura {
    border: 1px solid rgb(255, 255, 255);
    text-align: center;
}

td.td_cabecalho {
    padding: 0 0.5em;
    text-align: left;
}
</style>
