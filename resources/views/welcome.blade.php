<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Conference App</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex flex-col items-center justify-center">

    <div class="bg-white p-8 rounded shadow-md w-96 text-center">
        <h1 class="text-2xl font-bold mb-6">Welcome to the Conference App</h1>

        @auth
            <p class="mb-4">Hello, {{ auth()->user()->name }}!</p>
            <a href="{{ route('conferences.index') }}" class="text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700">View Conferences</a>
        @else
            <p class="mb-6">Please log in or register to view and sign into conferences.</p>
            <a href="{{ route('login') }}" class="text-white bg-blue-600 px-4 py-2 rounded hover:bg-blue-700 mr-4">Log In</a>
            <a href="{{ route('register') }}" class="text-blue-600 hover:underline">Register</a>
        @endauth
    </div>

</body>
</html>
