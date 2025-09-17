@extends('layouts.mahasiswa')

@section('title', 'Mahasiswa')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h1 class="text-2xl font-bold mb-8">Courses</h1> 
    <div class="mb-10">
        <h3 class="font-semibold text-lg mb-2 mt-8">My Enrollments</h3>
        @if($enrollments->count())
        <table class="min-w-full border border-gray-300 rounded">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Course Code</th>
                    <th class="border px-4 py-2">Course Name</th>
                    <th class="border px-4 py-2">Enroll Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($enrollments as $index => $enroll)
                <tr>
                    <td class="border px-4 py-2">{{ $index + 1 }}</td>
                    <td class="border px-4 py-2">{{ $enroll->course->name ?? '-'}}</td>
                    <td class="border px-4 py-2">{{ $enroll->course->name ?? '-'}}</td>
                    <td class="border px-4 py-2">{{ $enroll->enroll_date ?? '-'}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p class="text-gray-600">You have not enrolled in any courses yet.</p>
        @endif
    </div>
    <h3 class="font-semibold text-lg mb-2 mt-8">Other Enrollments</h3>
    <div class="flex flex-wrap gap-10">
    @foreach ($courses as $course)
        <div class="w-60 rounded-lg shadow border-2 p-4 flex flex-col justify-between h-40">
            <p>{{ $course->name }}</p>
            <button type="submit" onclick="enroll('{{ $course->id }}')"
                    class="px-3 py-1 bg-orange-500 text-white rounded hover:bg-orange-700">
                Enroll
            </button>
        </div>
    @endforeach
    </div>
</div>
    
<script>
    function enroll(courseId) {
        fetch(`/api/enroll/create`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ 
                me: '{{ auth()->id() }}',
                course_id: courseId
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                alert('Enrolled successfully!');
            } else {
                alert('Failed to enroll: ' + data.message);
            }
        })
        .catch(err => console.error('Enroll error:', err));
    }
</script>
@endsection