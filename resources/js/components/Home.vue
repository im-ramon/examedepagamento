<template>
    <section id="home">
        <transition name="modal_index">
            <div v-if="modal" id="modal_index">
                <div id="modal_container">
                    <img
                        id="x"
                        src="/svg/x.svg"
                        @click="modal = false"
                        title="Fechar modal"
                        alt="Botão fechar"
                    />
                    <div class="modal_item">
                        <h3>Sugestões</h3>
                        <p>
                            Caso queira enviar alguma sugestão para implantação
                            ou correção de alguma funcionalidade, envie sua
                            demanda para o e-mail:
                            <strong>suporte@examedepagamento.com.br</strong>.
                        </p>
                    </div>
                </div>
            </div>
        </transition>
        <transition name="sidebar">
            <aside id="sidebar" v-if="showSidebar">
                <div class="logo">
                    <img
                        src="/image/logo.png"
                        alt="Logo Exame de Pagamento"
                        title="App Exame de Pagamento"
                    />
                    <span>App | <strong>Exame de Pagamento</strong></span>
                </div>

                <nav @click="testingWindowWidth()">
                    <router-link class="navbutton" to="/">
                        <img src="/svg/home.svg" alt="icone casa" />
                        <span class="navbutton_title">Página inicial</span>
                    </router-link>

                    <router-link class="navbutton" to="/gerar-contracheque">
                        <img src="/svg/make.svg" alt="icone computador" />
                        <span class="navbutton_title">Gerar contracheque</span>
                    </router-link>

                    <router-link class="navbutton" to="/gerenciar-contracheque">
                        <img
                            src="/svg/search_database.svg"
                            alt="icone computador"
                        />
                        <span class="navbutton_title"
                            >Gerenciar contracheques</span
                        >
                    </router-link>

                    <router-link class="navbutton" to="/perfil">
                        <img src="/svg/user.svg" alt="icone usuário" />
                        <span class="navbutton_title">Meu perfil</span>
                    </router-link>

                    <router-link class="navbutton" to="/legislacao">
                        <img src="/svg/books.svg" alt="icone livro" />
                        <span class="navbutton_title">Legislação</span>
                    </router-link>

                    <a
                        href="https://apoie.examedepagamento.com.br"
                        class="navbutton apoie"
                        target="_BLANK"
                    >
                        <img src="/svg/handshake.svg" alt="icone livro" />
                        <span class="navbutton_title">Apoie</span>
                    </a>
                </nav>
                <div
                    id="sugestoes_contaneir"
                    @mouseover="sugestoes_ativa = true"
                    @mouseleave="sugestoes_ativa = false"
                >
                    <div id="sugestoes">
                        <div id="lampada">
                            <img src="/svg/lifebouy.svg" alt="Imagem lâmpada" />
                        </div>
                        <h5>Precisando de ajuda?</h5>
                        <transition name="sugestoes">
                            <div v-if="sugestoes_ativa">
                                <p>
                                    Encontrou alguma falha ou tem alguma
                                    sugestão para melhoria do App? Sinta-se à
                                    vontade para nos comunicar:
                                    <a href="#" @click="modal = true"
                                        >Enviar mensagem</a
                                    >
                                </p>
                            </div>
                        </transition>
                    </div>
                </div>
            </aside>
        </transition>

        <main>
            <div
                @click="showSidebar = !showSidebar"
                id="btn_hide_sibdebar"
                :class="showSidebar && 'btn_x'"
            >
                <div class="btn_x-border">
                    <div class="btn_x-border-container">
                        <div class="line"></div>
                        <div class="line"></div>
                        <div class="line"></div>
                    </div>
                </div>
                <!-- <img
                    :class="showSidebar ? '' : 'reverse'"
                    :src="showSidebar ? '/svg/x.svg' : '/svg/hamburger.svg'"
                    alt="Ícone de menu hamburger/ fechar"
                /> -->
            </div>
            <section id="main_header">
                <div id="saudacao">
                    <span>
                        Bem vindo,
                        <span style="text-transform: capitalize">
                            {{ userFirstName }}</span
                        >!
                    </span>
                    <a
                        href="/logout"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        id="btn_sair"
                    >
                        Sair
                        <img src="/svg/exit.svg" alt="Ícone sair" />
                    </a>
                    <form
                        id="logout-form"
                        :action="routeLogout"
                        method="POST"
                        class="d-none"
                    >
                        <input
                            type="hidden"
                            name="_token"
                            :value="csrf_token"
                        />
                    </form>
                </div>
                <div id="logout"></div>
            </section>
            <section id="main_body">
                <transition name="home">
                    <router-view></router-view>
                </transition>
            </section>
        </main>
    </section>
</template>

<script>
export default {
    data() {
        return {
            sugestoes_ativa: false,
            showSidebar: true,
            modal: false,
        };
    },
    props: ["csrf_token", "routeLogout"],
    computed: {
        userFirstName() {
            let name = "";
            if (this.$store.state.activeUser.name) {
                name = this.$store.state.activeUser.name
                    .split(" ")[0]
                    .toLowerCase();
            }
            return name;
        },
    },
    methods: {
        activeUser() {
            let user = document.cookie.split(";").find((indice) => {
                return indice.includes("activeUser=");
                // return indice.startsWith(" activeUser=");
            });

            user = user.split("=")[1];
            user = JSON.parse(user);
            this.$store.state.activeUser = user;
        },
        testingWindowWidth() {
            let width = window.screen.width;
            if (width <= 800) {
                this.showSidebar = false;
            }
        },
    },
    mounted() {
        this.activeUser();
    },
};
</script>

<style>
@keyframes move {
    0% {
        height: 0px;
    }

    100% {
        height: 150px;
    }
}
.sugestoes-enter-active {
    animation: move 1s;
    overflow: hidden;
}
.sugestoes-enter-from,
.sugestoes-leave-to {
    overflow: hidden;
    animation: move 1s reverse;
}

@keyframes moveSidebar {
    0% {
        /* opacity: 1; */
        margin-left: 0;
    }

    100% {
        /* opacity: 0; */
        margin-left: -360px;
    }
}

.sidebar-enter-active {
    animation: moveSidebar 0.7s reverse;
    overflow: hidden;
}
.sidebar-enter-from,
.sidebar-leave-to {
    animation: moveSidebar 0.7s;
    overflow: hidden;
}

@keyframes show {
    0% {
        opacity: 0;
        transform: translateX(-6em);
    }

    100% {
        opacity: 1;
        transform: translateX(0);
    }
}

.home-enter-active {
    animation-name: show;
    animation-duration: 0.6s;
    animation-timing-function: ease-in-out;
    position: absolute;
}
.home-leave-active {
    animation-name: show;
    animation-duration: 0.3s;
    animation-timing-function: ease-in-out;
    animation-direction: reverse;
    position: absolute;
}
</style>
