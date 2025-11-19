<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
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
          secondary: '#adaba2ff',       
          accent: '#3f3949ff',  
          background: '#ffffffff', 
          surface: '#3f3949ff',       
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
   <header class="bg-surface text-white p-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <div class="flex items-center space-x-6">
            <h1 class="text-2xl font-bold">Konferencijos.</h1>
            <a href="{{ url('/') }}" class="hover:text-accent font-semibold">{{ __('Home') }}
</a>
        </div>

        <nav class="flex items-center space-x-4">
          <div class="flex items-center space-x-2">
   <div class="flex items-center space-x-3 ml-4">
    <a href="{{ route('lang.switch', 'en') }}" class="hover:underline">EN</a>
    <a href="{{ route('lang.switch', 'lt') }}" class="hover:underline">LT</a>
</div>

            @auth
            <a href="{{ route('dashboard') }}"
                  class="flex items-center gap-2 hover:underline">
                 <img src="{{ asset('icons/user.svg') }}" class="w-5 h-5">
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
