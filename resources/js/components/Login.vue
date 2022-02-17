<template>
    <div class="login_view">
        <!-- <img class="login_logo" src="/image/logo.png" alt="Logo App" /> -->
        <div id="logo">
            <img
                src="/image/logo.png"
                alt="Logo Exame de Pagamento"
                title="App Exame de Pagamento"
            />
            <span>App | <strong>Exame de Pagamento</strong></span>
        </div>
        <div class="login_container">
            <div class="login_header">Login</div>
            <div class="login_body">
                <form method="POST" action="" @submit.prevent="login($event)">
                    <input type="hidden" name="_token" :value="token_csrf" />
                    <div class="login_inputarea">
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

                    <div class="login_inputarea">
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

                    <!-- <div class="row mb-3">
                        <div class="col-md-6 offset-md-4">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="remember"
                                    id="remember"
                                />

                                <label class="form-check-label" for="remember">
                                    Mantenha-me conectado
                                </label>
                            </div>
                        </div>
                    </div> -->

                    <button type="submit" class="btn btn-primary">Login</button>

                    <!-- <a class="btn btn-link" href="">
                                Esqueci a senha
                            </a> -->
                </form>
            </div>
        </div>
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
        };
    },
    methods: {
        login(event) {
            let path = window.location.href;
            path = `${path.split("/")[0]}//${path.split("/")[1]}${
                path.split("/")[2]
            }`;

            // let url = `${path}/api/login`;
            let url = "http://localhost:8000/api/login";
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
                .then((r) => r.json())
                .then((data) => {
                    if (data.token) {
                        document.cookie =
                            "token=" + data.token + ";SameSite=Lax";
                    }
                    event.target.submit();
                });
        },
    },
};
</script>
