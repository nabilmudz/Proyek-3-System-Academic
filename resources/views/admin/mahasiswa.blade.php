@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="p-6 bg-white rounded shadow h-full">
        <h1 class="text-2xl font-bold mb-6">Mahasiswa</h1>
        <div class="flex justify-between mb-4">
            <button onclick="console.log('Tambah clicked'); document.getElementById('mahasiswaModal').classList.remove('hidden');" 
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
                    <th class="px-4 py-2 border">NIM</th>
                    <th class="px-4 py-2 border">Nama</th>
                    <th class="px-4 py-2 border">Kelas</th>
                    <th class="px-4 py-2 border">Jurusan</th>
                    <th class="px-4 py-2 border">Program Studi</th>
                    <th class="px-4 py-2 border">Gender</th>
                    <th class="px-4 py-2 border">Tanggal Lahir</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mahasiswas as $mahasiswa)
                    <tr>
                        <td class="px-4 py-2 border">{{ $mahasiswa->nim }}</td>
                        <td class="px-4 py-2 border">{{ $mahasiswa->name }}</td>
                        <td class="px-4 py-2 border">{{ $mahasiswa->class }}</td>
                        <td class="px-4 py-2 border">{{ $mahasiswa->major }}</td>
                        <td class="px-4 py-2 border">{{ $mahasiswa->study_program }}</td>
                        <td class="px-4 py-2 border">{{ $mahasiswa->gender }}</td>
                        <td class="px-4 py-2 border">{{ $mahasiswa->birth_date }}</td>
                        <td class="border flex justify-center">
                            <div class="flex gap-3 p-2">
                                <button type="button" 
                                    onclick="showDetailModal('{{ $mahasiswa->nim }}')"
                                    class="flex items-center justify-center w-5 h-5 rounded-md hover:bg-green-100">
                                    <i class="fa-solid fa-eye text-[#00ae00]"></i>
                                </button>
                                <button type="button" 
                                    onclick="showEditModal('{{ $mahasiswa->nim }}')"
                                    class="flex items-center justify-center w-5 h-5 rounded-md">
                                    <i class="fa-solid fa-pen text-[#e2c000]"></i>
                                </button>
                                <button type="button" 
                                    onclick="showDeleteModal('{{ $mahasiswa->nim }}', '{{ $mahasiswa->name }}')"
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
    @include('components.DetailMahasiswaModal')
    @include('components.TambahMahasiswaModal')
    @include('components.EditMahasiswaModal')
    @include('components.DeleteMahasiswaModal')

@endsection
