<div id="detailMahasiswaModal" class="hidden fixed inset-0 z-50 bg-black bg-opacity-50 flex items-center justify-center">
    <div class="bg-white rounded-lg shadow-lg p-6" style="width: 500px; max-height: 80vh; overflow-y: auto;">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Detail Mahasiswa</h2>
            <button onclick="closeDetailModal()" class="text-gray-500 hover:text-gray-700">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        
        <div class="space-y-3">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">NIM</p>
                    <p class="font-semibold" id="detailNim">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Name</p>
                    <p class="font-semibold" id="detailName">-</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <p class="text-sm text-gray-600">Class</p>
                    <p class="font-semibold" id="detailClass">-</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Gender</p>
                    <p class="font-semibold" id="detailGender">-</p>
                </div>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Study Program</p>
                <p class="font-semibold" id="detailStudyProgram">-</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Major</p>
                <p class="font-semibold" id="detailMajor">-</p>
            </div>
            
            <div>
                <p class="text-sm text-gray-600">Birth Date</p>
                <p class="font-semibold" id="detailBirthDate">-</p>
            </div>
            
            <hr class="my-4">
            
            <div>
                <h3 class="font-semibold text-lg mb-2">User Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="font-semibold" id="detailEmail">-</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Username</p>
                        <p class="font-semibold" id="detailUsername">-</p>
                    </div>
                </div>
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
    document.getElementById('detailMahasiswaModal').classList.add('hidden');
}

function showDetailModal(nim) {
    const tambahModal = document.getElementById('mahasiswaModal');
    const editModal = document.getElementById('editMahasiswaModal');
    const deleteModal = document.getElementById('deleteMahasiswaModal');
    
    if (tambahModal) tambahModal.classList.add('hidden');
    if (editModal) editModal.classList.add('hidden');
    if (deleteModal) deleteModal.classList.add('hidden');
    
    const detailModal = document.getElementById('detailMahasiswaModal');
    if (detailModal) {
        fetch(`/admin/mahasiswa/data/${nim}`)
            .then(response => response.json())
            .then(data => {
                document.getElementById('detailNim').textContent = data.nim || '-';
                document.getElementById('detailName').textContent = data.name || '-';
                document.getElementById('detailClass').textContent = data.class || '-';
                document.getElementById('detailStudyProgram').textContent = data.study_program || '-';
                document.getElementById('detailMajor').textContent = data.major || '-';
                document.getElementById('detailGender').textContent = data.gender || '-';
                document.getElementById('detailBirthDate').textContent = data.birth_date || '-';
                
                if (data.user) {
                    document.getElementById('detailEmail').textContent = data.user.email || '-';
                    document.getElementById('detailUsername').textContent = data.user.username || '-';
                }
                
                detailModal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching student data:', error);
                alert('Error loading student details');
            });
    }
}

window.showDetailModal = showDetailModal;
</script>