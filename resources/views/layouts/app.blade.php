<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Conference App')</title>
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          primary: '#000000ff',      
          secondary: '#0088ffff',       
          accent: '#44372cba',  
          background: '#121212', 
          surface: '#1f1f1f',       
          textPrimary: '#e0e0e0',    
          textSecondary: '#a0a0a0', 
        },
        fontFamily: {
          sans: ['Orbitron', 'ui-sans-serif', 'system-ui'],
        },
      },
    },
  }
</script>
<body class="bg-gray-100 min-h-screen flex flex-col">

    {{-- Header --}}
   <header class="bg-primary text-white p-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <h1 class="text-2xl font-bold">Konferencijos.</h1>
            <a href="{{ url('/') }}" class="hover:text-accent font-semibold">Home</a>
        </div>
        <nav class="flex items-center space-x-4">
          
            @auth
             <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 hover:opacity-80">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-6 h-6">
            <path fill="#ffffff" d="M320 312C386.3 312 440 258.3 440 192C440 125.7 386.3 72 320 72C253.7 72 200 125.7 200 192C200 258.3 253.7 312 320 312zM290.3 368C191.8 368 112 447.8 112 546.3C112 562.7 125.3 576 141.7 576L498.3 576C514.7 576 528 562.7 528 546.3C528 447.8 448.2 368 349.7 368L290.3 368z"/>
        </svg>
    </a>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="underline hover:text-gray-300">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">Login</a>
                <a href="{{ route('register') }}" class="hover:underline">Register</a>
            @endauth
        </nav>
    </div>
</header>


    {{-- Main content --}}
    <main class="container mx-auto flex-grow p-6">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-accent text-gray-300 p-4 text-center mt-12">
        &copy; {{ date('Y') }} D. Sakalauskaitė.
    </footer>

</body>
</html>
