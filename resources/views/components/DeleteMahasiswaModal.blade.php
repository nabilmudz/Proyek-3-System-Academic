<div id="deleteMahasiswaModal" 
     class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6" style="width: 400px;">
        <h2 class="text-xl font-semibold mb-4">Hapus Mahasiswa</h2>
        <p class="mb-4">Apakah anda yakin ingin menghapus mahasiswa ini? Aksi ini tidak dapat dibatalkan.</p>
        <div class="mb-4 p-3 bg-gray-100 rounded">
            <p><strong>NIM:</strong> <span id="deleteNim"></span></p>
            <p><strong>Name:</strong> <span id="deleteName"></span></p>
        </div>
        
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeDeleteModal()" 
                        class="px-4 py-2 border rounded hover:bg-gray-100">Cancel</button>
                <button type="submit" 
                        class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Delete</button>
            </div>
        </form>
    </div>
</div>

<script>
    function closeDeleteModal() {
        document.getElementById('deleteMahasiswaModal').classList.add('hidden');
    }

    function showDeleteModal(nim, name) {
        const tambahModal = document.getElementById('mahasiswaModal');
        const editModal = document.getElementById('editMahasiswaModal');
        
        if (tambahModal) tambahModal.classList.add('hidden');
        if (editModal) editModal.classList.add('hidden');
        
        const deleteModal = document.getElementById('deleteMahasiswaModal');
        if (deleteModal) {
            document.getElementById('deleteForm').action = `/admin/mahasiswa/${nim}`;
            document.getElementById('deleteNim').textContent = nim;
            document.getElementById('deleteName').textContent = name;
            
            deleteModal.classList.remove('hidden');
        }
    }

    window.showDeleteModal = showDeleteModal;
</script>
