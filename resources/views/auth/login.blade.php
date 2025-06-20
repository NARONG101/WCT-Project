<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Stock Management</title>
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
            <p class="text-sm text-gray-500">Welcome back! Sign in to continue</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 text-sm rounded-lg p-4">
                @foreach ($errors->all() as $error)
                    <div>• {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" id="email" required autofocus
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="you@example.com">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" id="password" required
                       class="w-full border border-gray-300 px-4 py-3 rounded-lg shadow-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                       placeholder="••••••••">
            </div>

            <!-- Remember & Forgot -->
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center">
                    <input type="checkbox" name="remember"
                           class="text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2">
                    Remember me
                </label>
                <a href="#" class="text-indigo-600 hover:underline">Forgot password?</a>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white py-3 rounded-lg font-semibold transition">
                    Sign In
                </button>
            </div>

            <!-- Register Link -->
        </form>
    </div>

    <!-- Optional: FontAwesome -->
    <script src="https://kit.fontawesome.com/a2e0c5f204.js" crossorigin="anonymous"></script>
</body>
</html>
