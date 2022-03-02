<template>
    <div id="gererenciarContracheque_container">
        <h2>Contracheques salvos</h2>
        <!-- <pre>
            {{ contrachequeList }}
        </pre> -->

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
                    Universo:
                    <strong>{{ c.dados.universo | formataUniverso }}</strong>
                </span>
                <div class="gererenciarContracheque-botoes">
                    <router-link to="/gerar-contracheque">
                        <img
                            src="/svg/edit.svg"
                            @click="editar_contracheque(c.id, c.dados)"
                            alt="icone editar"
                            id="editar_contracheque"
                        />
                    </router-link>

                    <img
                        src="/svg/delete.svg"
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
</template>

<script>
export default {
    data() {
        return {
            contrachequeList: [],
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

        usuarioAtual() {
            return this.$store.state.activeUser;
        },
    },

    methods: {
        excluir_contracheque(id) {
            if (
                confirm(
                    `Esta operação irá excluir DEFINITIVAMENTE o contracheque de código "${id}" do banco de dados. \n\n Deseja continuar?`
                )
            ) {
                let config = {
                    headers: {
                        Accept: "application/json",
                        Authorization: this.token,
                    },
                };
                axios
                    .delete(`${this.nowPath}/api/ficha-auxiliar/${id}`, config)
                    .then((r) => this.recuperarContracheques())
                    .catch((e) => console.log(e));
            }
        },
        editar_contracheque(id, dados) {
            this.$store.state.backupForm = dados;
            this.$store.state.contrachequeAtivo = id;
        },
        async recuperarContracheques() {
            let config = {
                headers: {
                    Accept: "application/json",
                    Authorization: this.token,
                },
            };

            await axios
                .get(
                    `${this.nowPath}/api/ficha-auxiliar/${this.usuarioAtual.email}`,
                    config
                )
                // .then((r) => (this.contrachequeList = r.data.contracheques))
                .then((r) =>
                    r.data.contracheques.map((item) => {
                        return {
                            id: item.id,
                            dados: JSON.parse(item.ficha_auxiliar_json),
                        };
                    })
                )
                .then((r) => (this.contrachequeList = r))
                .catch((e) => console.log(e));
        },
    },
    beforeMount() {
        this.recuperarContracheques();
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
