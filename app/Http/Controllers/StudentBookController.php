<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; // Model Course

class StudentBookController extends Controller
{
    public function index()
    {
        // Ambil semua courses
        $courses = Course::latest()->get();
        return view('student.courses.index', compact('courses'));
    }
}