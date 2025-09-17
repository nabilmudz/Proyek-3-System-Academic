<div id="deleteCourseModal" 
     class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6" style="width: 400px;">
        <h2 class="text-xl font-semibold mb-4">Hapus Course</h2>
        <p class="mb-4">Apakah anda yakin ingin menghapus course ini? Aksi ini tidak dapat dibatalkan.</p>
        <div class="mb-4 p-3 bg-gray-100 rounded">
            <p><strong>Code:</strong> <span id="deleteCode"></span></p>
            <p><strong>Name:</strong> <span id="deleteName"></span></p>
        </div>
        
        <form id="deleteCourseForm" method="POST">
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
    document.getElementById('deleteCourseModal').classList.add('hidden');
}

function showDeleteModal(code, name) {
    const tambahModal = document.getElementById('courseModal');
    const editModal = document.getElementById('editCourseModal');
    
    if (tambahModal) tambahModal.classList.add('hidden');
    if (editModal) editModal.classList.add('hidden');
    
    const deleteModal = document.getElementById('deleteCourseModal');
    if (deleteModal) {
        document.getElementById('deleteCourseForm').action = `/admin/course/${code}`;
        document.getElementById('deleteCode').textContent = code;
        document.getElementById('deleteName').textContent = name;
        
        deleteModal.classList.remove('hidden');
    }
}

window.showDeleteModal = showDeleteModal;
</script>
