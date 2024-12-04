<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class AdminPostController extends Controller
{
    //
    public function show($id)
{
    // Find the post by ID or fail if it doesn't exist
    $post = Post::findOrFail($id);

    // Return the 'show_post' view and pass the post
    return view('admin.view', compact('post'));
}
    public function edit(Post $post)
{
    $categories = Category::all();
    return view('admin.edit', compact('post', 'categories'));
}
public function update(Request $request, Post $post)
{
    
    $validatedData = $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
       'categories' => 'required|min:1',
       'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
     ]);

    $post->update([
        'title' => $request->title,
        'description' => $request->description,
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $post->image = $imagePath;
        $post->save();
    }
    $post->categories()->detach(); 
    $post->categories()->attach($validatedData['categories']);
    return redirect()->route('admin.dashboard')->with('success', 'Post updated successfully.');
}
public function destroy(Post $post)
{
   
    $post->delete();

    return redirect()->route('admin.dashboard')->with('success', 'Post deleted successfully.');
}
}