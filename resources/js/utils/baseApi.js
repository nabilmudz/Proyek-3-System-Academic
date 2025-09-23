export async function baseApi(url, { method = 'GET', body, headers = {}, ...rest } = {}) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const defaultHeaders = {
        'X-CSRF-TOKEN': token,
        ...(body ? { 'Content-Type': 'application/json' } : {})
    };

    const response = await fetch(url, {
        method,
        headers: { ...defaultHeaders, ...headers },
        body: body ? (typeof body === 'string' ? body : JSON.stringify(body)) : undefined,
        credentials: 'same-origin',
        ...rest
    });

    if (!response.ok) {
        throw new Error(`HTTP error! Status: ${response.status}`);
    }

    return response.json();
}

