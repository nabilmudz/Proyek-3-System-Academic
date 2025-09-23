@extends('layouts.mahasiswa')

@section('title', 'Mahasiswa')

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Welcome <span id="welcome_name"></span></h1> 
        <div class="bg-white rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Detail Mahasiswa</h2>
            </div>
            
            <div class="space-y-3">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">NIM</p>
                        <p class="font-semibold" id="nim"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold" id="name"></p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Class</p>
                        <p class="font-semibold" id="class"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Gender</p>
                        <p class="font-semibold" id="gender"></p>
                    </div>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Study Program</p>
                    <p class="font-semibold" id="study_program"></p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Major</p>
                    <p class="font-semibold" id="major"></p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Birth Date</p>
                    <p class="font-semibold" id="birth_date"></p>
                </div>
            </div>
            <hr class="my-4">

            <div>
                <h3 class="font-semibold text-lg mb-2">User Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold" id="email"></p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Username</p>
                        <p class="font-semibold" id="username"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>

        async function getMe(){
            try {
                const res = await fetch('/student/me');
                const result = await res.json();

                if(result.success){
                    const data = result.data;

                    document.getElementById("welcome_name").textContent = data.name;
                    document.getElementById("nim").textContent = data.nim;
                    document.getElementById("name").textContent = data.name;
                    document.getElementById("class").textContent = data.class;
                    document.getElementById("gender").textContent = data.gender;
                    document.getElementById("study_program").textContent = data.study_program;
                    document.getElementById("major").textContent = data.major;
                    document.getElementById("birth_date").textContent = data.birth_date;

                    document.getElementById("email").textContent = data.user.email;
                    document.getElementById("username").textContent = data.user.username;
                } else {
                    showToast(false, "Gagal", "Gagal mendapatkan mahasiswa!");
                }
            } catch (error) {
                console.log("Error Get: ",error);
                showToast(false, "Gagal", "Terjadi error saat mengambil data!");
            }
        }

        getMe();
</script>

@endsection