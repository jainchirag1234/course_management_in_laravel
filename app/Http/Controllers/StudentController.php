<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Enrollment;

class StudentController extends Controller
{
    // 🧍‍♂️ Show registration form
    public function showRegisterForm()
    {
        return view('student.register');
    }

    // 📝 Register a new student
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // plain text (not hashed)
            'role' => 'student'
        ]);

        // Manually store user session
        $request->session()->put('student_id', $user->id);
        $request->session()->put('student_name', $user->name);
        $request->session()->put('student_email', $user->email);

        // 👇 Redirect to /login route
        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }

    // 🔑 Show dashboard
    public function index()
    {
        return view('student.dashboard');
    }

    // 🏠 Dashboard
    public function dashboard(Request $request)
    {
        if (!$request->session()->has('student_id')) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        // Get logged-in student info
        $student = (object) [
            'id' => $request->session()->get('student_id'),
            'name' => $request->session()->get('student_name'),
            'email' => $request->session()->get('student_email')
        ];

        // Fetch all available courses with teacher info
        $courses = Course::with('teacher')->get();

        // Fetch student's enrolled courses
        $enrollments = Enrollment::with('course')
            ->where('student_id', $student->id)
            ->get();

        return view('student.dashboard', compact('student', 'courses', 'enrollments'));
    }

    // 📚 View available courses
    public function availableCourses()
    {
        $courses = Course::with('teacher')->get();
        return view('student.courses', compact('courses'));
    }

    // 📝 Enroll in a course
    public function enroll(Request $request, Course $course)
    {
        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $alreadyEnrolled = Enrollment::where('student_id', $studentId)
            ->where('course_id', $course->id)
            ->exists();

        if ($alreadyEnrolled) {
            return redirect()->back()->with('message', 'You are already enrolled in this course.');
        }

        Enrollment::create([
            'student_id' => $studentId,
            'course_id' => $course->id,
            'enrolled_at' => now(),
        ]);

        return redirect()->route('student.enrolled')->with('success', 'Enrollment successful!');
    }

    // 🎓 View enrolled courses
    public function enrolledCourses(Request $request)
    {
        $studentId = $request->session()->get('student_id');

        if (!$studentId) {
            return redirect()->route('login')->with('error', 'Please login first.');
        }

        $enrollments = Enrollment::with('course')
            ->where('student_id', $studentId)
            ->get();

        return view('student.enrolled', compact('enrollments'));
    }

    // 🚪 Logout
    public function logout(Request $request)
    {
        $request->session()->forget(['student_id', 'student_name', 'student_email']);
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
