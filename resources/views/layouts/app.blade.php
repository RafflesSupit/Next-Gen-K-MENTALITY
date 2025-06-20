<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Warung Makan Berkah')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="{{ route('home') }}" class="text-xl font-bold text-gray-800">Warung Berkah</a>
                
                <div class="flex items-center space-x-4">
                    <!-- Menu Desktop (hidden di mobile) -->
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('home') }}" class="text-gray-600 hover:text-gray-800">Home</a>
                        <a href="{{ route('menu') }}" class="text-gray-600 hover:text-gray-800">Menu</a>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">Admin</a>
                            @else
                                <a href="{{ route('order.create') }}" class="text-green-600 hover:text-green-800">Order</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800">Login</a>
                            <a href="{{ route('register') }}" class="text-green-600 hover:text-green-800">Register</a>
                        @endauth
                    </div>
                    
                    <!-- Dropdown Profile untuk Desktop -->
                    @auth
                    <div class="relative hidden md:block">
                        <button id="profile-dropdown-button" class="flex items-center text-gray-600 hover:text-gray-800 focus:outline-none">
                            <i class="fas fa-user-circle text-xl"></i>
                        </button>

                        <div id="profile-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                            {{-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a> --}}
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                    @endauth
                    
                    <!-- Hamburger Button untuk Mobile -->
                    <button id="mobile-menu-button" class="md:hidden text-gray-600 focus:outline-none">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Menu Mobile (hidden secara default) -->
            <div id="mobile-menu" class="md:hidden hidden flex-col space-y-2 pb-2">
                <a href="{{ route('home') }}" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Home</a>
                <a href="{{ route('menu') }}" class="block px-2 py-1 text-gray-600 hover:text-gray-800">Menu</a>
                @auth
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block px-2 py-1 text-blue-600 hover:text-blue-800">Admin</a>
                    @else
                        <a href="{{ route('order.create') }}" class="block px-2 py-1 text-green-600 hover:text-green-800">Order</a>
                    @endif
                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="block px-2 py-1 text-red-600 hover:text-red-800 text-left w-full">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-2 py-1 text-blue-600 hover:text-blue-800">Login</a>
                    <a href="{{ route('register') }}" class="block px-2 py-1 text-green-600 hover:text-green-800">Register</a>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mx-4 mt-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mx-4 mt-4">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        @yield('content')
    </main>

    <script>
        // Toggle mobile menu
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
        
        // Tutup menu mobile saat mengklik di luar menu
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobile-menu');
            const button = document.getElementById('mobile-menu-button');
            
            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
        
        // Toggle profile dropdown
        const profileDropdownButton = document.getElementById('profile-dropdown-button');
        if (profileDropdownButton) {
            profileDropdownButton.addEventListener('click', function() {
                const dropdown = document.getElementById('profile-dropdown');
                dropdown.classList.toggle('hidden');
            });
            
            // Tutup dropdown saat mengklik di luar
            document.addEventListener('click', function(event) {
                const dropdown = document.getElementById('profile-dropdown');
                const dropdownButton = document.getElementById('profile-dropdown-button');
                
                if (dropdown && dropdownButton && 
                    !dropdown.contains(event.target) && 
                    !dropdownButton.contains(event.target)) {
                    dropdown.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>