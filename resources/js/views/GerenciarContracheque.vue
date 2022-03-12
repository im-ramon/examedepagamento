<template>
    <div id="gererenciarContracheque_body">
        <div id="gererenciarContracheque_container2">
            <h2>Dados para impressão</h2>
            <div id="input_area-data_assinatura_cc">
                <label for="data_assinatura_cc"
                    >Data da assinatura do contracheque:
                </label>

                <input
                    type="date"
                    name="data_assinatura"
                    v-model="dataAssinatura"
                    id="data_assinatura_cc"
                />
                <button @click="salvarDataAssinatura">
                    <img
                        v-if="loadingSalvarData"
                        src="/svg/loading.svg"
                        style="width: 18px"
                        alt="Ícone de carregamento"
                    />
                    <span v-else>Salvar</span>
                </button>
            </div>
        </div>
        <div id="gererenciarContracheque_container">
            <h2>Contracheques salvos</h2>
            <div class="buscando_registros" v-show="buscandoRegistros">
                <span>Buscando registros. Aguarde</span>
                <img
                    src="/svg/loading.svg"
                    style="width: 25px"
                    alt="Ícone de carregamento"
                />
            </div>

            <div
                class="btn_refresh"
                v-if="contrachequeList.length == 0"
                @click="recuperarContracheques"
            >
                <span
                    >Você não possui contracheques salvos no banco de
                    dados.</span
                >
                <img
                    src="/svg/refresh.svg"
                    style="width: 25px"
                    alt="Ícone de refresh"
                />
            </div>

            <div id="gererenciarContracheque_section">
                <div
                    class="gererenciarContracheque-item"
                    v-for="c in contrachequeList"
                    :key="c.id"
                >
                    <span>
                        Código do contracheque: <strong>{{ c.id }}</strong>
                    </span>
                    <span>
                        P/G:
                        <strong>{{
                            pgFiltrados[c.dados.pg_real - 1] || "buscando..."
                        }}</strong>
                    </span>

                    <span>
                        Universo:
                        <strong>{{
                            c.dados.universo | formataUniverso
                        }}</strong>
                    </span>
                    <div class="gererenciarContracheque-botoes">
                        <router-link to="/gerar-contracheque">
                            <img
                                src="/svg/edit.svg"
                                title="Editar contracheque"
                                @click="
                                    editar_contracheque(
                                        c.id,
                                        c.dados,
                                        c.valorReceitasCC_array,
                                        c.valorDescontosCC_array,
                                        c.observacoes
                                    )
                                "
                                alt="icone editar"
                                id="editar_contracheque"
                            />
                        </router-link>

                        <img
                            src="/svg/delete.svg"
                            title="Excluir contracheque"
                            @click="excluir_contracheque(c.id)"
                            alt="icone delete"
                            id="excluir_contracheque"
                        />

                        <!-- <router-link to="/ficha-auxiliar">
                        <img
                            src="/svg/print.svg"
                            @click="imprimir_contracheque(c.dados)"
                            alt="icone print"
                        />
                    </router-link> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            contrachequeList: false,
            loadingSalvarData: false,
            buscandoRegistros: false,
            dataAssinatura: "2021-01-01",
            listaPg: [],
        };
    },
    computed: {
        pgFiltrados() {
            let objPg = this.listaPg;
            return objPg.map((valorAtual) => {
                return (valorAtual = valorAtual.pg_abrev);
            });
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

        usuarioAtual() {
            return this.$store.state.activeUser;
        },
    },

    methods: {
        carregaPg() {
            axios
                .get(`${this.nowPath}/api/pg-constantes`)
                .then((r) => {
                    this.listaPg = r.data;
                })
                .catch((e) => console.log(e));
        },
        salvarDataAssinatura() {
            this.loadingSalvarData = true;

            localStorage.setItem("data_assinatura_cc", this.dataAssinatura);

            setTimeout(() => {
                this.loadingSalvarData = false;
            }, 1000);
        },
        recuperarDataAssinatura() {
            this.dataAssinatura = localStorage.getItem("data_assinatura_cc");
        },
        excluir_contracheque(id) {
            if (
                confirm(
                    `Esta operação irá excluir DEFINITIVAMENTE o contracheque de código "${id}" do banco de dados. \n\n Deseja continuar?`
                )
            ) {
                axios
                    .delete(`${this.nowPath}/api/ficha-auxiliar/${id}`)
                    .then((r) => this.recuperarContracheques())
                    .catch((e) => console.log(e));
            }
        },
        editar_contracheque(
            id,
            dados,
            valorReceitasCC_array,
            valorDescontosCC_array,
            observacoes
        ) {
            this.$store.state.backupForm = dados;
            this.$store.state.contrachequeAtivo = id;
            this.$store.state.valorReceitasCC_array_atual =
                valorReceitasCC_array;
            this.$store.state.valorDescontosCC_array_atual =
                valorDescontosCC_array;
            this.$store.state.observacoes = observacoes;
        },
        async recuperarContracheques() {
            this.buscandoRegistros = true;

            await axios
                .get(
                    `${this.nowPath}/api/ficha-auxiliar/${this.usuarioAtual.email}`
                )
                .then((r) => {
                    return r.data.contracheques.map((item) => {
                        return {
                            id: item.id,
                            dados: JSON.parse(item.ficha_auxiliar_json),
                            valorDescontosCC_array:
                                item.valorDescontosCC_array.split("#"),
                            valorReceitasCC_array:
                                item.valorReceitasCC_array.split("#"),
                            observacoes: JSON.parse(item.observacoes),
                        };
                    });
                })
                .then((r) => {
                    this.contrachequeList = r;
                })
                .catch((e) => {
                    console.log(e);
                })
                .finally(() => (this.buscandoRegistros = false));
        },
    },
    mounted() {
        setTimeout(() => {
            this.recuperarContracheques();
            this.recuperarDataAssinatura();
            this.carregaPg();
        }, 1);
    },

    filters: {
        formataUniverso(v) {
            if (v == "ativa") {
                return "Ativa";
            } else if (v == "inativo") {
                return "Inativo";
            } else if (v == "pens_mil") {
                return "Pensionista Militar";
            } else if (v == "pens_excmbt_2ten") {
                return "Pensionista Ex-Cmbt - 2º Ten";
            } else if (v == "pens_excmbt_2sgt") {
                return "Pensionista Ex-Cmbt - 2º Sgt";
            } else {
                return v;
            }
        },
    },
};
</script>
