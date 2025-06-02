<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Login - Biblioteca</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Acesso ao Sistema</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600 text-sm">
                @foreach ($errors->all() as $error)
                    <p>• {{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <!-- Email ou Nome -->
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Email ou Nome de Utilizador</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                    class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700">Senha</label>
                <input id="password" type="password" name="password" required
                    class="w-full mt-1 p-2 border rounded focus:outline-none focus:ring-2 focus:ring-blue-400">
            </div>

            <!-- Botão -->
            <div class="flex items-center justify-between">
                <button type="submit"
                    class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                    Entrar
                </button>
            </div>
        </form>
    </div>
</body>
</html>
