<div id="mahasiswaModal" class="hidden fixed inset-0 z-40 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-xl font-semibold mb-4">Tambah Mahasiswa</h2>
        <form method="POST" action="{{ route('admin.mahasiswa.store') }}">
            @csrf
            <div class="mb-3">
                <label class="block">Nama</label>
                <input type="text" name="name" required class="w-full rounded-md border-gray-500 focus:border-gray-600 border-1">
            </div>
            <div class="mb-3">
                <label class="block">NIM</label>
                <input type="text" name="nim" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Kelas</label>
                <input type="text" name="class" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Program Studi</label>
                <input type="text" name="study_program" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Jurusan</label>
                <input type="text" name="major" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Gender</label>
                <div class="flex items-center space-x-4 mb-2">
                    <label class="flex items-center">
                        <input type="radio" name="gender" required value="L" class="mr-2">
                        <span>Laki-laki</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="gender" required value="P" class="mr-2">
                        <span>Perempuan</span>
                    </label>
                </div>
            </div>
            <div class="mb-3">
                <label class="block">Tanggal Lahir</label>
                <input type="date" name="birth_date" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('mahasiswaModal').classList.add('hidden')" 
                        class="px-4 py-2 border rounded">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Save</button>
            </div>
        </form>
    </div>
</div>
