document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const csrf = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const res = await fetch("/auth/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": csrf
            },
            credentials: "same-origin",
            body: JSON.stringify({ email, password })
        });

        const data = await res.json();

        if (res.ok) {
            if (data && data.role) {
                if (data.role === "admin") {
                    window.location.href = "/admin";
                } else {
                    window.location.href = "/mahasiswa";
                }
            } else {
                window.location.href = "/";
            }
        } else {
            alert(data.message || "Login failed");
        }
    });
});