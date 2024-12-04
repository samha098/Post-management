<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class PostController extends Controller
{
    //
    use AuthorizesRequests;
    
    public function index()
    {
        $posts = Post::all();
        return view('dashboard', compact('posts'));
    }
    public function create()
    {
    $this->authorize('create', Post::class);
    $categories = Category::all();
    return view('create-post', compact('categories'));
    }
    public function store(Request $request)
    {
    $this->authorize('create', Post::class);
    // Validate the request
    $validatedData = $request->validate([
       'title' => 'required|max:255',
       'description' => 'required',
      'categories' => 'required|min:1',
      'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    // Create the post
    $post = Post::create([
        'title' => $validatedData['title'],
        'description' => $validatedData['description'],
        'user_id' => auth()->user()->id,
    ]);
    // Handle file upload
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('posts', 'public');
        $post->image = $imagePath;
        $post->save();
    }
    // Attach categories
    $post->categories()->attach($validatedData['categories']);

    return redirect()->route('dashboard')->with('success', 'Post created successfully.');
    }
     public function show($id)
    {
    // Find the post by ID or fail if it doesn't exist
    $post = Post::findOrFail($id);

    // Return the 'show_post' view and pass the post
    return view('view-post', compact('post'));
    }
    public function edit(Post $post)
    {
    $categories = Category::all();
    return view('edit-post', compact('post', 'categories'));
    }
     public function update(Request $request, Post $post)
    {
    $this->authorize('update', $post);
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
    return redirect()->route('dashboard')->with('success', 'Post updated successfully.');
    }
    public function destroy(Post $post)
    {
    $this->authorize('delete', $post);
    $post->delete();

    return redirect()->route('dashboard')->with('success', 'Post deleted successfully.');
    }
    public function myPosts()
    {
    $posts = Post::where('user_id', auth()->id())->latest()->paginate(10);

    return view('my-posts', compact('posts'));
    }
}