

async function adicionarRecurso() {

    document.getElementById("meus-recursos-principal").classList.add("hidden");
    document.getElementById("adicionar-recurso").classList.remove("hidden");

} 

document.getElementById('form-adicionar-recurso').addEventListener('submit', async function (e) {
    e.preventDefault(); // Impede envio tradicional

    const form = e.target;
    const formData = new FormData(form);

    const title = formData.get('title');
    const description = formData.get('description');
    const type = formData.get('type');
    const file = formData.get('file_path'); // Agora corresponde ao nome no formulário

    // Validação
    if (!title || !description || !type || !file) {
        alert('Por favor, preencha todos os campos obrigatórios antes de submeter.');
        return;
    }

    const id = document.getElementById('resource-id')?.value;
    if (id) {
        formData.append('id', id);
    }

    const url = id 
        ? `/student/recurso/actualizar`
        : `/student/recurso/registar`;

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        });

        const result = await response.json();
        alert(result.message);

        if (result.status) {
            window.location.href = '/student/meus-recursos';
        }
    } catch (error) {
        console.error('Erro ao enviar recurso:', error);
        alert('Erro inesperado ao submeter o recurso.');
    }
});



function cancelarAdicionarRecurso() {
    document.getElementById("adicionar-recurso").classList.add("hidden");
    document.getElementById("meus-recursos-principal").classList.remove("hidden");
}