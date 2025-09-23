@extends('layouts.mahasiswa')

@section('title', 'Mahasiswa')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-8">Courses</h1> 
    <div class="mb-10">
        <h3 class="font-semibold text-lg mb-2 mt-8">My Enrollments</h3>
        <table id="myEnrollments" class="min-w-full border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Course Code</th>
                    <th class="border px-4 py-2">Course Name</th>
                    <th class="border px-4 py-2">Enroll Date</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <h3 class="font-semibold text-lg mb-2 mt-8">Other Enrollments</h3>
    <div class="flex flex-wrap gap-10 w-full">
        <table id="otherCourses" class="border w-full table-auto mb-3">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">No</th>
                    <th class="px-4 py-2 border">Kode</th>
                    <th class="px-4 py-2 border">Nama Mata Kuliah</th>
                    <th class="px-4 py-2 border">Deskripsi</th>
                    <th class="px-4 py-2 border">Jumlah SKS</th>
                    <th class="px-4 py-2 border">Semester</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
    <button onclick="enroll()" 
        class="bg-orange-400 hover:bg-orange-600 text-md font-light text-white px-5 py-1 rounded-md items-center w-30 mb-2 hover:cursor-pointer">
        Tambah
    </button>
</div>
@endsection
@push('scripts')
    @vite('resources/js/mahasiswa/course.js')
    <script>
    document.addEventListener("DOMContentLoaded", () => {
        showMyCourse();
        showAllCourse();
    });
    </script>