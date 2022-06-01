<template>
    <div class="auth_form-view">
        <!-- <img class="auth_form-logo" src="/image/logo.png" alt="Logo App" /> -->
        <div class="logo">
            <img
                src="/image/logo.png"
                alt="Logo Exame de Pagamento"
                title="App Exame de Pagamento"
            />
            <span>App | <strong>Exame de Pagamento</strong></span>
        </div>
        <div class="auth_form-container">
            <div class="auth_form-header">Login</div>
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
                                required
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
                                autofocus
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
                                :type="!seepassword ? 'password' : 'text'"
                                class="form-control"
                                name="password"
                                required
                                autocomplete="current-password"
                                v-model="password"
                            />

                            <img
                                @click="seepassword = !seepassword"
                                :src="
                                    seepassword
                                        ? '/svg/eye-open.svg'
                                        : '/svg/eye-slashed.svg'
                                "
                                alt="ver senha"
                                id="iconeeye"
                                title="Visualizar senha"
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
                                :type="!seepassword ? 'password' : 'text'"
                                class="form-control"
                                name="passwordcheck"
                                required
                                autocomplete="current-password"
                                v-model="passwordcheck"
                            />

                            <img
                                @click="seepassword = !seepassword"
                                :src="
                                    seepassword
                                        ? '/svg/eye-open.svg'
                                        : '/svg/eye-slashed.svg'
                                "
                                alt="ver senha"
                                id="iconeeye"
                                title="Visualizar senha"
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
                                <option value="">x</option>
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
                                <option value="">x</option>
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
                                class="form-control"
                                name="local_assinatura"
                                required
                                autocomplete="local_assinatura"
                                v-model="local_assinatura"
                            />
                        </div>
                    </fieldset>

                    <img
                        v-if="loading"
                        class="icon_loading"
                        src="/svg/loading.svg"
                        alt="Ícone de carregamento"
                    />
                    <button v-else type="submit" class="btn btn-primary">
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
            name: "x",
            email: "x@x.com",
            password: "x",
            passwordcheck: "x",
            post_grad: "x",
            ch_equipe_name: "x",
            ch_equipe_pg: "x",
            om: "x",
            local_assinatura: "x",
            seepassword: false,
            loading: false,
            erro: false,
            usuarioRegistrado: {},
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
        singup() {
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
                    this.loading = false;
                    this.usuarioRegistrado = r.data;
                    this.erro = false;
                })
                .catch(() => {
                    this.loading = false;
                    this.erro = true;
                    this.usuarioRegistrado = {};
                });
        },
    },
};
</script>
