
addEventListener('DOMContentLoaded', function () {
    carregarMeusRecursos();
 
    const pdfViewer = document.getElementById('pdf-viewer');
    const currentPageEl = document.getElementById('current-page');
    const totalPagesEl = document.getElementById('total-pages');
    const prevPageBtn = document.getElementById('prev-page');
    const nextPageBtn = document.getElementById('next-page');
    const zoomInBtn = document.getElementById('zoom-in');
    const zoomOutBtn = document.getElementById('zoom-out');
    const fullscreenBtn = document.getElementById('fullscreen');
    const closeReaderBtn = document.getElementById('close-reader');
    const pdfContainer = document.getElementById('pdf-container');
    const readerSection = document.getElementById('abrir-recurso');
    
    let currentPage = 1;
    let totalPages = 0;
    let zoomLevel = 1.0;
    let pdfDoc = null;
    
    // Função para carregar o PDF
    async function loadPdf(pdfUrl, title) {
        try {
            // Mostrar a seção do leitor e esconder a lista
            document.getElementById("meus-recursos-principal").classList.add("hidden");
            readerSection.classList.remove("hidden");
            
            document.getElementById('resource-title').textContent = title;
            
            // Usando PDF.js para renderização mais avançada
            const loadingTask = pdfjsLib.getDocument(pdfUrl);
            pdfDoc = await loadingTask.promise;
            
            totalPages = pdfDoc.numPages;
            totalPagesEl.textContent = totalPages;
            currentPage = 1;
            updatePagination();
            
            // Renderizar a primeira página
            await renderPage(currentPage);
            
        } catch (error) {
            console.error('Erro ao carregar PDF:', error);
            alert('Erro ao carregar o PDF. Por favor, tente novamente.');
        }
    }
    
    // Função para renderizar uma página específica
    async function renderPage(pageNum) {
        try {
            const page = await pdfDoc.getPage(pageNum);
            const viewport = page.getViewport({ scale: zoomLevel });
            
            // Preparar o canvas
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            canvas.height = viewport.height;
            canvas.width = viewport.width;
            
            // Limpar o container e adicionar o canvas
            pdfContainer.innerHTML = '';
            pdfContainer.appendChild(canvas);
            
            // Renderizar a página no canvas
            await page.render({
                canvasContext: context,
                viewport: viewport
            }).promise;
            
            currentPage = pageNum;
            updatePagination();
            
        } catch (error) {
            console.error('Erro ao renderizar página:', error);
        }
    }
    
    // Funções de controle
    function updatePagination() {
        currentPageEl.textContent = currentPage;
        prevPageBtn.disabled = currentPage <= 1;
        nextPageBtn.disabled = currentPage >= totalPages;
    }
    
    prevPageBtn.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderPage(currentPage);
        }
    });
    
    nextPageBtn.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            renderPage(currentPage);
        }
    });
    
    zoomInBtn.addEventListener('click', () => {
        zoomLevel += 0.25;
        renderPage(currentPage);
    });
    
    zoomOutBtn.addEventListener('click', () => {
        if (zoomLevel > 0.5) {
            zoomLevel -= 0.25;
            renderPage(currentPage);
        }
    });
    
    fullscreenBtn.addEventListener('click', () => {
        if (!document.fullscreenElement) {
            pdfContainer.requestFullscreen().catch(err => {
                alert(`Erro ao tentar entrar em tela cheia: ${err.message}`);
            });
        } else {
            document.exitFullscreen();
        }
    });
    
    closeReaderBtn.addEventListener('click', () => {
        readerSection.classList.add("hidden");
        document.getElementById("meus-recursos-principal").classList.remove("hidden");
    });
    
    // Função para abrir um recurso
    window.abrirRecurso = async function(id) {
     
        document.getElementById("meus-recursos-principal").classList.add("hidden");
        document.getElementById("abrir-recurso").classList.remove("hidden");
        try {
            const response = await fetch(`/student/recurso/abrir/${id}`);
            const result = await response.json();
            
            if (!result.success) {
                alert('Erro ao abrir recurso: ' + result.message);
                return;
            }
            
            const recurso = result.data;
            const pdfUrl = result.pdf_url; // Usando a URL retornada pelo servidor
            
            console.log('Recurso:', result.title);
            console.log('PDF URL:', pdfUrl);
            
            await loadPdf(pdfUrl, result.title);
            
        } catch (error) {
            console.error('Erro ao abrir recurso:', error);
            alert('Erro ao abrir o recurso. Por favor, tente novamente.');
        }
    };
    
});
let formMode = 'add';

async function adicionarRecurso() {
    formMode = 'add';
    document.getElementById("meus-recursos-principal").classList.add("hidden");
    document.getElementById("adicionar-recurso").classList.remove("hidden");
    document.getElementById("form-adicionar-recurso").reset();
} 

document.getElementById('form-adicionar-recurso').addEventListener('submit', async function (e) {
    e.preventDefault(); // Impede envio tradicional

    const form = e.target;
    const formData = new FormData(form);
    const resourceId = formData.get('resource_id');
    const title = formData.get('title');
    const description = formData.get('description');
    const type = formData.get('type');
    const file = formData.get('file_path'); 
    const availableChecked = form.querySelector('#available').checked;
    formData.set('available', availableChecked ? '1' : '0'); 

    // Validação
    if (!title || !description || !type || !file) {
        alert('Por favor, preencha todos os campos obrigatórios antes de submeter.');
        return;
    }
    if (formMode === 'add' && !file) {
        alert('Por favor, selecione um arquivo para upload.');
        return;
    }
    
   
    try {
        let url;
        
        if (formMode === 'edit') {
            url = `/student/recurso/actualizar/${resourceId}`;
           
        } else {
            url = `/student/recurso/registar`;
          
        }

        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });

        const result = await response.json();
        alert(result.message);

        if (result.success) {
            window.location.href = '/student/meus-recursos';
        }
    } catch (error) {
        console.error('Erro ao enviar recurso:', error);
        alert('Erro inesperado ao submeter o recurso.');
    }
});

async function carregarMeusRecursos() {
    try {
        const response = await fetch('/student/recursos/listar'); 
        const result = await response.json();
        console.log(result);

        if (!result.success) {
            alert('Erro ao buscar recursos: ' + result.message);
            return;
        }

        const recursos = result.data;
        renderizarRecursos(recursos);

    } catch (error) {
        console.error('Erro ao carregar recursos:', error);
        alert('Erro inesperado ao carregar recursos.');
    }
}

function formatarTipo(tipo) {
    switch (tipo) {
        case 'book': return 'Livro';
        case 'article': return 'Artigo';
        default: return tipo;
    }
}

function formatarData(dataISO) {
    const data = new Date(dataISO);
    const dia = String(data.getDate()).padStart(2, '0');
    const mes = String(data.getMonth() + 1).padStart(2, '0');
    const ano = data.getFullYear();
    return `${dia}/${mes}/${ano}`;
}

async function excluirRecurso(id) {
    try {
        if (!confirm('Tem certeza que deseja excluir este recurso? Esta ação não pode ser desfeita.')) {
            return;
        }
        
        const response = await fetch(`/student/recurso/excluir/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            }
        });
        
        const result = await response.json();
        
        if (result.success) {
            alert('Recurso excluído com sucesso!');
            carregarMeusRecursos(); 
        }else{
            alert('Erro ao excluir recurso: ' + result.message);
            carregarMeusRecursos();
        }
        
      
        
    } catch (error) {
        console.error('Erro ao excluir recurso:', error);
        alert('Erro inesperado ao excluir recurso.');
    }
}

async function editarRecurso(id) {
    document.getElementById("meus-recursos-principal").classList.add("hidden");
   
    formMode = 'edit';
    try {
        // Buscar os dados do recurso
        const response = await fetch(`/student/recurso/editar/${id}`);
        const result = await response.json();
        
        if (!result.success) {
            alert('Erro ao carregar recurso: ' + result.message);
            return;
        }
        
        const recurso = result.data;
        
        // Configurar o formulário existente para edição
        const formSection = document.getElementById('adicionar-recurso');
        formSection.classList.remove('hidden');
        
        // Atualizar o título do formulário
        const tituloForm = formSection.querySelector('h1');
        tituloForm.textContent = 'Editar Recurso';
        
        // Preencher os campos do formulário
        document.getElementById('title').value = recurso.title;
        document.getElementById('description').value = recurso.description;
        document.getElementById('type').value = recurso.type;
        document.getElementById('available').checked = recurso.available;
        document.getElementById('resource_id').value = recurso.id;
        
        // Mudar o texto do botão de submit
        const submitBtn = formSection.querySelector('button[type="submit"]');
        submitBtn.textContent = 'Actualizar Recurso';
        
                      
    } catch (error) {
        console.error('Erro ao abrir edição:', error);
        alert('Erro ao carregar recurso para edição');
    }
}


document.getElementById('pesquisa-recursos').addEventListener('input', function(e) {
    // Se o campo estiver vazio, carrega todos os recursos
    if (e.target.value.trim() === '') {
        carregarMeusRecursos();
    }
});

function renderizarRecursos(recursos) {
    const tbody = document.querySelector('#tabela-meus-recursos tbody');
    tbody.innerHTML = '';

    if (recursos.length === 0) {
        tbody.innerHTML = `<tr><td colspan="5" class="px-6 py-4 text-center text-gray-500">Nenhum recurso encontrado.</td></tr>`;
        return;
    }

    recursos.forEach(recurso => {
        const linha = document.createElement('tr');
        linha.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">${recurso.title}</div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatarTipo(recurso.type)}</td>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full ${recurso.available ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                    ${recurso.available ? 'Disponível' : 'Indisponível'}
                </span>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">${formatarData(recurso.created_at)}</td>
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2 flex justify-center">
                <button onclick="abrirRecurso(${recurso.id});" class="text-white bg-green-600 hover:bg-green-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    Abrir
                </button>

                <button onclick="editarRecurso(${recurso.id});" class="text-white bg-blue-600 hover:bg-blue-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    Editar
                </button>
                <button onclick="excluirRecurso(${recurso.id});" class="text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md text-xs font-medium transition-colors">
                    Excluir
                </button>
            </td>
        `;
        tbody.appendChild(linha);
    });
}


async function pesquisarRecursos() {
    const termo = document.getElementById('pesquisa-recursos').value.trim();
    
    try {
        if (!termo) {
            carregarMeusRecursos();
            return;
        }
        
        const response = await fetch(`/student/recurso/buscar?q=${encodeURIComponent(termo)}`);
        const result = await response.json();
        
        if (!result.success) {
            alert('Erro ao buscar recursos: ' + result.message);
            return;
        }
        
        renderizarRecursos(result.data);
        
    } catch (error) {
        console.error('Erro ao pesquisar recursos:', error);
        alert('Erro inesperado ao pesquisar recursos.');
    }
}

function cancelarAdicionarRecurso() {
    document.getElementById("adicionar-recurso").classList.add("hidden");
    document.getElementById("meus-recursos-principal").classList.remove("hidden");
}