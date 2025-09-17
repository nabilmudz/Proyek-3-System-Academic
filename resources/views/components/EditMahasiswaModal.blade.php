<div id="editMahasiswaModal" 
     class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6" style="width: 500px; min-height: 400px;">
        <h2 class="text-xl font-semibold mb-4">Edit Mahasiswa</h2>
        <form method="POST" id="editForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block">NIM</label>
                <input type="text" name="nim" id="editNim" disabled class="w-full border px-3 py-2 rounded bg-gray-300">
            </div>
            <div class="mb-3">
                <label class="block">Email</label>
                <input type="text" name="nim" id="editEmail" disabled class="w-full border px-3 py-2 rounded bg-gray-300">
            </div>
            <div class="mb-3">
                <label class="block">Nama</label>
                <input type="text" name="name" id="editName" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Kelas</label>
                <input type="text" name="class" id="editClass" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Program Studi</label>
                <input type="text" name="study_program" id="editStudyProgram" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Jurusan</label>
                <input type="text" name="major" id="editMajor" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Gender</label>
                <select name="gender" id="editGender" class="w-full border px-3 py-2 rounded">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="block">Tanggal Lahir</label>
                <input type="date" name="birth_date" id="editBirthDate" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal()" 
                        class="px-4 py-2 border rounded">Cancel</button>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Update</button>
            </div>
        </form>
    </div>
</div>

<script>
function closeEditModal() {
    document.getElementById('editMahasiswaModal').classList.add('hidden');
}

function showEditModal(nim) {
    const tambahModal = document.getElementById('mahasiswaModal');
    if (tambahModal) {
        tambahModal.classList.add('hidden');
    }
    
    const editModal = document.getElementById('editMahasiswaModal');
    if (editModal) {
        editModal.classList.remove('hidden');
        
        if (nim) {
            fetch(`/admin/mahasiswa/data/${nim}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('editNim').value = data.nim || '';
                    document.getElementById('editEmail').value = (data.user && data.user.email) ? data.user.email : '';
                    document.getElementById('editName').value = data.name || '';
                    document.getElementById('editClass').value = data.class || '';
                    document.getElementById('editStudyProgram').value = data.study_program || '';
                    document.getElementById('editMajor').value = data.major || '';
                    document.getElementById('editGender').value = data.gender || 'L';
                    document.getElementById('editBirthDate').value = data.birth_date || '';
                    
                    document.getElementById('editForm').action = `/admin/mahasiswa/${nim}`;
                    
                })
                .catch(error => {
                    alert('Error loading student data. Please try again.');
                });
        }
    }
}

// Make function globally available
window.showEditModal = showEditModal;
</script>
