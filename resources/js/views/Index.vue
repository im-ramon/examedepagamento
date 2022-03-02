<template>
    <div id="index-container">
        <div id="index-header">
            <h1>👋🏽 Bem vindo ao App Exame de Pagamento.</h1>
            <p>
                Novo por aqui? Dê uma olhada no manual do App no seguinte link:
                <a href="/docs/manual.pdf" target="_BLANK">Manual do App</a>
            </p>
            <p>
                Já conhece o sistema? Então escolha uma das funcionalidades do
                App:
            </p>
        </div>
        <div id="index-main">
            <div class="index-main-item">
                <router-link to="/gerar-contracheque">
                    <img src="/svg/make.svg" alt="icone computador" />
                </router-link>
                <span>Gerar contracheque</span>
            </div>
            <div class="index-main-item">
                <router-link to="/gerenciar-contracheque">
                    <img
                        src="/svg/search_database.svg"
                        alt="icone computador"
                    />
                </router-link>
                <span>Gerenciar contracheques</span>
            </div>
            <div class="index-main-item">
                <router-link to="/perfil">
                    <img src="/svg/user.svg" alt="icone usuário" />
                </router-link>
                <span>Meu perfil</span>
            </div>
            <div class="index-main-item">
                <router-link to="/legislacao">
                    <img src="/svg/books.svg" alt="icone livro" />
                </router-link>
                <span>Legislação</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {};
</script>
