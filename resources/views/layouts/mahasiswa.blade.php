<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mahasiswa')</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @vite('resources/css/app.css')
</head>
<body class="flex">
    <aside class="w-56 h-screen bg-gray-800 text-white px-4 py-6">
        <div class="flex h-full flex-col">
            <div class="flex items-center justify-center gap-2 mb-6">
                <img src="{{ asset('images/logo-polban.png') }}" alt="Logo Polban" class="w-8">
                <h2 class="text-xl font-bold">Mahasiswa</h2>
            </div>
            <ul class="flex flex-col flex-1">
                <li class="mb-2">   
                    <a 
                        href="{{ route('mahasiswa.dashboard') }}"
                        class="flex items-center gap-2 w-48 px-3 py-2 rounded 
                            hover:text-[#FB9503]
                            {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-gray-700 text-orange-400' : '' }}">
                        <i class="fa-solid fa-home text-sm"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="mb-2">
                    <a 
                        href="{{ route('mahasiswa.course') }}"
                        class="flex items-center gap-2 w-48   px-3 py-2 rounded 
                            hover:text-[#FB9503]
                            focus:bg-gray-500 
                            {{ request()->routeIs('mahasiswa.course') ? 'bg-gray-700 text-orange-400' : '' }}">
                        <i class="fa-solid fa-book text-sm"></i>
                        <span>Courses</span>
                    </a>
                </li>
                <li class="mt-auto">
                    <a 
                        href="{{ route('logout') }}"
                        class="flex items-center gap-2 w-48   px-3 py-2 rounded 
                            hover:text-[#FB9503]
                            focus:bg-gray-500 
                            {{ request()->routeIs('mahasiswa.course') ? 'bg-gray-700 text-orange-400' : '' }}">
                        <i class="fa-solid fa-right-from-bracket text-sm text-[#d22424]"></i>
                        <span class="text-[#d22424]">Sign Out</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <main class="flex-1 p-10 bg-gray-100">
        @yield('content')
    </main>
</body>
</html>
