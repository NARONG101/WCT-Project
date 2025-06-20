<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Stock Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen px-4">

    <div class="bg-white shadow-xl rounded-2xl max-w-md w-full p-8 space-y-6">
        <div class="text-center">
            <div class="text-indigo-600 text-3xl font-bold mb-1 flex items-center justify-center gap-2">
                <i class="fas fa-boxes"></i> StockManager
            </div>
            <p class="text-sm text-gray-500">Create a new account to manage your inventory</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 text-sm rounded-lg p-4">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" id="name" required autofocus
                       value="{{ old('name') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="Your full name">
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required
                       value="{{ old('email') }}"
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="you@example.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                           class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none pr-10"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password')" class="absolute right-3 top-3 text-gray-500 text-sm">
                        👁️
                    </button>
                </div>
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" required
                           class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none pr-10"
                           placeholder="••••••••">
                    <button type="button" onclick="togglePassword('password_confirmation')" class="absolute right-3 top-3 text-gray-500 text-sm">
                        👁️
                    </button>
                </div>
            </div>

            <!-- Submit -->
            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition">
                    Register
                </button>
            </div>

            <div class="text-center text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline">Sign in here</a>
            </div>
        </form>
    </div>

    <!-- Password toggle script -->
    <script>
        function togglePassword(id) {
            const field = document.getElementById(id);
            field.type = field.type === 'password' ? 'text' : 'password';
        }
    </script>

    <!-- Optional: FontAwesome for icon -->
    <script src="https://kit.fontawesome.com/a2e0c5f204.js" crossorigin="anonymous"></script>
</body>
</html>
