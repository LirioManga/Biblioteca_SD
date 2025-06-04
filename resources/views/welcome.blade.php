<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Biblioteca Digital</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .book-image-container img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }
            body {
                background-color: #f8f5f0;
            }
            .content-card {
                background-color: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(4px);
                border: 1px solid rgba(0, 0, 0, 0.08);
            }
            .text-primary {
                color: #5a4a3a;
            }
            .text-secondary {
                color: #7a6b5a;
            }
            .btn-light {
                background-color: rgba(255, 255, 255, 0.7);
                border: 1px solid rgba(0, 0, 0, 0.1);
                color: #5a4a3a;
            }
            .btn-light:hover {
                background-color: rgba(255, 255, 255, 0.9);
            }
            .btn-outline {
                border: 1px solid rgba(90, 74, 58, 0.3);
                color: #5a4a3a;
            }
            .btn-outline:hover {
                border-color: rgba(90, 74, 58, 0.5);
                background-color: rgba(90, 74, 58, 0.05);
            }
        </style>
    </head>
    <body class="flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        
        <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 lg:grow starting:opacity-0">
            <main class="flex max-w-[335px] w-full flex-col-reverse lg:max-w-4xl lg:flex-row">
                <div class="content-card text-[13px] leading-[20px] flex-1 p-6 pb-12 lg:p-20 rounded-bl-lg rounded-br-lg lg:rounded-tl-lg lg:rounded-br-none">
                    <h1 class="mb-1 font-medium text-primary text-lg">Bem-vindo à Biblioteca Digital</h1>
                    <p class="mb-4 text-secondary">Explore nosso acervo digital e descubra novos conhecimentos.</p>
                    <ul class="flex flex-col mb-6 lg:mb-8 gap-3">
                        <li class="flex items-center gap-4 py-2">
                            <span class="flex items-center justify-center rounded-full bg-white shadow-sm w-5 h-5 border border-[#e3e3e0]">
                                <span class="rounded-full bg-[#a08c76] w-2.5 h-2.5"></span>
                            </span>
                            <span class="text-primary">
                                Explore nosso
                                <a href="/catalogo" class="inline-flex items-center space-x-1 font-medium text-[#8b6b4d] hover:text-[#6d533b] ml-1">
                                    <span>Catálogo de Livros</span>
                                    <svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5">
                                        <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square"/>
                                    </svg>
                                </a>
                            </span>
                        </li>
                        <li class="flex items-center gap-4 py-2">
                            <span class="flex items-center justify-center rounded-full bg-white shadow-sm w-5 h-5 border border-[#e3e3e0]">
                                <span class="rounded-full bg-[#a08c76] w-2.5 h-2.5"></span>
                            </span>
                            <span class="text-primary">
                                Assista aos nossos
                                <a href="/tutoriais" class="inline-flex items-center space-x-1 font-medium text-[#8b6b4d] hover:text-[#6d533b] ml-1">
                                    <span>Tutoriais de Pesquisa</span>
                                    <svg width="10" height="11" viewBox="0 0 10 11" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-2.5 h-2.5">
                                        <path d="M7.70833 6.95834V2.79167H3.54167M2.5 8L7.5 3.00001" stroke="currentColor" stroke-linecap="square"/>
                                    </svg>
                                </a>
                            </span>
                        </li>
                    </ul>
                    <ul class="flex gap-3 text-sm leading-normal">
                        <li>
                            <a href="{{ route('login') }}" class="btn-light inline-block px-5 py-1.5 rounded-sm">
                                Entrar
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="btn-outline inline-block px-5 py-1.5 rounded-sm">
                                Registar-se
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="bg-white border rouded-r-lg relative lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-lg lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden book-image-container">
                    <div class="absolute inset-0 flex items-center justify-center p-4 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg">
                        <img src="{{ asset('img/ler.jpg') }}" alt="Pessoa lendo um livro na biblioteca" class="max-h-full max-w-full object-scale-down">
                    </div>
                </div>
            </main>
        </div>
    </body>
</html>