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
            <h1 class="text-2xl font-bold">Konferencijos</h1>
            <nav>
                @auth
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="underline hover:text-gray-300">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
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
