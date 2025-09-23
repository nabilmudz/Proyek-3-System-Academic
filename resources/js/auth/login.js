import { baseApi } from "../utils/baseApi";
import { showToast } from "../utils/toast";
import { sleep } from "../utils/sleep";

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("loginForm");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        const data = await baseApi("/auth/login", {
            method: "POST",
            body: JSON.stringify({ email, password })
        });
        localStorage.setItem('token', data.data.token);

        if (data.success) {
            showToast(data.success, 'Sukses', data.message);
            await sleep(1500);
            if (data.data.role === "admin") {
                window.location.href = "/admin";
            } else {
                window.location.href = "/mahasiswa";
            }
        } else {
            showToast(data.success, 'Gagal', data.message);
        }
    });
});