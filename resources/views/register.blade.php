<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite('resources/css/app.css') <!-- Ensure Vite is correctly set up -->
</head>
<body class="bg-blue-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-blue-200 p-6 rounded-lg shadow-lg">
    @if ($errors->any())
        <div class="mb-4 bg-red-500 text-white text-sm font-bold p-4 rounded">
            {{ $errors->first() }}
        </div>
    @endif

    <form action="{{ route('register') }}" method="POST" class="space-y-4">
        @csrf
        <h1 class="text-center text-xl font-bold text-blue-900">Register</h1>

        <div>
            <label for="username" class="block text-blue-900 font-medium">Username</label>
            <input type="text" id="username" name="username"
                   value="{{ old('username') }}"
                   class="w-full p-3 border border-blue-400 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter your username">
            @error('username')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password" class="block text-blue-900 font-medium">Password</label>
            <input type="password" id="password" name="password"
                   class="w-full p-3 border border-blue-400 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                   placeholder="Enter your password">
            @error('password')
            <p class="text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded shadow hover:bg-blue-700 focus:ring-2 focus:ring-blue-400">
            Register
        </button>
    </form>
</div>
</body>
</html>
