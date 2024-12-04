<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PermissionController;

Route::get('/', function () {
    return view('welcome');
});



// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('admin/dashboard', [AdminAuthController::class, 'index'])->name('admin.dashboard');
    Route::get('admin/users', [AdminAuthController::class, 'users'])->name('admin.users');
    Route::resource('admin/posts', AdminPostController::class , ['as' => 'admin']);
    Route::post('admin/update-permission', [PermissionController::class, 'updatePermission']);
});

Route::get('/dashboard', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware('auth', 'role:user')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('posts', PostController::class);
    Route::get('/my-posts', [PostController::class, 'myPosts'])->name('my-posts');
});

require __DIR__.'/auth.php';