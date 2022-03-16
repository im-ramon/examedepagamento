<template>
    <body style="background-color: #e1e1e1">
        <div id="sidebar">
            <div id="dev">
                <div class="sidebar-footer">
                    <img src="svg/logo-ramon.svg" alt="Logo Ramon Oliveira" />
                    <a href="#">Ramon Oliveira</a><span>| Desenvolvedor</span>
                </div>
            </div>
        </div>
        <div id="welcome_container">
            <div id="menu-links">
                <ul>
                    <li><a href="#">Novidades</a></li>
                    <li><a href="#">Sugestões</a></li>
                    <li><a href="#">Como acessar</a></li>
                    <li><a href="#">Desenvolvedor</a></li>
                    <li><a href="#">Solicitar acesso</a></li>
                    <li><a href="#">Apoiar</a></li>
                </ul>
            </div>
            <div id="card">
                <div id="text_area">
                    <h1>Bem vindo!</h1>
                    <p>
                        Você está no Web
                        <strong>App Exame de Pagamento</strong>.
                    </p>
                    <p>
                        Desenvolvido com a finalidade de auxiliar todos aqueles
                        que desenvolvem a atividade de exame de pagamento de
                        pessoal, no âmbito do exército brasileiro.
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
                </div>
            </div>
        </div>
        <span id="copyrigth"
            >App | Exame de Pagamento © Todos direitos reservados.</span
        >
    </body>
</template>

<script>
export default {
    mounted() {
        console.log("Component mounted.");
    },
};
</script>
