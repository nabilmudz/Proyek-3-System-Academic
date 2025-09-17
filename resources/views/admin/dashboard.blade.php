@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="p-6 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-8">Welcome {{ auth()->user()->username }}</h1> 
        <div class="flex gap-10">
            <div>
                <div class="bg-white rounded-lg shadow p-6 w-60 border-2">
                    <p class="font-semibold text-lg mb-3">Total Mahasiswa</p>
                    <h1 class="text-2xl font-semibold"> {{ $mahasiswaCount }}</h1>
                </div>
            </div>
            <div>
                <div class="bg-white rounded-lg shadow p-6 w-60 border-2">
                    <p class="font-semibold text-lg mb-3">Total Course</p>
                    <h1 class="text-2xl font-semibold"> {{ $courseCount }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
