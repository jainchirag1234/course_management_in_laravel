<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // 🧩 Role change function
    public function changeRole($id, $newRole)
    {
        $user = User::findOrFail($id);
        $user->role = $newRole; // e.g. 'teacher' ya 'student'
        $user->save();

        return redirect()->back()->with('success', 'Role changed successfully!');
    }
}
