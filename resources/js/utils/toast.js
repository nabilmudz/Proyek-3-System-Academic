export function showToast(status = true, title = 'Title', message = 'Message') {
    const titleEl = document.getElementById('toastTitle');
    const modal = document.getElementById('toastModal');

    titleEl.textContent = title;
    document.getElementById('toastMessage').textContent = message;

    titleEl.classList.remove('text-green-500', 'text-red-500');

    if (status === true) {
        titleEl.classList.add('text-green-500');
    } else {
        titleEl.classList.add('text-red-500');
    }

    modal.classList.remove('hidden');
}

export function closeToast() {
    document.getElementById('toastModal').classList.add('hidden');
}
