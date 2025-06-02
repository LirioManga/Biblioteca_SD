<!DOCTYPE html>
<html lang="pt">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel</title>
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
        <span class="self-center text-xl font-semibold whitespace-nowrap">Admin Panel</span>
      </div>
      <ul class="space-y-2">
        <!-- Dashboard -->
        <li>
          <a href="/admin/inicio" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-tachometer-alt text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="ms-3">Inicio</span>
          </a>
        </li>

        <!-- E-commerce Dropdown -->
        <!-- <li>
          <button type="button" class="flex items-center w-full p-2 text-base text-gray-900 rounded-lg hover:bg-gray-200 group" aria-controls="ecommerce-dropdown">
            <i class="fas fa-shopping-cart text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 text-left whitespace-nowrap">E-commerce</span>
            <i class="fas fa-chevron-down w-3 h-3"></i>
          </button>
          <ul id="ecommerce-dropdown" class="hidden py-2 space-y-2">
            <li>
              <a href="#" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 hover:bg-gray-200">Produtos</a>
            </li>
            <li>
              <a href="#" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 hover:bg-gray-200">Vendas</a>
            </li>
            <li>
              <a href="#" class="flex items-center w-full p-2 text-gray-900 rounded-lg pl-11 hover:bg-gray-200">Faturas</a>
            </li>
          </ul>
        </li> -->

        <!-- Kanban -->


        <!-- Mensagens -->
        <!-- <li>
          <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-envelope text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Mensagens</span>
            <span class="w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
          </a>
        </li> -->

        <!-- Usuários -->
        <li>
          <a href="/admin/estudantes" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-users text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Estudantes</span>
          </a>
        </li>

        <li>
          <a href="/admin/recursos" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Recursos</span>
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
            <img class="w-8 h-8 rounded-full" src="https://randomuser.me/api/portraits/men/32.jpg" alt="Foto do usuário">
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
                <a href="/admin/perfil" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Editar Perfil</a>
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

      <!-- <h1 class="text-2xl font-bold text-gray-800 mb-4">Bem-vindo </h1> -->

      <h1 class="text-3xl font-bold text-gray-800 mb-8">Inicio</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Card 1: Total de Usuários -->
            <div id="total-usuarios" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Total de Usuários</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">1,248</h2>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <i class="fas fa-users text-blue-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-up"></i> 12%</span> desde o último mês
                </p>
            </div>

            <!-- Card 2: Total de Recursos -->
            <div id="total-recursos" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Recursos Disponíveis</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">5,673</h2>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <i class="fas fa-book text-green-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-up"></i> 8%</span> novos recursos
                </p>
            </div>

            <!-- Card 3: Requisições Não Aceitas -->
            <div id="requisicoes-pendentes" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-red-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Requisições Pendentes</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">42</h2>
                    </div>
                    <div class="bg-red-100 p-3 rounded-full">
                        <i class="fas fa-exclamation-circle text-red-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">
                    <span class="text-red-500 font-medium"><i class="fas fa-arrow-up"></i> 3</span> novas hoje
                </p>
            </div>

            <!-- Card 4: Sugestão - Empréstimos Ativos -->
            <div id="emprestimos-ativos" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-purple-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Empréstimos Ativos</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">287</h2>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <i class="fas fa-exchange-alt text-purple-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-down"></i> 5%</span> em relação à semana passada
                </p>
            </div>

            <!-- Card 5: Sugestão - Atrasos -->
            <div id="atrasos" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Devoluções Atrasadas</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">15</h2>
                    </div>
                    <div class="bg-yellow-100 p-3 rounded-full">
                        <i class="fas fa-clock text-yellow-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">
                    <span class="text-red-500 font-medium"><i class="fas fa-arrow-up"></i> 2</span> novos atrasos
                </p>
            </div>

            <!-- Card 6: Sugestão - Novos Cadastros -->
            <div id="novos-usuarios" class="bg-white rounded-lg shadow-md p-6 border-l-4 border-indigo-500 hover:shadow-lg transition-shadow">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-gray-500 font-medium">Novos Usuários (7d)</p>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">24</h2>
                    </div>
                    <div class="bg-indigo-100 p-3 rounded-full">
                        <i class="fas fa-user-plus text-indigo-500 text-xl"></i>
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-4">
                    <span class="text-green-500 font-medium"><i class="fas fa-arrow-up"></i> 18%</span> crescimento
                </p>
            </div>
        </div>
    </section>
    <section id="estudantes" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Estudantes</h1>

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
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estudante</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Telefone</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acções</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center overflow-hidden">
                      <span class="text-blue-600 font-medium">LM</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Lirio Manga</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">liriomanga@gmail.com</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">847777777</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Bloqueado
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2  flex justify-center">
                  <button onclick="aprovarNovoEstudante();" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    Aprovar
                  </button>
                  <button onclick="bloquearEstudante();" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    Bloquear
                  </button>
                  <button onclick="editarDadosEstudante();" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    Editar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
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
          <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
              <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Titulo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Descricao</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Disponibilidade</th>
                <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Acções</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="flex-shrink-0 h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center overflow-hidden">
                      <span class="text-blue-600 font-medium">LM</span>
                    </div>
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">Lirio Manga</div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">liriomanga@gmail.com</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">847777777</td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                    Bloqueado
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2  flex justify-center">
                  <!-- <button onclick="aprovarNovoEstudante();" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                                  Aprovar
                              </button> -->
                  <button class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    eliminar
                  </button>
                  <button onclick="visualizarRecurso();" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    visualizar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </section>
    <section id="perfil" class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold text-gray-800">Perfil</h1>
      </div>
    </section>

  </main>

  <!-- Scripts -->
  <script src="{{ asset('js/admin/admin.js') }}"></script>
  <script src="{{ asset('js/admin/seccao-estudantes.js') }}"></script>
  <script src="{{ asset('js/admin/seccao-recursos.js') }}"></script>
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