<div id="toastModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-40 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg w-96 p-6 text-center">
        <h2 id="toastTitle" class="text-xl font-bold mb-4">{{ $title ?? 'Title' }}</h2>
        <p id="toastMessage" class="mb-6">{{ $message ?? 'Message' }}</p>
        <button onclick="closeToast()" class="bg-orange-500 hover:bg-orange-700 text-white px-6 py-2 rounded">
            OK
        </button>
    </div>
</div>