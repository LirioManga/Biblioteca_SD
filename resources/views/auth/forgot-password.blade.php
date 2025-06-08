<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <title>Biblioteca - Recuperar conta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Ícones do Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body class="relative">
    <!-- Botão Voltar - posicionado no body -->
    <a href="{{ url('/login') }}" class="absolute left-6 top-6 text-gray-500 hover:text-indigo-600">
        <i class="fas fa-arrow-left text-lg"></i>
    </a>

    <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm border border-gray-200 rounded-lg p-8 shadow-sm">
           
            <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">Recuperação da conta</h2>

            <div class="mt-10">
                <form id="recover-form" class="space-y-6">

                    <div>
                        <label for="name" class="block text-sm/6 font-medium text-gray-900">Email</label>
                        <div class="mt-2">
                            <input type="text" name="email" id="email" autocomplete="username" required  placeholder=""
                                   class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                        </div>
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Autenticar</button>
                    </div>
                </form>
                <div id="feedback" class="mt-4 text-sm text-center"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/users/users.js') }}"></script>
    <script>
        
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Altera o ícone conforme o estado
            if (type === 'password') {
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            } else {
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>