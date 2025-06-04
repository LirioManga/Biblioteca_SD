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
const registarForm = document.getElementById('register-form');
registarForm.addEventListener('submit', async function (e) {
    e.preventDefault();

    // Obter os dados do formulário
    const name = document.getElementById('name').value.trim();
    const email = document.getElementById('email').value.trim();
    const password = document.getElementById('password').value;
    const passwordConfirmation = document.getElementById('password_confirmation').value;

    // Limpar mensagens anteriores
    clearFeedback();

    // Validações
    let valid = true;

    if (!email.includes('@')) {
        showFeedback('email', 'O email deve conter "@"', 'text-red-500');
        valid = false;
    }

    if (password.length < 6) {
        showFeedback('password', 'A palavra-passe deve ter pelo menos 6 caracteres.', 'text-red-500');
        valid = false;
    }

    if (password !== passwordConfirmation) {
        showFeedback('password_confirmation', 'As palavras-passe não coincidem.', 'text-red-500');
        valid = false;
    }

    if (!valid) return;

    try {
        const response = await fetch("/register-user", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ name, email, password })
        });

        const data = await response.json();

        if (data.status) {
            showFeedback('registered-success', 'Utilizador registado com sucesso!', 'text-green-600');
           
            setTimeout(() => {
                window.location.href = "/login";
            }, 30000);
        } else {
            alert(data.message || 'Erro ao registar o utilizador.');
        }
    } catch (error) {
        console.error('Erro na submissão:', error);
        alert('Erro na comunicação com o servidor.');
    }finally{
        setTimeout(() => {
            window.location.href = "/login";
        }, 30000);
        registarForm.reset(); // Limpar o formulário após submissão
        clearFeedback(); // Limpar feedbacks
    }

});

function showFeedback(fieldId, message, colorClass) {
    const feedback = document.getElementById(`feedback-${fieldId}`);
    if (feedback) {
        feedback.textContent = message;
        feedback.className = `mt-2 text-sm text-center ${colorClass}`;
    }
}

function clearFeedback() {
    ['email', 'password', 'password_confirmation'].forEach(id => {
        const el = document.getElementById(`feedback-${id}`);
        if (el) {
            el.textContent = '';
            el.className = 'mt-4 text-sm text-center';
        }
    });
}
