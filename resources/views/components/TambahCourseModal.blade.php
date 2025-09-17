<div id="courseModal" class="hidden fixed inset-0 z-40 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6 w-1/3">
        <h2 class="text-xl font-semibold mb-4">Tambah Course</h2>
        <form method="POST" action="{{ route('admin.course.store') }}">
            @csrf
            <div class="mb-3">
                <label class="block">Kode Mata Kuliah</label>
                <input type="text" name="code" required class="w-full border px-3 py-2 rounded" placeholder="JTK001">
            </div>
            <div class="mb-3">
                <label class="block">Nama Mata Kuliah</label>
                <input type="text" name="name" required class="w-full border px-3 py-2 rounded" placeholder="Pemrograman Dasar">
            </div>
            <div class="mb-3">
                <label class="block">Deskripsi</label>
                <textarea name="description" class="w-full border px-3 py-2 rounded" rows="3" placeholder="Deskripsi"></textarea>
            </div>
            <div class="mb-3">
                <label class="block">SKS</label>
                <input type="number" name="credits" required min="1" max="6" class="w-full border px-3 py-2 rounded" placeholder="1-6">
            </div>
            <div class="mb-3">
                <label class="block">Semester</label>
                <select name="semester" required class="w-full border px-3 py-2 rounded">
                    <option value="">Pilih Semester</option>
                    <option value="1">Semester 1</option>
                    <option value="2">Semester 2</option>
                    <option value="3">Semester 3</option>
                    <option value="4">Semester 4</option>
                    <option value="5">Semester 5</option>
                    <option value="6">Semester 6</option>
                    <option value="7">Semester 7</option>
                    <option value="8">Semester 8</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block">Jurusan</label>
                <input type="text" name="major" required class="w-full border px-3 py-2 rounded" placeholder="Teknik Informatika">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="document.getElementById('courseModal').classList.add('hidden')" 
                        class="px-4 py-2 border rounded">Batal</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Tambah</button>
            </div>
        </form>
    </div>
</div>
