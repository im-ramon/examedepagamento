<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Exame de Pagamento</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('image/favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="{{ asset('plugin/fontawesome/css/all.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dongle:wght@300;400;700&display=swap" rel="stylesheet">

</head>

<body>
    <div id="root">

        <aside id="sidebar">
            <div id="logo">
                <img src="{{ asset('image/logo.png') }}" alt="Logo Exame de Pagamento" title="App Exame de Pagamento">
                <span>App | <strong>Exame de Pagamento</strong></span>
            </div>

            <nav>
                <a href="#" class="navbutton selected">
                    <img src="{{ asset('svg/home.svg') }}" alt="icone casa">
                    <span class="navbutton_title">Home</span>
                </a>

                <a href="#" class="navbutton">
                    <img src="{{ asset('svg/make.svg') }}" alt="icone computador">
                    <span class="navbutton_title">Gerenciar contracheques</span>
                </a>

                {{-- <a href="#" class="navbutton">
                    <img src="{{ asset('svg/search_database.svg') }}" alt="icone pesquisa">
                    <span class="navbutton_title">Consultar contracheque</span>
                </a> --}}

                <a href="#" class="navbutton">
                    <img src="{{ asset('svg/user.svg') }}" alt="icone usuário">
                    <span class="navbutton_title">Gerenciar conta</span>
                </a>

                <a href="#" class="navbutton">
                    <img src="{{ asset('svg/books.svg') }}" alt="icone livro">
                    <span class="navbutton_title">Legislação</span>
                </a>

            </nav>

            <div id="sugestoes_contaneir">
                <div id="sugestoes">
                    <div id="lampada">
                        <img src="{{ asset('svg/idea.svg') }}" alt="Imagem lâmpada">
                    </div>
                    <h5>Tem alguma sugestão?</h5>
                    <p>
                        Encontrou alguma falha ou tem alguma sugestão para melhoria do App? Sinta-se à vontade
                        para nos comunicar:
                        <a href="#">Enviar mensagem</a>
                    </p>
                </div>
            </div>
        </aside>

        <section id="main">
            <div id="teste">

                <div class="item center">Item 1</div>
                <div class="item flex-end">Item 2</div>
                <div class="item flex-start">Item 3</div>
                <div class="item4">Item 4</div>
            </div>
        </section>
    </div>
</body>

</html>
