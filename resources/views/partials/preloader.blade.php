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
  <button id="sidebarToggle" class="fixed z-50 p-2 mt-2 ml-3 text-gray-500 rounded-lg sm:hidden hover:bg-gray-200 focus:outline-none">
    <span class="sr-only">Abrir menu</span>
    <i class="fas fa-bars w-6 h-6"></i>
  </button>

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
          <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-tachometer-alt text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="ms-3">Dashboard</span>
          </a>
        </li>
        
        <!-- E-commerce Dropdown -->
        <li>
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
        </li>
        
        <!-- Kanban -->
        <li>
          <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-columns text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Kanban</span>
            <span class="px-2 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">Pro</span>
          </a>
        </li>
        
        <!-- Mensagens -->
        <li>
          <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-envelope text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Mensagens</span>
            <span class="w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full">3</span>
          </a>
        </li>
        
        <!-- Usuários -->
        <li>
          <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-200 group">
            <i class="fas fa-users text-gray-500 group-hover:text-gray-900 w-5 h-5"></i>
            <span class="flex-1 ms-3 whitespace-nowrap">Usuários</span>
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
            <span class="ml-2 text-sm font-medium text-gray-700">João Silva</span>
            <i class="fas fa-chevron-down ml-1 text-gray-500 w-3 h-3"></i>
          </button>
          
          <!-- Dropdown do Perfil -->
          <div id="profileDropdown" class="hidden absolute right-0 z-50 my-4 text-base list-none bg-white rounded shadow">
            <div class="px-4 py-3">
              <p class="text-sm text-gray-900">João Silva</p>
              <p class="text-sm font-medium text-gray-900 truncate">joao@exemplo.com</p>
            </div>
            <ul class="py-1">
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Perfil</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Configurações</a>
              </li>
              <li>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">Sair</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- Conteúdo Principal -->
  <main class="">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg">
      <h1 class="text-2xl font-bold text-gray-800 mb-4">Bem-vindo ao Painel</h1>
      
      <!-- Cards -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div class="flex items-center justify-center h-24 rounded bg-gray-50">
          <div class="text-center">
            <p class="text-gray-500">Total de Visitas</p>
            <p class="text-2xl font-bold text-gray-800">1,234</p>
          </div>
        </div>
        <div class="flex items-center justify-center h-24 rounded bg-gray-50">
          <div class="text-center">
            <p class="text-gray-500">Novos Usuários</p>
            <p class="text-2xl font-bold text-gray-800">56</p>
          </div>
        </div>
        <div class="flex items-center justify-center h-24 rounded bg-gray-50">
          <div class="text-center">
            <p class="text-gray-500">Vendas</p>
            <p class="text-2xl font-bold text-gray-800">R$ 12,345</p>
          </div>
        </div>
      </div>
      
      <!-- Gráfico/Área Principal -->
      <div class="flex items-center justify-center h-48 mb-4 rounded bg-gray-50">
        <p class="text-gray-500">Área para gráficos ou conteúdo principal</p>
      </div>
      
      <!-- Cards Secundários -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="flex items-center justify-center rounded bg-gray-50 h-28">
          <p class="text-gray-500">Últimas Atividades</p>
        </div>
        <div class="flex items-center justify-center rounded bg-gray-50 h-28">
          <p class="text-gray-500">Tarefas Pendentes</p>
        </div>
      </div>
    </div>
  </main>

  <!-- Scripts -->
  <script>
    // Toggle Sidebar (Mobile)
    document.getElementById('sidebarToggle').addEventListener('click', function() {
      document.getElementById('sidebar').classList.toggle('-translate-x-full');
    });

    // Toggle E-commerce Dropdown
    document.querySelector('[aria-controls="ecommerce-dropdown"]').addEventListener('click', function() {
      document.getElementById('ecommerce-dropdown').classList.toggle('hidden');
      this.querySelector('i.fa-chevron-down').classList.toggle('rotate-180');
    });

    // Toggle Profile Dropdown
    document.getElementById('profileDropdownButton').addEventListener('click', function() {
      document.getElementById('profileDropdown').classList.toggle('hidden');
    });

    // Close dropdowns when clicking outside
   
  </script>
</body>
</html>