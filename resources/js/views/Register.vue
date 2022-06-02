<template>
    <div class="auth_form-view">
        <transition name="modal-geral">
            <modal-geral :class="modal_classe" v-if="modal_ativo">
                <template v-slot:titulo>
                    <h3>{{ modal_titulo }}</h3>
                </template>

                <template v-slot:texto>
                    <p>
                        {{ modal_texto }}
                    </p>
                </template>
            </modal-geral>
        </transition>
        <div class="logo">
            <a href="/">
                <img
                    src="/image/logo.png"
                    alt="Logo Exame de Pagamento"
                    title="App Exame de Pagamento"
                />
                <span>App | <strong>Exame de Pagamento</strong></span>
            </a>
        </div>
        <div class="auth_form-container">
            <div class="auth_form-header">Realizar cadastro</div>
            <div class="auth_form-body">
                <form method="POST" @submit.prevent="singup()">
                    <input type="hidden" name="_token" />
                    <fieldset>
                        <legend>Dados do Examinador</legend>
                        <div class="auth_form-inputarea">
                            <label
                                for="name"
                                class="col-md-4 col-form-label text-md-end"
                                >Nome completo
                            </label>

                            <input
                                id="name"
                                type="text"
                                class="form-control"
                                name="name"
                                minlength="2"
                                required
                                autofocus
                                autocomplete="name"
                                v-model="name"
                            />
                        </div>

                        <div class="auth_form-inputarea">
                            <label
                                for="email"
                                class="col-md-4 col-form-label text-md-end"
                                >E-mail
                            </label>

                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                name="email"
                                required
                                autocomplete="email"
                                v-model="email"
                            />
                        </div>

                        <div class="auth_form-inputarea">
                            <label
                                for="password"
                                class="col-md-4 col-form-label text-md-end"
                                >Senha</label
                            >

                            <input
                                id="password"
                                type="password"
                                class="form-control"
                                name="password"
                                minlength="8"
                                maxlength="64"
                                required
                                autocomplete="current-password"
                                v-model="password"
                            />
                        </div>

                        <div class="auth_form-inputarea">
                            <label
                                for="passwordcheck"
                                class="col-md-4 col-form-label text-md-end"
                                >Repita a senha</label
                            >

                            <input
                                id="passwordcheck"
                                type="password"
                                minlength="8"
                                maxlength="64"
                                class="form-control"
                                name="passwordcheck"
                                required
                                autocomplete="current-password"
                                v-model="passwordcheck"
                            />
                        </div>

                        <div class="auth_form-inputarea">
                            <label
                                for="passwordcheck"
                                class="col-md-4 col-form-label text-md-end"
                                >P/G</label
                            >
                            <select
                                name="post_grad"
                                id="post_grad"
                                v-model="post_grad"
                            >
                                <option
                                    disabled
                                    value="- Selecione uma opção -"
                                >
                                    - Selecione uma opção -
                                </option>
                                <option value="Gen Ex Inat">Gen Ex Inat</option>
                                <option value="Gen Ex">Gen Ex</option>
                                <option value="Gen Div">Gen Div</option>
                                <option value="Gen Bda">Gen Bda</option>
                                <option value="Cel">Cel</option>
                                <option value="TC">TC</option>
                                <option value="Maj">Maj</option>
                                <option value="Cap">Cap</option>
                                <option value="1º Ten">1º Ten</option>
                                <option value="2º Ten">2º Ten</option>
                                <option value="Asp Of">Asp Of</option>
                                <option value="Cad último ano">
                                    Cad último ano
                                </option>
                                <option value="Cad 1/2/3 ano">
                                    Cad 1/2/3 ano
                                </option>
                                <option value="Al CPOR">Al CPOR</option>
                                <option value="Al ES F S">Al ES F S</option>
                                <option value="Al EPC">Al EPC</option>
                                <option value="Al EPC 1/2/3">
                                    Al EPC 1/2/3
                                </option>
                                <option value="S Ten">S Ten</option>
                                <option value="1º Sgt">1º Sgt</option>
                                <option value="2º Sgt">2º Sgt</option>
                                <option value="3º Sgt">3º Sgt</option>
                                <option value="Cb Eng">Cb Eng</option>
                                <option value="Cb N Eng">Cb N Eng</option>
                                <option value="Sd Esp">Sd Esp</option>
                                <option value="Sd 2A Cl">Sd 2A Cl</option>
                                <option value="Sd 3A Cl">Sd 3A Cl</option>
                                <option value="Sd Eng">Sd Eng</option>
                                <option value="Sd Rcr">Sd Rcr</option>
                                <option value="TF Mor">TF Mor</option>
                                <option value="TF 1Cl">TF 1Cl</option>
                                <option value="TF 2Cl">TF 2Cl</option>
                            </select>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Dados do Chefe da equipe</legend>
                        <div class="auth_form-inputarea">
                            <label
                                for="ch_equipe_name"
                                class="col-md-4 col-form-label text-md-end"
                                >Nome completo
                            </label>

                            <input
                                id="ch_equipe_name"
                                type="text"
                                class="form-control"
                                name="ch_equipe_name"
                                required
                                minlength="2"
                                autocomplete="ch_equipe_name"
                                v-model="ch_equipe_name"
                            />
                        </div>

                        <div class="auth_form-inputarea">
                            <label
                                for="ch_equipe_pg"
                                class="col-md-4 col-form-label text-md-end"
                                >P/G</label
                            >
                            <select
                                name="ch_equipe_pg"
                                id="ch_equipe_pg"
                                v-model="ch_equipe_pg"
                            >
                                <option
                                    disabled
                                    value="- Selecione uma opção -"
                                >
                                    - Selecione uma opção -
                                </option>
                                <option value="Gen Ex Inat">Gen Ex Inat</option>
                                <option value="Gen Ex">Gen Ex</option>
                                <option value="Gen Div">Gen Div</option>
                                <option value="Gen Bda">Gen Bda</option>
                                <option value="Cel">Cel</option>
                                <option value="TC">TC</option>
                                <option value="Maj">Maj</option>
                                <option value="Cap">Cap</option>
                                <option value="1º Ten">1º Ten</option>
                                <option value="2º Ten">2º Ten</option>
                                <option value="Asp Of">Asp Of</option>
                                <option value="Cad último ano">
                                    Cad último ano
                                </option>
                                <option value="Cad 1/2/3 ano">
                                    Cad 1/2/3 ano
                                </option>
                                <option value="Al CPOR">Al CPOR</option>
                                <option value="Al ES F S">Al ES F S</option>
                                <option value="Al EPC">Al EPC</option>
                                <option value="Al EPC 1/2/3">
                                    Al EPC 1/2/3
                                </option>
                                <option value="S Ten">S Ten</option>
                                <option value="1º Sgt">1º Sgt</option>
                                <option value="2º Sgt">2º Sgt</option>
                                <option value="3º Sgt">3º Sgt</option>
                                <option value="Cb Eng">Cb Eng</option>
                                <option value="Cb N Eng">Cb N Eng</option>
                                <option value="Sd Esp">Sd Esp</option>
                                <option value="Sd 2A Cl">Sd 2A Cl</option>
                                <option value="Sd 3A Cl">Sd 3A Cl</option>
                                <option value="Sd Eng">Sd Eng</option>
                                <option value="Sd Rcr">Sd Rcr</option>
                                <option value="TF Mor">TF Mor</option>
                                <option value="TF 1Cl">TF 1Cl</option>
                                <option value="TF 2Cl">TF 2Cl</option>
                            </select>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend>Dados complementares</legend>
                        <div class="auth_form-inputarea">
                            <label
                                for="om"
                                class="col-md-4 col-form-label text-md-end"
                                >Organização Militar
                            </label>

                            <input
                                id="om"
                                type="text"
                                class="form-control"
                                name="om"
                                minlength="2"
                                required
                                autocomplete="om"
                                v-model="om"
                            />
                        </div>
                        <div class="auth_form-inputarea">
                            <label
                                for="local_assinatura"
                                class="col-md-4 col-form-label text-md-end"
                                >Local de Assinatura
                            </label>

                            <input
                                id="local_assinatura"
                                type="text"
                                minlength="2"
                                class="form-control"
                                name="local_assinatura"
                                required
                                autocomplete="local_assinatura"
                                v-model="local_assinatura"
                            />
                        </div>
                    </fieldset>

                    <img
                        v-show="loading"
                        class="icon_loading"
                        src="/svg/loading.svg"
                        alt="Ícone de carregamento"
                    />
                    <button
                        v-show="!loading"
                        type="submit"
                        class="btn btn-primary"
                    >
                        Registrar
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            passwordcheck: "",
            post_grad: "- Selecione uma opção -",
            ch_equipe_name: "",
            ch_equipe_pg: "- Selecione uma opção -",
            om: "",
            local_assinatura: "",
            loading: false,
            erro: false,
            usuarioRegistrado: {},
            modal_classe: "success",
            modal_ativo: false,
            modal_titulo: "título",
            modal_texto: "texto",
        };
    },
    computed: {
        path() {
            let path = window.location.href;
            path = `${path.split("/")[0]}//${path.split("/")[1]}${
                path.split("/")[2]
            }`;
            return path;
        },
    },
    methods: {
        abrirModal(tipo, titulo, texto) {
            if (tipo == 1) {
                this.modal_classe = "success";
                this.modal_titulo = titulo;
                this.modal_texto = texto;
            } else {
                this.modal_classe = "erro";
                this.modal_titulo = titulo;
                this.modal_texto = texto;
            }
            this.modal_ativo = true;
            setTimeout(() => {
                this.modal_ativo = false;
            }, 10000);
        },
        singup() {
            if (this.password !== this.passwordcheck) {
                this.abrirModal(
                    0,
                    "As senhas digitadas não conferem.",
                    `Verifique as senhas digitadas e tente novamente.`
                );
            } else {
                this.loading = true;
                let url = `${this.path}/api/register`;
                axios
                    .post(url, {
                        name: this.name,
                        email: this.email,
                        password: this.password,
                        post_grad: this.post_grad,
                        ch_equipe_name: this.ch_equipe_name,
                        ch_equipe_pg: this.ch_equipe_pg,
                        om: this.om,
                        local_assinatura: this.local_assinatura,
                    })
                    .then((r) => {
                        this.usuarioRegistrado = r.data;
                        this.erro = false;
                        this.abrirModal(
                            1,
                            "Tudo certo por aqui!",
                            `O usuário foi criando com sucesso. Volte à página inicial para realizar o login.`
                        );
                    })
                    .catch(() => {
                        this.erro = true;
                        this.usuarioRegistrado = {};
                        this.abrirModal(
                            0,
                            "Desculpe, algo deu errado...",
                            `Não foi possível cadastrar o usuário, tente novamente em alguns instantes.`
                        );
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        },
    },
};
</script>

<style>
.modal-geral-enter-active,
.modal-geral-leave-active {
    transition: opacity 0.5s, transform 0.5s;
}
.modal-geral-enter, .modal-geral-leave-to /* .fade-leave-active em versões anteriores a 2.1.8 */ {
    opacity: 0;
    transform: translateY(-1em);
}

.timer {
    width: 100%;
    background: red;
}
</style>
