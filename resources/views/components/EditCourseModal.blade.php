<div id="editCourseModal" 
     class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6" style="width: 500px; min-height: 400px;">
        <h2 class="text-xl font-semibold mb-4">Edit Course</h2>
        <form method="POST" id="editCourseForm">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block">Course Code</label>
                <input type="text" name="code" id="editCode" disabled class="w-full border px-3 py-2 rounded bg-gray-300">
            </div>
            <div class="mb-3">
                <label class="block">Course Name</label>
                <input type="text" name="name" id="editName" required class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Description</label>
                <textarea name="description" id="editDescription" class="w-full border px-3 py-2 rounded" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label class="block">Credits</label>
                <input type="number" name="credits" id="editCredits" required min="1" max="6" class="w-full border px-3 py-2 rounded">
            </div>
            <div class="mb-3">
                <label class="block">Semester</label>
                <select name="semester" id="editSemester" required class="w-full border px-3 py-2 rounded">
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
                <label class="block">Major</label>
                <input type="text" name="major" id="editMajor" required class="w-full border px-3 py-2 rounded">
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
    document.getElementById('editCourseModal').classList.add('hidden');
}

function showEditModal(code) {
    console.log('showEditModal called with code:', code);
    
    const tambahModal = document.getElementById('courseModal');
    if (tambahModal) {
        tambahModal.classList.add('hidden');
    }
    
    const editModal = document.getElementById('editCourseModal');
    if (editModal) {
        editModal.classList.remove('hidden');
        
        if (code) {
            fetch(`/admin/course/data/${code}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editCode').value = data.code || '';
                    document.getElementById('editName').value = data.name || '';
                    document.getElementById('editDescription').value = data.description || '';
                    document.getElementById('editCredits').value = data.credits || '';
                    document.getElementById('editSemester').value = data.semester || '';
                    document.getElementById('editMajor').value = data.major || '';
                    document.getElementById('editCourseForm').action = `/admin/course/${code}`;
                })
                .catch(error => {
                    console.error('Error fetching course data:', error);
                    alert('Error loading course data');
                });
        }
    }
}

window.showEditModal = showEditModal;
</script>
