<template>
    <div id="master">
        <body style="background-color: #e1e1e1">
            <transition name="modal_index">
                <div v-if="modalAtivo" id="modal_index">
                    <div id="modal_container">
                        <img
                            src="/svg/x.svg"
                            @click="modalAtivo = false"
                            title="Fechar modal"
                            alt="Botão fechar"
                        />
                        <h1>{{ h1 }}</h1>
                        <div id="link1" v-if="paginaAtiva == 'link1'">
                            <ul>
                                <li class="first-li">
                                    <h3>
                                        Versão 1.1
                                        <i>- Disponibilizada em 10/04/2022 -</i>
                                    </h3>
                                    <ul>
                                        <li>Item 1</li>
                                        <li>Item 2</li>
                                        <li>Item 3</li>
                                    </ul>
                                </li>
                                <li>
                                    <h3>
                                        Versão 1.0
                                        <i>- Disponibilizada em 29/03/2022 -</i>
                                    </h3>
                                    <ul>
                                        <li>Item 1</li>
                                        <li>Item 2</li>
                                        <li>Item 3</li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div v-if="paginaAtiva == 'link2'">2</div>
                        <div v-if="paginaAtiva == 'link3'">3</div>
                        <div v-if="paginaAtiva == 'link4'">4</div>
                        <div v-if="paginaAtiva == 'link5'">5</div>
                        <div v-if="paginaAtiva == 'link6'">6</div>
                    </div>
                </div>
            </transition>

            <div id="welcome_container">
                <div id="menu-links">
                    <span>
                        <a @click="ativaModal('link1')" href="#">Novidades</a>
                    </span>
                    <span>
                        <a @click="ativaModal('link2')" href="#">Sugestões</a>
                    </span>
                    <span>
                        <a @click="ativaModal('link3')" href="#"
                            >Como acessar</a
                        >
                    </span>
                    <span>
                        <a @click="ativaModal('link4')" href="#"
                            >Desenvolvedor</a
                        >
                    </span>
                    <span>
                        <a @click="ativaModal('link5')" href="#"
                            >Solicitar acesso</a
                        >
                    </span>
                    <span>
                        <a @click="ativaModal('link6')" href="#">Apoiar</a>
                    </span>
                </div>
                <div id="card">
                    <div id="text_area">
                        <h1>Bem vindo!</h1>
                        <p>
                            Você está no Web
                            <strong>App Exame de Pagamento</strong>.
                        </p>
                        <p>
                            Desenvolvido com a finalidade de auxiliar todos
                            aqueles que desenvolvem a atividade de exame de
                            pagamento de pessoal, no âmbito do exército
                            brasileiro.
                            <span id="br"><b>■</b><b>■</b></span>
                        </p>
                        <a href="/app">Acessar App</a>
                    </div>
                    <div id="laptop">
                        <img
                            id="welcome_laptop"
                            src="image/laptop.png"
                            alt="Laptop"
                        />
                        <img
                            id="welcome_laptop_shadow"
                            src="image/notebook-shadow.png"
                            alt="Laptop"
                        />
                        <img
                            id="welcome_smartphone"
                            src="image/smartphone.png"
                            alt="Smartphone"
                        />
                        <img
                            id="welcome_smartphone_shadow"
                            src="image/smartphone-shadow.png"
                            alt="Smartphone"
                        />
                    </div>
                </div>
            </div>
        </body>
        <footer id="welcome_footer">
            <a href="#">
                <img src="svg/logo-ramon.svg" alt="Logo Ramon Oliveira" />
                <span>Ramon Oliveira | Desenvolvedor</span>
            </a>
            <span id="copyrigth">
                App | Exame de Pagamento © Todos direitos reservados.
            </span>
        </footer>
    </div>
</template>

<style>
@keyframes moveModal {
    0% {
        opacity: 1;
    }

    100% {
        opacity: 0;
    }
}

.modal_index-enter-active {
    animation: moveModal 0.3s reverse;
    overflow: hidden;
}
.modal_index-enter-from,
.modal_index-leave-to {
    animation: moveModal 0.3s;
    overflow: hidden;
}
</style>

<script>
export default {
    data() {
        return {
            h1: "",
            paginaAtiva: "",
            modalAtivo: false,
        };
    },
    methods: {
        ativaModal(param) {
            this.modalAtivo = true;

            if (param == "link1") {
                this.paginaAtiva = param;
                this.h1 = "Novidades";
            } else if (param == "link2") {
                this.paginaAtiva = param;
                this.h1 = "Sugestões";
            } else if (param == "link3") {
                this.paginaAtiva = param;
                this.h1 = "Como acessar";
            } else if (param == "link4") {
                this.paginaAtiva = param;
                this.h1 = "Desenvolvedor";
            } else if (param == "link5") {
                this.paginaAtiva = param;
                this.h1 = "Solicitar acesso";
            } else if (param == "link6") {
                this.paginaAtiva = param;

                this.h1 = "Apoiar";
            }
        },
    },
    mounted() {
        console.log("Component mounted.");
    },
    components: {},
};
</script>
