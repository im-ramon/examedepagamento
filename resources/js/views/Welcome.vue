<template>
    <div id="master">
        <body style="background-color: #e1e1e1">
            <transition name="modal_index">
                <div v-if="modalAtivo" id="modal_index">
                    <div id="modal_container">
                        <img
                            id="x"
                            src="/svg/x.svg"
                            @click="modalAtivo = false"
                            title="Fechar modal"
                            alt="Botão fechar"
                        />
                        <h1>{{ h1 }}</h1>
                        <div v-if="paginaAtiva == 'link3'">
                            <ul class="modal_item">
                                <li class="first-li">
                                    <h3>
                                        Versão 1.1 <i>(beta)</i>
                                        <i class="data_lancamento"
                                            >- Disponibilizada em 15/04/2022
                                            -</i
                                        >
                                    </h3>
                                    <ul>
                                        <li>
                                            Adicionada a funcionalidade de
                                            adicionar manualmente valores não
                                            disponíveis no App.
                                        </li>
                                        <li>
                                            Todos documentos da página de
                                            <strong>legislação</strong>
                                            foram reformulados.
                                        </li>
                                        <li>
                                            Adicionado um
                                            <u
                                                title="salvamento automático dos dados"
                                                style="
                                                    text-decoration-style: dotted;
                                                    text-decoration-color: #00000050;
                                                    cursor: default;
                                                "
                                                >auto salve</u
                                            >
                                            ao sair do formulário,
                                            possibilitando que e os dados do
                                            formulário continuarem salvos, mesmo
                                            saindo da página.
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <h3>
                                        Versão 1.0 <i>(alpha)</i>
                                        <i class="data_lancamento"
                                            >- Disponibilizada em 29/03/2022
                                            -</i
                                        >
                                    </h3>
                                    <ul>
                                        <li>
                                            Gerar contracheques por meido de
                                            formulário
                                        </li>
                                        <li>
                                            Salvar os contracheques gerados em
                                            banco de dados
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>

                        <div v-if="paginaAtiva == 'link4'">
                            <div class="modal_item">
                                Caso queira enviar alguma sugestão para
                                implantação ou correção de alguma
                                funcionalidade, envie um e-mail para
                                <strong>suporte@examedepagamento.com.br</strong
                                >.
                            </div>
                        </div>

                        <div v-if="paginaAtiva == 'link2'">
                            <!-- <div> -->
                            <p class="modal_item">
                                O App tem como finalidade ajudar todos que
                                realizam a atividade de exame de pagamento de
                                pessoal, no âmbito do Exército Brasileiro. O App
                                realiza todos os cálculos complexos por você,
                                reduzindo a possibilidade de erros por parte do
                                examinador.
                                <br />
                                <br />
                                O funcionamento do App é muito simples!
                                <br />
                                Você só precisa preencher um formulário
                                <a href="/image/screenshots.png" target="_BLANK"
                                    >(ver imagem do formulário)</a
                                >, respondendo algumas perguntadas simples sobre
                                o militar/ pensionista que você deseja montar o
                                contracheque. Depois, basta clicar no botão
                                "gerar contracheque", o App irá fazer os
                                cálculos automaticamente e montará o
                                contracheque para você.
                                <br />
                                <br />
                                Após montado, você pode salvar o contracheque em
                                um banco de dados e voltar quando quiser para o
                                editar.

                                <br />
                                <br />
                                <i style="color: #000"
                                    >** Em razão de algumas restrições impostas
                                    pela Lei nº 13.709, de 14 de agosto de 2018
                                    - Lei Geral de Proteção de Dados Pessoais
                                    (LGPD), quanto ao tratamento de dados
                                    pessoais de terceiros, esta aplicação não
                                    armazena ou trata nenhum dado pessoal (nome,
                                    identidade, cpf, entre outros). Os dados
                                    pessoais do examinado poderão ser inseridos
                                    <strong>apenas</strong> no momento da
                                    impressão do contracheque, porém não ficarão
                                    armazenados.</i
                                >
                            </p>
                            <!-- </div> -->
                        </div>

                        <div v-if="paginaAtiva == 'link5'">
                            <div class="modal_item">
                                <span>Ramon Olivera - Desenvolvedor Web</span>
                                <br /><br />
                                <span>
                                    Idealizador do projeto e desenvolvedor da
                                    aplicação .</span
                                >
                                <div id="contatos_sociais">
                                    <a
                                        href="https://github.com/im-ramon"
                                        target="_BLANK"
                                        title="Github"
                                    >
                                        <img
                                            class="github"
                                            src="/svg/github.svg"
                                            alt="Ícone Github"
                                        />
                                    </a>
                                    <a
                                        href="https://www.linkedin.com/in/ramon-oliveira-21b8571a2/"
                                        target="_BLANK"
                                        title="Linkedin"
                                    >
                                        <img
                                            class="linkedin"
                                            src="/svg/linkedin.svg"
                                            alt="Ícone Linkedin"
                                        />
                                    </a>
                                    <!-- <img
                                        src="/svg/whatsapp.svg"
                                        alt="Ícone whatsapp"
                                    /> -->
                                </div>
                            </div>
                        </div>

                        <div v-if="paginaAtiva == 'link1'">
                            <div class="modal_item">
                                Para utilizar o App Exame de Pagamento, basta
                                acessar o link:
                                <a href="/singup"
                                    >www.examedepagamento.com.br/singup</a
                                >
                                e realizar o seu cadastro!
                            </div>
                        </div>

                        <div v-if="paginaAtiva == 'link6'">
                            <div class="modal_item">
                                A iniciativa do
                                <strong>App Exame de Pagamento</strong> não tem
                                fins lucrativos, entretanto, existem custos para
                                manter o App on-line, custos esses que o
                                desenvolvedor está arcando, até o momento. Caso
                                queira contribuir com a manutenção do projeto,
                                acesse o link abaixo e tenha acesso às
                                informações para contribuição:
                                <a
                                    href="https://apoie.examedepagamento.com.br"
                                    target="_BLANK"
                                    title="Apoie o projeto"
                                >
                                    www.apoie.examedepagamento.com.br.</a
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </transition>

            <div id="welcome_container">
                <div id="menu-links">
                    <span>
                        <a @click="ativaModal('link1', 'Como acessar')" href="#"
                            >Como acessar</a
                        >
                    </span>
                    <span>
                        <a
                            @click="ativaModal('link2', 'Como funciona')"
                            href="#"
                            >Como funciona</a
                        >
                    </span>
                    <span>
                        <a @click="ativaModal('link3', 'Novidades')" href="#"
                            >Novidades</a
                        >
                    </span>
                    <span>
                        <a @click="ativaModal('link4', 'Sugestões')" href="#"
                            >Sugestões</a
                        >
                    </span>
                    <span>
                        <a
                            @click="ativaModal('link5', 'Desenvolvedor')"
                            href="#"
                            >Desenvolvedor</a
                        >
                    </span>
                    <span>
                        <a @click="ativaModal('link6', 'Apoiar')" href="#"
                            >Apoiar</a
                        >
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
                            O App foi desenvolvido com a finalidade de auxiliar
                            todos aqueles que desenvolvem a atividade de exame
                            de pagamento de pessoal, no âmbito do exército
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
        ativaModal(param, h1) {
            this.modalAtivo = true;

            if (param == "link1") {
                this.paginaAtiva = param;
                this.h1 = h1;
            } else if (param == "link2") {
                this.paginaAtiva = param;
                this.h1 = h1;
            } else if (param == "link3") {
                this.paginaAtiva = param;
                this.h1 = h1;
            } else if (param == "link4") {
                this.paginaAtiva = param;
                this.h1 = h1;
            } else if (param == "link5") {
                this.paginaAtiva = param;
                this.h1 = h1;
            } else if (param == "link6") {
                this.paginaAtiva = param;
                this.h1 = h1;
            }
        },
    },
    mounted() {
        console.log("Component mounted.");
    },
    components: {},
};
</script>
