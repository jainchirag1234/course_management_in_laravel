<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\User;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // 🏫 Display all courses created by logged-in teacher
    public function index()
    {
        $teacherId = Auth::id();
        $courses = Course::where('teacher_id', $teacherId)->get();
        return view('teacher.index', compact('courses'));
    }

    // ➕ Show form to add a new course
    public function create()
    {
        return view('teacher.create');
    }

    // 💾 Store a new course
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
        ]);

        Course::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'duration' => $request->duration,
        ]);

        return redirect()->route('teacher.index')->with('success', 'Course added successfully!');
    }

    // ✏️ Show edit course form
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('teacher.edit', compact('course'));
    }

    // 🔄 Update course details
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
        ]);

        $course = Course::findOrFail($id);
        $course->update($request->only('title', 'description', 'duration'));

        return redirect()->route('teacher.index')->with('success', 'Course updated successfully!');
    }

    // ❌ Delete a course
    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return redirect()->route('teacher.index')->with('success', 'Course deleted successfully!');
    }

    // 👨‍🎓 View students enrolled in a course
    public function students($id)
    {
        $course = Course::with('students')->findOrFail($id);
        return view('teacher.students', compact('course'));
    }

    // 👥 Show list of enrolled students
    public function showStudents($id)
    {
        $course = Course::findOrFail($id);

        $students = Enrollment::where('course_id', $id)
            ->with('student')
            ->get()
            ->pluck('student');

        return view('teacher.course_students', compact('course', 'students'));
    }

    // 🚪 Logout teacher
    public function logout(Request $request)
    {
        // Clear session manually
        $request->session()->forget(['teacher_id', 'teacher_name', 'teacher_email']);

        // Or if using Laravel's Auth
        Auth::logout();

        // Redirect to login page
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
