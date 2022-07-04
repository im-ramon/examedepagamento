<template>
    <div class="auth_form-view">
        <div class="logo">
            <a href="/" title="Voltar à página inicial">
                <img
                    src="/image/logo.png"
                    alt="Logo Exame de Pagamento"
                    title="App Exame de Pagamento"
                />
                <span>App | <strong>Exame de Pagamento</strong></span></a
            >
        </div>
        <div class="auth_form-container">
            <div class="auth_form-header">Login</div>
            <div class="auth_form-body login">
                <form method="POST" action="" @submit.prevent="login($event)">
                    <input type="hidden" name="_token" :value="token_csrf" />
                    <div class="auth_form-inputarea">
                        <label
                            for="email"
                            class="col-md-4 col-form-label text-md-end"
                            >E-mail
                        </label>

                        <input
                            id="email"
                            type="email"
                            placeholder="Digite seu e-mail"
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
                            placeholder="Digite sua senha"
                            required
                            autocomplete="current-password"
                            v-model="password"
                        />

                        <a class="link-reset_password" href="/password/reset/"
                            >Esqueci minha senha</a
                        >

                        <!-- <img
                            @click="seepassword = !seepassword"
                            :src="
                                seepassword
                                    ? '/svg/eye-open.svg'
                                    : '/svg/eye-slashed.svg'
                            "
                            alt="ver senha"
                            id="iconeeye"
                            title="Visualizar senha"
                        /> -->
                    </div>

                    <img
                        v-show="loading"
                        class="icon_loading"
                        src="/svg/loading.svg"
                        alt="Ícone de carregamento"
                    />

                    <div class="button_container">
                        <button
                            v-show="!loading"
                            type="submit"
                            class="btn btn-primary"
                        >
                            Entrar
                        </button>
                    </div>
                    <p class="senha_errada" v-if="isWrongPassWord">
                        Senha e/ou login incorreto(s). Tente novamente.
                    </p>
                </form>
            </div>
        </div>
        <span class="footer_auth">
            Não tem uma conta?
            <a href="/singup">Cadastre-se</a>
        </span>
    </div>
</template>

<script>
export default {
    props: ["token_csrf"],
    data() {
        return {
            email: "",
            password: "",
            seepassword: false,
            loading: false,
            isWrongPassWord: false,
        };
    },
    methods: {
        login(event) {
            this.loading = true;
            this.isWrongPassWord = false;
            let path = window.location.href;
            path = `${path.split("/")[0]}//${path.split("/")[1]}${
                path.split("/")[2]
            }`;

            let url = `${path}/api/login`;
            let config = {
                method: "post",
                body: new URLSearchParams({
                    email: this.email,
                    password: this.password,
                }),
                // headers: {
                //     "Content-Type": "application/json",
                //     Accept: "application/json",
                // },
            };
            fetch(url, config)
                .then((response) => response.json())
                .then((data) => {
                    if (data.token) {
                        document.cookie = `token=${data.token};SameSite=Lax`;
                    }
                    if (data.user[0]) {
                        document.cookie = `activeUser=${JSON.stringify(
                            data.user[0]
                        )}`;
                    }
                    // console.log(data.user);
                    event.target.submit();
                })
                .catch((e) => {
                    this.isWrongPassWord = true;
                    this.loading = false;
                });
        },
    },
};
</script>
