<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>
      Basic Tables | TailAdmin - Tailwind CSS Admin Dashboard Template
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script> --}}
  </head>
  <body
    x-data="{ page: 'userIndex', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': true, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
  >
    <!-- ===== Preloader Start ===== -->
    @include('student.partials.preloader')
    <!-- ===== Preloader End ===== -->
    
    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- ===== Sidebar Start ===== -->
        @include('student.partials.sidebar')
      <!-- ===== Sidebar End ===== -->

      <!-- ===== Content Area Start ===== -->
      <div
        class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto"
      >
        <!-- Small Device Overlay Start -->
        @include('student.partials.overlay')
        <!-- Small Device Overlay End -->

        <!-- ===== Header Start ===== -->
        @include('student.partials.header')
        <!-- ===== Header End ===== -->

        <!-- ===== Main Content Start ===== -->
        <main>
          <div class="p-4 mx-auto max-w-(--breakpoint-2xl) md:p-6">
            <!-- Breadcrumb Start -->
            <div x-data="{ pageName: `Basic Tables`}">
              
            </div>
            <!-- Breadcrumb End -->

            <div class="space-y-5 sm:space-y-6">
              <div
                class="rounded-2xl border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]"
              >
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3
                    class="text-base font-medium text-gray-800 dark:text-white/90"
                  >
                    Basic Table 1
                  </h3>
                </div>
                <div
                  class="p-5 border-t border-gray-100 dark:border-gray-800 sm:p-6"
                >
                  <!-- ====== Table Six Start -->
                  <div class="max-w-full overflow-x-auto">
                    <table class="min-w-full">
                      <!-- table header start -->
                      <thead>
                        <tr class="border-b border-gray-100 dark:border-gray-800">
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400"
                              >
                                Nome do Livro
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400"
                              >
                                Status
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400"
                              >
                                Publicado Por
                              </p>
                            </div>
                          </th>
                          <th class="px-5 py-3 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="font-medium text-gray-500 text-theme-xs dark:text-gray-400"
                              >
                                Budget
                              </p>
                            </div>
                          </th>
                        </tr>
                      </thead>
                      <!-- table header end -->
                      <!-- table body start -->
                      <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        <tr>
                          <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                              <div class="flex items-center gap-3">
                                <div class="w-10 h-10 overflow-hidden rounded-lg">
                                  <img src="{{asset('images/user/user-17.jpg')}}" alt="brand" />
                                </div>
                
                                <div>
                                  <span
                                    class="block font-medium text-gray-800 text-theme-sm dark:text-white/90"
                                  >
                                    Livo de Redes
                                  </span>
                                  <span
                                    class="block text-gray-500 text-theme-xs dark:text-gray-400"
                                  >
                                    Nesse livro voce....
                                  </span>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                              <p
                                class="rounded-full bg-success-50 px-2 py-0.5 text-theme-xs font-medium text-success-700 dark:bg-success-500/15 dark:text-success-500"
                              >
                                Disponivel
                              </p>
                            </div>
                          </td>
                          <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                              <div class="flex -space-x-2">
                                <div
                                  class="w-6 h-6 overflow-hidden border-2 border-white rounded-full dark:border-gray-900"
                                >
                                  <img src="{{asset('images/user/user-22.jpg')}}" alt="user" />
                                </div>
                                <p class="text-gray-500 ml-4 text-theme-sm dark:text-gray-400">Fernando Chau</p>
                              </div>
                            </div>
                          </td>
                          
                          <td class="px-5 py-4 sm:px-6">
                            <div class="flex items-center">
                              <button
                                class="inline-flex items-center gap-2 px-2 py-1 text-sm font-light text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                              >
                                Emprestar
                              </button>
                            </div>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                  <!-- ====== Table Six End -->
                </div>
              </div>
            </div>
          </div>
        </main>
        <!-- ===== Main Content End ===== -->
      </div>
      <!-- ===== Content Area End ===== -->
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>
  
</html>
