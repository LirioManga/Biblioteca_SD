addEventListener('DOMContentLoaded', () => {
    carregarRequisicoesPendentes()
   
});
async function carregarRequisicoesPendentes() {
    try {
        const response = await fetch('/student/requisicoes/para-meus-recursos');
        const result = await response.json();
        console.log(result);
        if (!result.success) {
            alert('Erro ao carregar requisições: ' + (result.message || 'Erro desconhecido'));
            return;
        }

        const tbody = document.querySelector('#tabela-requisicoes tbody');
        tbody.innerHTML = '';

        if (result.data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-gray-500">Nenhuma requisição pendente.</td></tr>`;
            return;
        }

        result.data.forEach(requisicao => {
            const linha = document.createElement('tr');
            linha.innerHTML = `
                <td class="px-6 py-4 whitespace-nowrap">${requisicao.resource?.title || '--'}</td>
                <td class="px-6 py-4 whitespace-nowrap">${formatarTipo(requisicao.resource?.type)}</td>
                <td class="px-6 py-4 whitespace-nowrap">${requisicao.user?.name || '--'}</td>
                <td class="px-6 py-4 whitespace-nowrap text-center">
                    <button onclick="aprovarRequisicao(${requisicao.id})" class="bg-green-600 text-white px-3 py-1 rounded-md text-xs">Aprovar</button>
                    <button onclick="rejeitarRequisicao(${requisicao.id})" class="bg-red-600 text-white px-3 py-1 rounded-md text-xs ml-2">Rejeitar</button>
                </td>
            `;
            tbody.appendChild(linha);
        });
    } catch (error) {
        console.error('Erro ao carregar requisições:', error);
        alert('Erro inesperado ao carregar requisições.');
    }
}
async function aprovarRequisicao(id) {
    if (!confirm('Tens certeza que queres aprovar esta requisição?')) return;

    try {
        const response = await fetch('/recursos/requisicao/aprovar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id })
        });

        const result = await response.json();
        if (!result.success) {
            alert('Erro ao aprovar requisição: ' + result.message);
            return;
        }

        alert('Requisição aprovada com sucesso!');
        window.location.href = '/student/requisicoes'; 
    } catch (error) {
        console.error('Erro ao aprovar requisição:', error);
        alert('Erro inesperado ao aprovar requisição.');
    }
}

async function rejeitarRequisicao(id) {
    if (!confirm('Tens certeza que queres rejeitar esta requisição?')) return;

    try {
        const response = await fetch('/recursos/requisicao/rejeitar', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ id })
        });

        const result = await response.json();
        if (!result.success) {
            alert('Erro ao rejeitar requisição: ' + result.message);
            return;
        }

        alert('Requisição rejeitada com sucesso!');
        window.location.href = '/student/requisicoes'; 
    } catch (error) {
        console.error('Erro ao rejeitar requisição:', error);
        alert('Erro inesperado ao rejeitar requisição.');
    }
}