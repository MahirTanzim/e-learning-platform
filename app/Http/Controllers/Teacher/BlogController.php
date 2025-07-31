<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\BlogPost;
use App\Models\BlogComment;
use App\Models\BlogLike;

class BlogController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->blogPosts()
                              ->withCount(['comments', 'likes'])
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
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $featuredImagePath = null;
        if ($request->hasFile('featured_image')) {
            $featuredImagePath = $request->file('featured_image')->store('blog-images', 'public');
        }

        auth()->user()->blogPosts()->create([
            'title' => $request->title,
            'slug' => Str::slug($request->title . '-' . time()),
            'content' => $request->content,
            'featured_image' => $featuredImagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.blog.index')
                        ->with('success', 'Blog post created successfully!');
    }

    public function show(BlogPost $post)
    {
        $post->load(['comments.user', 'likes.user']);
        return view('teacher.blog.show', compact('post'));
    }

    public function edit(BlogPost $post)
    {
        return view('teacher.blog.edit', compact('post'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published',
        ]);

        $featuredImagePath = $post->featured_image;
        if ($request->hasFile('featured_image')) {
            if ($featuredImagePath) {
                Storage::disk('public')->delete($featuredImagePath);
            }
            $featuredImagePath = $request->file('featured_image')->store('blog-images', 'public');
        }

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
            'featured_image' => $featuredImagePath,
            'status' => $request->status,
        ]);

        return redirect()->route('teacher.blog.index')
                        ->with('success', 'Blog post updated successfully!');
    }

    public function destroy(BlogPost $post)
    {
        if ($post->featured_image) {
            Storage::disk('public')->delete($post->featured_image);
        }
        
        $post->delete();

        return redirect()->route('teacher.blog.index')
                        ->with('success', 'Blog post deleted successfully!');
    }

    public function toggleLike(BlogPost $post)
    {
        $user = auth()->user();
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => $user->id]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $post->likes()->count()
        ]);
    }

    public function storeComment(Request $request, BlogPost $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    public function destroyComment(BlogPost $post, BlogComment $comment)
    {
        if ($comment->user_id !== auth()->id() && $post->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $comment->delete();

        return back()->with('success', 'Comment deleted successfully!');
    }
}