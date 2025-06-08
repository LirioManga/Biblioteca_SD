<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Biblioteca - Estudante</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100">
  <!-- Sidebar Toggle Button (Mobile) -->


  <!-- Sidebar -->
  <aside id="sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white border-r sm:translate-x-0">
    <div class="h-full px-3 py-4 overflow-y-auto">
      <div class="flex items-center ps-2.5 mb-5">
        <i class="fas fa-cube text-blue-600 text-xl mr-3"></i>
        <span class="self-center text-xl font-semibold whitespace-nowrap">SigeLib</span>
      </div>
      <ul class="space-y-2">
        <!-- Dashboard -->
        <!-- 
        <li>
          <a href="/student/meus-recursos" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Meus Recursos</span>
          </a>
        </li>

        <li>
          <a href="/student/recursos" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Recursos</span>
          </a>
        </li>
        <li>
          <a href="/student/requisicoes" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Requisições</span>
          </a>
        </li> -->
        <li>
          <a href="/student/inicio" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-tachometer-alt text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="ms-3">Inicio</span>
          </a>
        </li>
        <li>
          <a href="/student/meus-recursos" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Meus Recursos</span>
            <span id="contador-meus-recursos" class="ml-auto text-sm font-semibold text-blue-600"></span>
          </a>
        </li>

        <li>
          <a href="/student/recursos" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Recursos</span>
            <span id="contador-recursos" class="ml-auto text-sm font-semibold text-blue-600"></span>
          </a>
        </li>

        <li>
          <a href="/student/requisicoes" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Requisições</span>
            <span class="ml-auto text-sm font-semibold text-blue-600"></span>
          </a>
        </li>

      </ul>
    </div>
  </aside>

  <!-- Navbar -->
  <!-- Navbar -->
  <nav class="fixed top-0 left-64 right-0 z-40 bg-white border-b">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-end">
        <!-- Notificações -->
        <div class="relative mr-3">
          <button type="button" class="p-2 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-200">
            <span class="sr-only">Notificações</span>
            <i class="fas fa-bell w-6 h-6"></i>
            <span class="absolute top-0 right-0 w-3 h-3 bg-red-500 border-2 border-white rounded-full"></span>
          </button>
        </div>

        <!-- Perfil -->
        <div class="relative">
          <button id="profileDropdownButton" class="flex items-center text-sm rounded-full focus:ring-2 focus:ring-gray-300">
            <span class="sr-only">Abrir menu do usuário</span>
            <!-- <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Foto do usuário"> -->
            <span class="ml-2 text-sm font-medium text-gray-700">
              @auth
              {{ Auth::user()->name }}
              @else
              Utilizador
              @endauth
            </span>
            <i class="fas fa-chevron-down ml-1 text-gray-500 w-3 h-3"></i>
          </button>

          <!-- Dropdown do Perfil -->
          <div id="profileDropdown" class="hidden absolute right-0 z-50 my-4 text-base list-none bg-white rounded-lg shadow-lg w-48 border border-gray-200">
            <div class="px-4 py-3">
              <p class="text-sm text-gray-900">
                @auth
                {{ Auth::user()->name }}
                @endauth
              </p>
              <p class="text-sm font-medium text-gray-900 truncate">
                @auth
                {{ Auth::user()->email }}
                @endauth
              </p>
            </div>
            <ul class="py-1">
              <li>
                <a href="/student/perfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Editar Perfil</a>
              </li>
              <!-- <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Configurações</a>
              </li> -->
              <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="hidden">
                @csrf
              </form>

              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200"
                  onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  Sair
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <main class="p-4 sm:ml-64 mt-14">
    <section id="inicio" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <h1 class="text-3xl font-bold text-gray-800 mb-8">Inicio</h1>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Card 1: Meus Recursos -->
        <div id="card-meus-recursos" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 font-medium">Meus Recursos</p>
              <h2  id="contador-requisicoes" class="text-3xl font-bold text-gray-800 mt-2">5</h2>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
              <i class="fas fa-book text-blue-500 text-xl"></i>
            </div>
          </div>
          <p class="text-sm text-gray-500 mt-4">
            <span class="text-green-500 font-medium"><i class="fas fa-arrow-up"></i> 1</span> novo esta semana
          </p>
        </div>

        <!-- Card 2: Recursos Requisitados -->
        <div id="recursos-requisitados" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 font-medium">Recursos Requisitados</p>
              <h2 class="text-3xl font-bold text-gray-800 mt-2">3</h2>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
              <i class="fas fa-clipboard-list text-green-500 text-xl"></i>
            </div>
          </div>
          <p class="text-sm text-gray-500 mt-4">
            <span class="text-yellow-500 font-medium"><i class="fas fa-clock"></i> 1</span> pendente
          </p>
        </div>

        <!-- Card 3: Empréstimos Ativos -->
        <div id="meus-emprestimos" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
          <div class="flex justify-between items-start">
            <div>
              <p class="text-gray-500 font-medium">Meus Empréstimos</p>
              <h2 class="text-3xl font-bold text-gray-800 mt-2">2</h2>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
              <i class="fas fa-exchange-alt text-purple-500 text-xl"></i>
            </div>
          </div>
          <p class="text-sm text-gray-500 mt-4">
            <span class="text-red-500 font-medium"><i class="fas fa-clock"></i> 1</span> para devolver
          </p>
        </div>

     
        
      </div>
    </section>

    <section id="recursos" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Recursos</h1>

        <!-- Campo de pesquisa alinhado à direita -->
        <div class="flex items-center">
          <div class="relative">
            <input type="text" placeholder="Pesquisar estudantes..."
              class="pl-4 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <div class="border-solid border border-[#ddd] rounded-md p-4 bg-white">
        <div class="overflow-x-auto">
          <table id="tabela-recursos-requisicoes" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titulo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilidade</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Publicado Por</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requisição</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acções</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            </tbody>
          </table>
        </div>
      </div>
    </section>
    <section id="requisicoes" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Requisções</h1>

        <!-- Campo de pesquisa alinhado à direita -->
        <div class="flex items-center">
          <div class="relative">
            <input type="text" placeholder="Pesquisar estudantes..."
              class="pl-4 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700 focus:outline-none">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </button>
          </div>
        </div>
      </div>

      <div class="border-solid border border-[#ddd] rounded-md p-4 bg-white">
        <div class="overflow-x-auto">
          <table id="tabela-requisicoes" class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titulo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>

                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Requisitado Por</th>

                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acções</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">

            </tbody>
          </table>
        </div>
      </div>
    </section>
    <section id="meus-recursos" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <div id="meus-recursos-principal">
        <div class="flex justify-between items-center mb-4">
          <h1 class="text-2xl font-bold text-gray-800">Meus Recursos</h1>

          <!-- Botão Adicionar e Campo de Pesquisa -->
          <div class="flex items-center space-x-4">
            <!-- Botão Adicionar Recurso -->
            <button type="button" onclick="adicionarRecurso();" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
              <i class="fas fa-plus mr-2"></i>
              Adicionar Recurso
            </button>

            <!-- Campo de pesquisa -->
            <div class="relative">
              <input type="text" id="pesquisa-recursos" placeholder="Pesquisar recursos..."
                class="pl-4 pr-10 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
              <button type="button" onclick="pesquisarRecursos();" class="absolute right-0 top-0 h-full px-3 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
              </button>
            </div>
          </div>
        </div>

        <div class="border-solid border border-[#ddd] rounded-md p-4 bg-white">
          <div class="overflow-x-auto">
            <table id="tabela-meus-recursos" class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Título</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilidade</th>
                  <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Data</th>
                  <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
                <!-- Exemplo de linha de recurso -->
                <!-- <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm font-medium text-gray-900">Introdução à Programação</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Livro</td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                      Disponível
                    </span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15/06/2023</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex justify-center">
                    <button onclick="editarRecurso();" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                      Editar
                    </button>
                    <button onclick="excluirRecurso();" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                      Excluir
                    </button>
                  </td>
                </tr> -->
              </tbody>
            </table>
          </div>
        </div>
      </div>


      @include('student.partials.addResource')
      @include('student.partials.openResource')
    </section>
    <section id="perfil" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Perfil</h1>
      </div>
    </section>

  </main>

  <!-- Scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>

  <!-- Worker do PDF.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.worker.min.js"></script>
  <script src="{{ asset('js/student/student.js') }}"></script>
  <script src="{{ asset('js/student/seccao-requisicoes.js') }}"></script>
  <script src="{{ asset('js/student/seccao-recursos.js') }}"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const profileButton = document.getElementById('profileDropdownButton');
      const profileDropdown = document.getElementById('profileDropdown');

      // Alternar visibilidade do dropdown
      profileButton.addEventListener('click', function(e) {
        e.stopPropagation();
        profileDropdown.classList.toggle('hidden');
      });

      // Fechar dropdown quando clicar fora
      document.addEventListener('click', function() {
        profileDropdown.classList.add('hidden');
      });

      // Impedir que o dropdown feche quando clicar nele
      profileDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
      });
    });
  </script>
</body>

</html>