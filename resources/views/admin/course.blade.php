@extends('layouts.admin')

@section('title', 'Course Management')

@section('content')
    <div class="p-6 bg-white rounded shadow h-full">
        <h1 class="text-2xl font-bold mb-6">Course Management</h1>
        <div class="flex justify-between mb-4">
            <button onclick="document.getElementById('courseModal').classList.remove('hidden')" 
                    class="bg-orange-400 hover:bg-orange-600 text-md font-light text-white px-5 py-1 rounded-md items-center w-30 mb-2 hover:cursor-pointer">
                <a class="text-md font-light text-white px-5 py-2 rounded-md items-center w-30 hover:cursor-pointer">Tambah</a>    
            </button>
            <!-- <form action="" method="get">
                <input type="text" class="w-60 h-9 mb-2 rounded-md">
                <a class="text-md font-light bg-orange-400 hover:bg-orange-600 text-white px-5 py-2 rounded-md items-center w-30 mb-4 hover:cursor-pointer">Cari</a>    
            </form> -->
        </div>
        <table class="table-auto w-full border text-sm">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Code</th>
                    <th class="px-4 py-2 border">Name</th>
                    <th class="px-4 py-2 border">Credits</th>
                    <th class="px-4 py-2 border">Semester</th>
                    <th class="px-4 py-2 border">Major</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                    <tr>
                        <td class="px-4 py-2 border">{{ $course->code }}</td>
                        <td class="px-4 py-2 border">{{ $course->name }}</td>
                        <td class="px-4 py-2 border">{{ $course->credits }}</td>
                        <td class="px-4 py-2 border">{{ $course->semester }}</td>
                        <td class="px-4 py-2 border">{{ $course->major }}</td>
                        <td class="border flex justify-center">
                            <div class="flex gap-3 py-2">
                                <button type="button" 
                                    onclick="showDetailModal('{{ $course->code }}')"
                                    class="flex items-center justify-center w-5 h-5 rounded-md hover:bg-green-100">
                                    <i class="fa-solid fa-eye text-[#00ae00]"></i>
                                </button>
                                <button type="button" 
                                    onclick="showEditModal('{{ $course->code }}')"
                                    class="flex items-center justify-center w-5 h-5 rounded-md">
                                    <i class="fa-solid fa-pen text-[#e2c000]"></i>
                                </button>
                                <button type="button" 
                                    onclick="showDeleteModal('{{ $course->code }}', '{{ $course->name }}')"
                                    class="flex items-center justify-center w-5 h-5 rounded-md hover:bg-red-100">
                                    <i class="fa-solid fa-trash text-[#cf0000]"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Include Modal Components -->
    @include('components.TambahCourseModal')
    @include('components.EditCourseModal')
    @include('components.DeleteCourseModal')
    @include('components.DetailCourseModal')

@endsection