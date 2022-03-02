<template>
    <div id="legislacao_container">
        <h2 id="legislacao_header">Legislação</h2>
        <div id="legenda">
            <section>
                Legenda:
                <div>
                    <div id="item1">Receitas</div>
                    <div id="item2">Descontos</div>
                    <div id="item3">Leis</div>
                </div>
            </section>
        </div>
        <div id="legislacao_body">
            <template v-if="legislacao">
                <a
                    :class="'legislacao_item ' + 'legislacao_item-' + l.type"
                    v-for="l in legislacao"
                    :key="l.title"
                    :href="l.path"
                    target="_BLANK"
                >
                    {{ l.title }}
                </a>
            </template>
            <img
                v-else
                src="/svg/loading.svg"
                style="width: 25px"
                alt="Ícone de carregamento"
            />
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            legislacao: false,
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
    methods: {
        listarLegislacao() {
            let listaDeArquivos = [];

            let config = {
                headers: {
                    Accept: "application/json",
                    Authorization: this.token,
                },
            };

            axios
                .get(`${this.nowPath}/api/legislacao`, config)
                .then((r) => {
                    let retorno = [];
                    retorno = r.data.arquivos.filter(
                        (item) => item.length >= 3
                    );

                    return retorno;
                })
                .then((r) => {
                    listaDeArquivos = r.map((item) => {
                        let path = `${this.nowPath}/legislacao/${item}`;
                        let title = item
                            .split("@")[1]
                            .replace(".pdf", "")
                            .replace(/_/g, " ");
                        let type = item.split("@")[0].toLowerCase();

                        return { title, path, type };
                    });
                    this.legislacao = listaDeArquivos.sort(function (a, b) {
                        return a.title.localeCompare(b.title);
                    });
                })
                .catch((e) => console.log(e));
        },
    },
    beforeMount() {
        this.listarLegislacao();
    },
};
</script>
