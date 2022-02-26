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
                    P/G Real: {{ c.dados.informacoes.pg_real_info.pg_abrev }}
                </span>
                <div class="gererenciarContracheque-botoes">
                    <img src="/svg/edit.svg" alt="icone editar" />
                    <img src="/svg/delete.svg" alt="icone delete" />
                    <img src="/svg/print.svg" alt="icone print" />
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
};
</script>
