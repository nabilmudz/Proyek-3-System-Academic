import { baseApi } from "../utils/baseApi";
export async function showMyCourse() {
    try {
        const data = await baseApi('/enrollment/get-course');
        if(!data.success || data.data.length === 0) return;

        const enrollmentsTable = document.querySelector('#myEnrollments tbody');

        enrollmentsTable.innerHTML = '';
        const enrollments = data.data;
        
        enrollments.forEach((enroll, idx) => {
            enrollmentsTable.innerHTML += `
                <tr>
                    <td class="border px-4 py-2">${idx+1}</td>
                    <td class="border px-4 py-2">${enroll.course.code}</td>
                    <td class="border px-4 py-2">${enroll.course.name}</td>
                    <td class="border px-4 py-2">${enroll.enroll_date}</td>
                </tr>
            `;
        });
    } catch (err) {
        console.error("Enrollment error: ",err)
        showToast(false, "Gagal", "Gagal mendapatkan enrollments!")
    }
}

function updateTotalSks() {
    const checked = document.querySelectorAll('#otherCourses .form-checkbox:checked');
    let total = 0;

    checked.forEach(cb => {
        total += parseInt(cb.dataset.credits || 0);
    });

    document.getElementById('totalSks').textContent = total;
}

async function showAllCourse() {
    try {
        const data = await baseApi('/courses/show-all');
        if (!data.success) return;

        const coursesTable = document.querySelector('#otherCourses tbody');
        coursesTable.innerHTML = '';

        const courses = data.data;

        courses.forEach((course, idx) => {
            coursesTable.innerHTML += `
                <tr>
                    <td class="border px-4 py-2">${idx + 1}</td>
                    <td class="border px-4 py-2">${course.code}</td>
                    <td class="border px-4 py-2">${course.name}</td>
                    <td class="border px-4 py-2">${course.description}</td>
                    <td class="border px-4 py-2">${course.credits}</td>
                    <td class="border px-4 py-2">${course.semester}</td>
                    <td class="border px-4 py-2 text-center">
                        <input type="checkbox" class="form-checkbox" value="${course.id}" data-credits="${course.credits}">
                    </td>
                </tr>
            `;
        });

        coursesTable.innerHTML += `
            <tr id="totalRow" class="font-semibold">
                <td colspan="2" class="px-4 py-2 text-right align-middle">Total SKS: <span id="totalSks">0</span></td>
            </tr>
        `;


        document.querySelectorAll('#otherCourses .form-checkbox').forEach(cb => {
            cb.addEventListener('change', updateTotalSks);
        });

    } catch (err) {
        console.error('Load courses error:', err);
    }
}

async function enroll() {
    const checkedValues = Array.from(document.querySelectorAll('#otherCourses .form-checkbox:checked'))
        .map(el => el.value);

    if (!checkedValues.length) return alert('Select at least one course.');

    try {
        const data = await baseApi('/enrollment/create', {
            method: 'POST',
            body: JSON.stringify({ course_ids: checkedValues })
        });

        if (data.success) showToast(true, "Sukses", data.message);
        else showToast(false, "Gagal", data.message);

        showMyCourse();
        showAllCourse();
    } catch (err) {
        console.error('Enroll error:', err);
    }
}

window.showMyCourse = showMyCourse;
window.showAllCourse = showAllCourse;
window.enroll = enroll;