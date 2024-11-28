<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    @vite('resources/css/app.css') <!-- Ensure Tailwind CSS is set up -->
</head>
<body class="bg-blue-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-md bg-blue-50 p-6 rounded-lg shadow-lg shadow-blue-500/50 text-center">
    <h1 class="text-2xl font-bold text-blue-900">Yaaay Registration Successful!</h1>
    <p class="text-blue-700 mt-4">Welcome, <span class="font-semibold">{{ $username }}</span>!</p>
</div>

</body>
</html>
