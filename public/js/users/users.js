document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('recover-form');
    const emailInput = document.getElementById('email');
    const feedback = document.getElementById('feedback');

    form.addEventListener('submit', async (event) => {
        event.preventDefault();

        const email = emailInput.value.trim();
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/recover-password', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ email })
            });

            const data = await response.json();

            if (response.ok) {
                feedback.innerHTML = `<span class="text-green-600">${data.message}</span>`;
                form.reset();
            } else {
                feedback.innerHTML = `<span class="text-red-600">${data.message || 'Erro ao recuperar a senha.'}</span>`;
            }
        } catch (error) {
            console.error('Erro:', error);
            feedback.innerHTML = `<span class="text-red-600">Erro na conexão com o servidor.</span>`;
        }
    });
});
