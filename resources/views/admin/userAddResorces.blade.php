<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport"
    content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>
    Form Elements | TailAdmin - Tailwind CSS Admin Dashboard Template
  </title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
  x-data="{ page: 'userBooks', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': true, 'scrollTop': false }"
  x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark bg-gray-900': darkMode === true}">
  <!-- ===== Preloader Start ===== -->
  @include('student.partials.preloader')
  <!-- ===== Preloader End ===== -->

  <!-- ===== Page Wrapper Start ===== -->
  <div class="flex h-screen overflow-hidden">
    <!-- ===== Sidebar Start ===== -->
    @include('student.partials.sidebar')
    <!-- ===== Sidebar End ===== -->

    <!-- ===== Content Area Start ===== -->
    <div class="relative flex flex-1 flex-col overflow-x-hidden overflow-y-auto">
      <!-- Small Device Overlay Start -->
      @include('student.partials.overlay')
      <!-- Small Device Overlay End -->

      <!-- ===== Header Start ===== -->
      @include('student.partials.header')
      <!-- ===== Header End ===== -->

      <!-- ===== Main Content Start ===== -->
      <main>
        <div class="mx-auto max-w-(--breakpoint-2xl) p-4 md:p-6">
          <!-- Breadcrumb Start -->
          <div x-data="{ pageName: `Form Elements`}">
            <include src="./partials/breadcrumb.html" />
          </div>
          <!-- Breadcrumb End -->

          <!-- ====== Form Elements Section Start -->
          <div class="flex w-full items-center justify-center h-fit gap-6 sm:grid-cols-2">
            <div class="w-full space-y-6">
              <div class="rounded-2xl w-full border border-gray-200 bg-white dark:border-gray-800 dark:bg-white/[0.03]">
                <div class="px-5 py-4 sm:px-6 sm:py-5">
                  <h3 class="text-base font-medium text-gray-800 dark:text-white/90">
                    Default Inputs
                  </h3>
                </div>
                <div class="space-y-6 border-t border-gray-100 p-5 sm:p-6 dark:border-gray-800">
                  <!-- Elements -->
                  <form class="space-y-6" action="">
                    <div>
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Nome do Ficheiro
                      </label>
                      <input type="text" name="fileName"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30" />
                    </div>

                    <div>
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Upload do Ficheiro
                      </label>
                      <input type="file"
                        class="focus:border-ring-brand-300 shadow-theme-xs focus:file:ring-brand-300 h-11 w-full overflow-hidden rounded-lg border border-gray-300 bg-transparent text-sm text-gray-500 transition-colors file:mr-5 file:border-collapse file:cursor-pointer file:rounded-l-lg file:border-0 file:border-r file:border-solid file:border-gray-200 file:bg-gray-50 file:py-3 file:pr-3 file:pl-3.5 file:text-sm file:text-gray-700 placeholder:text-gray-400 hover:file:bg-gray-100 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-gray-400 dark:text-white/90 dark:file:border-gray-800 dark:file:bg-white/[0.03] dark:file:text-gray-400 dark:placeholder:text-gray-400" />
                    </div>

                    <div>
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Descrição
                      </label>
                      <textarea type="text" rows="2"
                        class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"></textarea>
                    </div>

                    <div>
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Categoria
                      </label>
                      <div x-data="{ isOptionSelected: false }" class="relative z-20 bg-transparent">
                        <select
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          :class="isOptionSelected && 'text-gray-800 dark:text-white/90'"
                          @change="isOptionSelected = true">
                          <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Select Option
                          </option>
                          <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Marketing
                          </option>
                          <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Template
                          </option>
                          <option value="" class="text-gray-700 dark:bg-gray-900 dark:text-gray-400">
                            Development
                          </option>
                        </select>
                        <span
                          class="pointer-events-none absolute top-1/2 right-4 z-30 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                          <svg class="stroke-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.79175 7.396L10.0001 12.6043L15.2084 7.396" stroke="" stroke-width="1.5"
                              stroke-linecap="round" stroke-linejoin="round" />
                          </svg>
                        </span>
                      </div>
                    </div>

                    <!-- Elements -->

                    <!-- Elements -->
                    <div>
                      <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                        Data de Entrega
                      </label>

                      <div class="relative">
                        <input type="date" placeholder="Select date"
                          class="dark:bg-dark-900 shadow-theme-xs focus:border-brand-300 focus:ring-brand-500/10 dark:focus:border-brand-800 h-11 w-full appearance-none rounded-lg border border-gray-300 bg-transparent bg-none px-4 py-2.5 pr-11 pl-4 text-sm text-gray-800 placeholder:text-gray-400 focus:ring-3 focus:outline-hidden dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30"
                          onclick="this.showPicker()" />
                        <span
                          class="pointer-events-none absolute top-1/2 right-3 -translate-y-1/2 text-gray-500 dark:text-gray-400">
                          <svg class="fill-current" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                              d="M6.66659 1.5415C7.0808 1.5415 7.41658 1.87729 7.41658 2.2915V2.99984H12.5833V2.2915C12.5833 1.87729 12.919 1.5415 13.3333 1.5415C13.7475 1.5415 14.0833 1.87729 14.0833 2.2915V2.99984L15.4166 2.99984C16.5212 2.99984 17.4166 3.89527 17.4166 4.99984V7.49984V15.8332C17.4166 16.9377 16.5212 17.8332 15.4166 17.8332H4.58325C3.47868 17.8332 2.58325 16.9377 2.58325 15.8332V7.49984V4.99984C2.58325 3.89527 3.47868 2.99984 4.58325 2.99984L5.91659 2.99984V2.2915C5.91659 1.87729 6.25237 1.5415 6.66659 1.5415ZM6.66659 4.49984H4.58325C4.30711 4.49984 4.08325 4.7237 4.08325 4.99984V6.74984H15.9166V4.99984C15.9166 4.7237 15.6927 4.49984 15.4166 4.49984H13.3333H6.66659ZM15.9166 8.24984H4.08325V15.8332C4.08325 16.1093 4.30711 16.3332 4.58325 16.3332H15.4166C15.6927 16.3332 15.9166 16.1093 15.9166 15.8332V8.24984Z"
                              fill="" />
                          </svg>
                        </span>
                      </div>
                    </div>

                    <div class="flex items-center justify-between gap-6">
                      <button
                        class="flex justify-center items-center w-full gap-2 px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600"
                      >
                        Submeter
                      </button>

                      <button
                        class="flex justify-center items-center w-full gap-2 rounded-lg bg-white px-4 py-3 text-sm font-medium text-gray-700 shadow-theme-xs ring-1 ring-inset ring-gray-300 transition hover:bg-gray-50 dark:bg-gray-800 dark:text-gray-400 dark:ring-gray-700 dark:hover:bg-white/[0.03]"
                      >
                        Cancelar 
                      </button>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- ====== Form Elements Section End -->
        </div>
      </main>
      <!-- ===== Main Content End ===== -->
    </div>
    <!-- ===== Content Area End ===== -->
  </div>
  <!-- ===== Page Wrapper End ===== -->

  <script>
    function dropdown() {
      return {
        options: [],
        selected: [],
        show: false,
        open() {
          this.show = true;
        },
        close() {
          this.show = false;
        },
        isOpen() {
          return this.show === true;
        },
        select(index, event) {
          if (!this.options[index].selected) {
            this.options[index].selected = true;
            this.options[index].element = event.target;
            this.selected.push(index);
          } else {
            this.selected.splice(this.selected.lastIndexOf(index), 1);
            this.options[index].selected = false;
          }
        },
        remove(index, option) {
          this.options[option].selected = false;
          this.selected.splice(index, 1);
        },
        loadOptions() {
          const options = document.getElementById("select").options;
          for (let i = 0; i < options.length; i++) {
            this.options.push({
              value: options[i].value,
              text: options[i].innerText,
              selected:
                options[i].getAttribute("selected") != null
                  ? options[i].getAttribute("selected")
                  : false,
            });
          }
        },
        selectedValues() {
          return this.selected.map((option) => {
            return this.options[option].value;
          });
        },
      };
    }
  </script>
</body>

</html>