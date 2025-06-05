<section id="abrir-recurso" class="p-2 hidden">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Modo Leitura</h1>
        <button id="close-reader" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">
            Fechar Leitor
        </button>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 id="resource-title" class="text-xl font-semibold text-gray-700"></h2>
            <div class="flex space-x-2">
                <button id="zoom-in" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                    <i class="fas fa-search-plus"></i>
                </button>
                <button id="zoom-out" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                    <i class="fas fa-search-minus"></i>
                </button>
                <button id="fullscreen" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                    <i class="fas fa-expand"></i>
                </button>
            </div>
        </div>
        
        <div class="border rounded-lg overflow-hidden">
            <div id="pdf-container" class="h-screen-80 overflow-auto bg-gray-100">
                <iframe id="pdf-viewer" class="w-full h-full" frameborder="0"></iframe>
            </div>
        </div>
        
        <div class="mt-4 flex justify-between items-center">
            <div class="text-sm text-gray-500">
                Página <span id="current-page">1</span> de <span id="total-pages">0</span>
            </div>
            <div class="flex space-x-2">
                <button id="prev-page" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded">
                    <i class="fas fa-chevron-left"></i> Anterior
                </button>
                <button id="next-page" class="bg-gray-200 hover:bg-gray-300 px-3 py-1 rounded">
                    Próxima <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>
</section>

