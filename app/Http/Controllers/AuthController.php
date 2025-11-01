<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    // 🔹 Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // 🔹 Handle login request (without hash)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 🔸 Find user manually
        $user = User::where('email', $request->email)->first();

        // ✅ Check if user exists and password matches (plain text)
        if ($user && $user->password === $request->password) {

            // 🔐 Log in user
            Auth::login($user);

            // 🧠 Store session manually (for StudentController & TeacherController)
            if ($user->role === 'student') {
                $request->session()->put('student_id', $user->id);
                $request->session()->put('student_name', $user->name);
                $request->session()->put('student_email', $user->email);

                return redirect()->route('student.dashboard');
            } elseif ($user->role === 'teacher') {
                $request->session()->put('teacher_id', $user->id);
                $request->session()->put('teacher_name', $user->name);
                $request->session()->put('teacher_email', $user->email);

                return redirect()->route('teacher.index');
            }

            return back()->with('error', 'Invalid user role.');
        }

        // ❌ Invalid credentials
        return back()->withErrors([
            'email' => 'Invalid email or password.',
        ]);
    }

    // 🔹 Show Logout Confirmation Page
    public function showLogoutPage()
    {
        return view('auth.logout');
    }

    // 🔹 Handle Logout
    public function logout(Request $request)
    {
        // 🧹 Clear Laravel Auth + Session
        Auth::logout();
        $request->session()->forget([
            'student_id',
            'student_name',
            'student_email',
            'teacher_id',
            'teacher_name',
            'teacher_email'
        ]);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // ✅ Redirect to login
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}
