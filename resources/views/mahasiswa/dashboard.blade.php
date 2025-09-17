@extends('layouts.mahasiswa')

@section('title', 'Mahasiswa')

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6">Welcome {{ auth()->user()->username }}</h1> 
        <div class="bg-white rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Detail Mahasiswa</h2>
            </div>
            
            <div class="space-y-3">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">NIM</p>
                        <p class="font-semibold">{{ $mahasiswa->nim }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p class="font-semibold">{{ $mahasiswa->name }}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Class</p>
                        <p class="font-semibold">{{ $mahasiswa->class }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Gender</p>
                        <p class="font-semibold">{{ $mahasiswa->gender }}</p>
                    </div>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Study Program</p>
                    <p class="font-semibold">{{ $mahasiswa->study_program }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Major</p>
                    <p class="font-semibold">{{ $mahasiswa->major }}</p>
                </div>
                
                <div>
                    <p class="text-sm text-gray-600">Birth Date</p>
                    <p class="font-semibold">{{ $mahasiswa->birth_date }}</p>
                </div>
            </div>
            <hr class="my-4">
            
            <div>
                <h3 class="font-semibold text-lg mb-2">User Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold">{{ $me->email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Username</p>
                        <p class="font-semibold">{{ $me->username }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection