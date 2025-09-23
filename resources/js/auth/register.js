import { showToast } from "../utils/toast";
import { baseApi } from "../utils/baseApi";
import { sleep } from "../utils/sleep";


document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("registerForm");
    if (!form) return;

    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        console.log("submit prevented ✅");

        const username = document.getElementById("username").value;
        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;
        const password_confirmation = document.getElementById("password_confirmation").value;

        const data = await baseApi("/auth/register", {
            method: "POST",
            body: JSON.stringify({ username, email, password, password_confirmation })
        });

        if (data.success) {
            showToast(true, "Sukses", data.message);
            await sleep(1500);
            window.location.href = "/auth/login";
        } else {
            showToast(false, "Gagal", data.message);
        }

    });
});
