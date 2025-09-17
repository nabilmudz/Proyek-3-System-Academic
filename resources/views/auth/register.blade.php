<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">      
    <title>Register</title>
    @vite('resources/css/app.css')
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="flex flex-col items-center bg-white shadow border-r-2 p-10 rounded-md" >
        <img src="{{ asset('images/logo-polban.png') }}" alt="Logo Polban" class="w-32 mb-8">
        <h1 class="text-4xl mb-8 font-medium">Register</h1>
        <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="flex flex-col">
                <label for="username">Username</label>
                <input name="username" required type="text" placeholder="Username" class="w-80 rounded-xl border-[#FB9503] focus:border-[#1304E3] border-2 mb-3">
            </div>
            <div class="flex flex-col">
                <label for="email">Email</label>
                <input name="email" required type="email" placeholder="user@example.com" class="w-80 rounded-xl border-[#FB9503] focus:border-[#1304E3] border-2 mb-3">
            </div>
            <div class="flex flex-col">
                <label for="password">Password</label>
                <input name="password" required type="password" placeholder="Password" class="w-80 rounded-xl border-[#FB9503] focus:border-[#1304E3] border-2 mb-3">
            </div>
            <div class="flex flex-col">
                <label for="password_confirmation">Confirm Password</label>
                <input name="password_confirmation" required type="password" placeholder="Confirm Password" class="w-80 rounded-xl border-[#FB9503] focus:border-[#1304E3] border-2 mb-8">
            </div>
            <button class="bg-[#1304E3] hover:bg-[#0f03b7] text-white font-semibold px-4 py-2 rounded-xl items-center w-80 mb-2">Register</button>
        </form>
        <p class="text-xs">
            Already have an account?
            <a href="{{ route('login') }}" class="text-xs text-blue-700 underline">Login</a>
        </p>
    </div>
</body>
</html>
