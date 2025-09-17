<div id="detailCourseModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6" style="width: 500px; max-height: 80vh; overflow-y: auto;">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Detail Course</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="space-y-3">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Course Code</p>
                    <p class="font-semibold" id="detailCode">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Course Name</p>
                    <p class="font-semibold" id="detailName">-</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Credits</p>
                    <p class="font-semibold" id="detailCredits">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Semester</p>
                    <p class="font-semibold" id="detailSemester">-</p>
                </div>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Major</p>
                <p class="font-semibold" id="detailMajor">-</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Description</p>
                <p class="font-semibold" id="detailDescription">-</p>
            </div>
        </div>

        <div class="mt-6 flex justify-end gap-2">
            <button onclick="closeDetailModal()" 
                    class="text-white px-4 py-2 border rounded hover:bg-orange-600 bg-orange-400">
                Close
            </button>
        </div>
    </div>
</div>

<script>
function closeDetailModal() {
    document.getElementById('detailCourseModal').classList.add('hidden');
}

function showDetailModal(code) {
    const tambahModal = document.getElementById('courseModal');
    const editModal = document.getElementById('editCourseModal');
    const deleteModal = document.getElementById('deleteCourseModal');
    
    if (tambahModal) tambahModal.classList.add('hidden');
    if (editModal) editModal.classList.add('hidden');
    if (deleteModal) deleteModal.classList.add('hidden');
    
    const detailModal = document.getElementById('detailCourseModal');
    if (detailModal) {
        fetch(`/admin/course/data/${code}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailCode').textContent = data.code || '-';
                document.getElementById('detailName').textContent = data.name || '-';
                document.getElementById('detailCredits').textContent = data.credits || '-';
                document.getElementById('detailSemester').textContent = data.semester || '-';
                document.getElementById('detailMajor').textContent = data.major || '-';
                document.getElementById('detailDescription').textContent = data.description || '-';
                
                detailModal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching course data:', error);
                alert('Error loading course details');
            });
    }
}

window.showDetailModal = showDetailModal;
</script>
