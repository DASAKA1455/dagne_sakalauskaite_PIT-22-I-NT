<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta charset="UTF-8" />
    <title>@yield('title', 'Conference App')</title>
 <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
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

 <div
    x-data="flashMessage()"
    x-show="show"
    x-transition
    x-init="init()"
    class="fixed top-4 left-1/2 transform -translate-x-1/2 z-50 px-6 py-3 rounded shadow-lg"
    :class="bgClasses[type]"
>
    <div class="flex items-center justify-between space-x-4">
        <span x-text="message"></span>
        <button @click="show = false" class="font-bold">&times;</button>
    </div>
</div>


  <script>
 function flashMessage() {
    return {
        show: @json(session()->has('flash')),
        type: @json(session('flash.type') ?? 'success'),
        message: @json(session('flash.message') ?? ''),
        bgClasses: {
            success: 'bg-green-100 border border-green-400 text-green-700',
            error: 'bg-red-100 border border-red-400 text-red-700',
            warning: 'bg-yellow-100 border border-yellow-400 text-yellow-700',
            info: 'bg-blue-100 border border-blue-400 text-blue-700'
        },
        init() {
            if (this.show) {
                setTimeout(() => this.show = false, 4000);
            }
        }
    }
}

  </script>

  <header class="bg-surface text-white p-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo + Home -->
        <div class="flex items-center space-x-6">
            <h1 class="text-2xl font-bold">Konferencijos.</h1>
            <a href="{{ url('/') }}"
               class="relative font-semibold text-white
                      after:block after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-accent after:transition-all after:duration-300 hover:after:w-full">
                {{ __('Home') }}
            </a>
        <a href="{{ route('dashboard') }}#my-conferences"
          class="relative font-semibold text-white
                  after:block after:absolute after:bottom-0 after:left-0 after:w-0 after:h-[2px] after:bg-accent after:transition-all after:duration-300 hover:after:w-full">
            {{ __('My conferences') }}
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
                   class="underline hover:text-gray-300">{{ __('Log out') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            @else
                <a href="{{ route('login') }}" class="hover:underline">   {{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="hover:underline">   {{ __('Register') }}</a>
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
