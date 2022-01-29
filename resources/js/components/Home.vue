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
                <a href="#" class="navbutton selected">
                    <img src="/svg/home.svg" alt="icone casa" />
                    <span class="navbutton_title">Home</span>
                </a>

                <a href="#" class="navbutton">
                    <img src="/svg/make.svg" alt="icone computador" />
                    <span class="navbutton_title">Contracheques</span>
                </a>

                <a href="#" class="navbutton">
                    <img src="/svg/user.svg" alt="icone usuário" />
                    <span class="navbutton_title">Meu perfil</span>
                </a>

                <a href="#" class="navbutton">
                    <img src="/svg/books.svg" alt="icone livro" />
                    <span class="navbutton_title">Legislação</span>
                </a>
            </nav>

            <div id="sugestoes_contaneir">
                <div id="sugestoes">
                    <div id="lampada">
                        <img src="/svg/idea.svg" alt="Imagem lâmpada" />
                    </div>
                    <h5>Tem alguma sugestão?</h5>
                    <p>
                        Encontrou alguma falha ou tem alguma sugestão para
                        melhoria do App? Sinta-se à vontade para nos comunicar:
                        <a href="#">Enviar mensagem</a>
                    </p>
                </div>
            </div>
        </aside>
        <main>
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
                    <input type="hidden" name="_token" :value="token_csrf" />
                </form>
            </div>
        </main>
    </section>
</template>

<script>
export default {
    props: ["token_csrf", "routeLogout"],
};
</script>
