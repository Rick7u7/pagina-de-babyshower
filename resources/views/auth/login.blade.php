<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Baby Shower Planner</title>
</head>
<body class="bg-pink-100 min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <h1 class="text-4xl font-bold text-center text-pink-500 mb-8">
            Baby Shower Planner
        </h1>

        <!-- LOGIN FORM -->
        <div id="loginForm">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Errores -->
                @if ($errors->any())
                    <div class="mb-4 text-red-500 text-sm">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Correo</label>
                    <input type="email" name="email" class="w-full border rounded-lg px-4 py-2" required autofocus>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-semibold">Contraseña</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-lg">
                    Iniciar Sesión
                </button>
            </form>

            <p class="text-center mt-6">
                ¿No tienes cuenta?
                <button onclick="showRegister()" class="text-pink-500 font-semibold">Registrarse</button>
            </p>
        </div>

        <!-- REGISTER FORM -->
        <div id="registerForm" class="hidden">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Nombre</label>
                    <input type="text" name="name" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Correo</label>
                    <input type="email" name="email" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-2 font-semibold">Contraseña</label>
                    <input type="password" name="password" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-semibold">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" class="w-full border rounded-lg px-4 py-2" required>
                </div>

                <button type="submit" class="w-full bg-pink-500 hover:bg-pink-600 text-white py-2 rounded-lg">
                    Registrarse
                </button>
            </form>

            <p class="text-center mt-6">
                ¿Ya tienes cuenta?
                <button onclick="showLogin()" class="text-pink-500 font-semibold">Iniciar sesión</button>
            </p>
        </div>
    </div>

    <script>
        function showRegister() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('registerForm').classList.remove('hidden');
        }
        function showLogin() {
            document.getElementById('registerForm').classList.add('hidden');
            document.getElementById('loginForm').classList.remove('hidden');
        }
    </script>
</body>
</html>
