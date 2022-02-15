<template>
    <section id="home">
        <aside id="sidebar">
            <div id="btn_fechar">
                <img src="/svg/arrow.svg" alt="Ícone de seta para esquerda" />
            </div>
            <div id="logo">
                <img
                    src="/image/logo.png"
                    alt="Logo Exame de Pagamento"
                    title="App Exame de Pagamento"
                />
                <span>App | <strong>Exame de Pagamento</strong></span>
            </div>

            <nav>
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
                    <span class="navbutton_title">Gerenciar contracheques</span>
                </router-link>

                <router-link class="navbutton" to="/perfil">
                    <img src="/svg/user.svg" alt="icone usuário" />
                    <span class="navbutton_title">Meu perfil</span>
                </router-link>

                <router-link class="navbutton" to="/legislacao">
                    <img src="/svg/books.svg" alt="icone livro" />
                    <span class="navbutton_title">Legislação</span>
                </router-link>
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
                    <transition>
                        <div v-if="sugestoes_ativa">
                            <p>
                                Encontrou alguma falha ou tem alguma sugestão
                                para melhoria do App? Sinta-se à vontade para
                                nos comunicar:
                                <a href="#">Enviar mensagem</a>
                            </p>
                        </div>
                    </transition>
                </div>
            </div>
        </aside>
        <main>
            <section id="main_header">
                <div id="logout">
                    <div id="btn_logout">
                        <a
                            href="/logout"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        >
                            Fazer logout
                        </a>
                        <img src="/svg/exit.svg" alt="Ícone sair" />
                    </div>
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
            </section>
            <section id="main_body">
                <!-- <formulario-component :form_token="csrf_token">
                </formulario-component> -->
                <router-view></router-view>
            </section>
        </main>
    </section>
</template>

<script>
export default {
    data() {
        return {
            sugestoes_ativa: false,
        };
    },
    props: ["csrf_token", "routeLogout"],
};
</script>

<style>
@keyframes move {
    0% {
        transform: scaleY(0);
    }

    100% {
        transform: scaleY(1);
    }
}
.v-enter-active,
.v-leave-active {
    animation: move 1s;
}
.v-enter-from,
.v-leave-to {
    animation: move 1s reverse;
}
</style>
