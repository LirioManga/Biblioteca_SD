<section id="adicionar-recurso" class="p-4 border-2 border-gray-200 border-dashed rounded-lg hidden">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">Adicionar Novo Recurso</h1>
    </div>

    <div class="bg-white p-6 rounded-lg shadow-md">
        <form id="form-adicionar-recurso" class="space-y-6">
            <!-- Título -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Título do Recurso*</label>
                <input type="text" id="title" name="title" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Descrição -->
            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Descrição*</label>
                <textarea id="description" name="description" rows="4" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            </div>

            <!-- Tipo -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Tipo de Recurso*</label>
                <select id="type" name="type" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Selecione o tipo</option>
                    <option value="book">Livro</option>
                    <option value="article">Artigo</option>
                    <!-- <option value="">Outro</option> -->
                </select>
            </div>

            <!-- Arquivo -->
            <div>
                <label for="file" class="block text-sm font-medium text-gray-700 mb-1">Arquivo (PDF, DOC, etc.)*</label>
                <input type="file" id="file" name="file_path" accept=".pdf,.doc,.docx,.ppt,.pptx" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Imagem -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Imagem de Capa (Opcional)</label>
                <input type="file" id="image" name="image" accept="image/*"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Disponibilidade -->
            <div class="flex items-center">
                <input type="checkbox" id="available" name="available" checked
                    class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="available" class="ml-2 block text-sm text-gray-700">Disponível para empréstimo</label>
            </div>

            <!-- Botões -->
            <div class="flex justify-end space-x-4 pt-4">
                <button type="button" onclick="cancelarAdicionarRecurso();"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Cancelar
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 border border-transparent rounded-md text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Adicionar Recurso
                </button>
            </div>
        </form>
    </div>
</section>