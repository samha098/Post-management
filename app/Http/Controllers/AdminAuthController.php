<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use App\Models\User;

class AdminAuthController extends Controller
{
    
    public function login(Request $request)
    {
        // Validate incoming request data
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|string|min:8',
    ]);

    // Attempt to authenticate user by email and password
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
        // Get the authenticated user
        
        $user = Auth::user();
     
        // Check if the user has the 'admin' role by checking the role_user table
        if ($user->roles()->where('name', 'admin')->exists()) {
            // Redirect to the admin dashboard if the user has the 'admin' role
            return redirect()->route('admin.dashboard');
        }

       
        Auth::logout(); // Log the user out
        return back()->withErrors([
            'email' => 'You are not authorized to access the admin dashboard.',
        ]);
    }

    // If authentication fails
    return back()->withErrors([
        'email' => 'Invalid credentials.',
    ]);
       
    }
    public function index()
    {
        $posts = Post::all();
        return view('admin.dashboard', compact('posts'));
      
    }
    public function users()
    {
        $users = User::with('posts')->whereHas('roles', function ($query) {
            $query->where('name', 'User'); // Filter by the 'User' role
        })->get();
        return view('admin.users', compact('users'));
      
    }
    public function logout(Request $request)
    {
        Auth::logout(); 

       
        return redirect()->route('admin.login');
    }
}