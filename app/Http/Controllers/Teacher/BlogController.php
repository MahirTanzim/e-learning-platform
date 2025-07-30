<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BlogComment;
use App\Models\BlogLike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $posts = BlogPost::where('teacher_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('teacher.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('teacher.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('featured_image')) {
            $imagePath = $request->file('featured_image')->store('blog-images', 'public');
        }

        BlogPost::create([
            'teacher_id' => Auth::id(),
            'title' => $request->title,
            'slug' => Str::slug($request->title) . '-' . time(),
            'content' => $request->get('content'),
            'featured_image' => $imagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.blog.index')
            ->with('success', 'Blog post created successfully!');
    }

    public function show(BlogPost $blog)
    {
        $this->authorize('view', $blog);
        
        $blog->load(['comments.user', 'likes']);
        return view('teacher.blog.show', compact('blog'));
    }

    public function edit(BlogPost $blog)
    {
        $this->authorize('update', $blog);
        return view('teacher.blog.edit', compact('blog'));
    }

    public function update(Request $request, BlogPost $blog)
    {
        $this->authorize('update', $blog);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('featured_image')) {
            if ($blog->featured_image) {
                Storage::disk('public')->delete($blog->featured_image);
            }
            $imagePath = $request->file('featured_image')->store('blog-images', 'public');
            $blog->featured_image = $imagePath;
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->get('content'),
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.blog.show', $blog)
            ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $blog)
    {
        $this->authorize('delete', $blog);
        
        if ($blog->featured_image) {
            Storage::disk('public')->delete($blog->featured_image);
        }
        
        $blog->delete();
        
        return redirect()->route('teacher.blog.index')
            ->with('success', 'Blog post deleted successfully!');
    }
}