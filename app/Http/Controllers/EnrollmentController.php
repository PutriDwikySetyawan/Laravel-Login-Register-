<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnrollmentController extends Controller
{
    /**
     * Tampilkan daftar enrollment.
     */
    public function index()
    {
        $enrollments = Enrollment::with(['user', 'course'])->orderBy('enrolled_at', 'desc')->paginate(12);

        return view('enrollments.index', compact('enrollments'));
    }

    /**
     * Form tambah enrollment baru.
     */
    public function create(Request $request)
    {
        $courseId = $request->query('course_id');
        $course = Course::find($courseId);

        return view('enrollments.create', compact('course'));
    }

    /**
     * Simpan enrollment baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'course_id' => 'required|exists:courses,id',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['enrolled_at'] = now();
        $validated['status'] = 'enrolled';

        Enrollment::create($validated);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment berhasil ditambahkan!');
    }

    /**
     * Form edit enrollment.
     */
    public function edit(Enrollment $enrollment)
    {
        return view('enrollments.edit', compact('enrollment'));
    }

    /**
     * Update data enrollment.
     */
    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'status' => 'required|in:enrolled,completed',
            'completed_at' => 'nullable|date',
        ]);

        $enrollment->update($validated);

        return redirect()->route('enrollments.index')->with('success', 'Enrollment berhasil diupdate!');
    }

    /**
     * Hapus enrollment.
     */
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return back()->with('success', 'Enrollment berhasil dihapus.');
    }

    /**
     * Riwayat enrollment siswa.
     */
    public function history()
    {
        $enrollments = Enrollment::where('user_id', Auth::id())->with('course')->orderBy('enrolled_at', 'desc')->get();

        return view('enrollments.history', compact('enrollments'));
    }
}
