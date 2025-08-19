@extends('layouts.teacher')

@section('title', $post->title)

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Blog Post Details</h1>
                <div class="btn-group" role="group">
                    <a href="{{ route('teacher.blog.edit', $post) }}" class="btn btn-outline-primary">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <a href="{{ route('teacher.blog.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Posts
                    </a>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <!-- Blog Post Content -->
                    <div class="card mb-4">
                        @if($post->featured_image)
                            <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                 class="card-img-top" 
                                 alt="{{ $post->title }}"
                                 style="max-height: 400px; object-fit: cover;">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h2 class="card-title">{{ $post->title }}</h2>
                                    <p class="text-muted mb-2">
                                        <i class="fas fa-calendar me-2"></i>
                                        {{ $post->created_at->format('F d, Y') }}
                                        @if($post->updated_at != $post->created_at)
                                            <small class="ms-2">(Updated {{ $post->updated_at->format('M d, Y') }})</small>
                                        @endif
                                    </p>
                                </div>
                                <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }} fs-6">
                                    {{ ucfirst($post->status) }}
                                </span>
                            </div>
                            
                            <div class="blog-content">
                                {!! nl2br(e($post->content)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="card">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <i class="fas fa-comments me-2"></i>
                                Comments ({{ $post->comments->count() }})
                            </h5>
                        </div>
                        <div class="card-body">
                            @if($post->comments->count() > 0)
                                @foreach($post->comments as $comment)
                                    <div class="comment mb-3 pb-3 border-bottom">
                                        <div class="d-flex align-items-start">
                                            <img src="{{ $comment->user->avatar_url }}" 
                                                 alt="{{ $comment->user->name }}" 
                                                 class="rounded-circle me-3" 
                                                 style="width: 40px; height: 40px; object-fit: cover;">
                                            <div class="flex-grow-1">
                                                <div class="d-flex justify-content-between align-items-start">
                                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                                <p class="mb-1">{{ $comment->comment }}</p>
                                                @if($comment->user_id === auth()->id() || $post->teacher_id === auth()->id())
                                                    <form action="{{ route('teacher.blog.comment.destroy', [$post, $comment]) }}" 
                                                          method="POST" 
                                                          class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" 
                                                                class="btn btn-sm btn-outline-danger"
                                                                onclick="return confirm('Are you sure you want to delete this comment?')">
                                                            <i class="fas fa-trash me-1"></i>Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-muted text-center py-3">No comments yet. Be the first to comment!</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Post Stats -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-chart-bar me-2"></i>Post Statistics
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <h4 class="text-primary mb-1">{{ $post->likes->count() }}</h4>
                                        <small class="text-muted">Likes</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <h4 class="text-info mb-1">{{ $post->comments->count() }}</h4>
                                    <small class="text-muted">Comments</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-tools me-2"></i>Quick Actions
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('teacher.blog.edit', $post) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-edit me-2"></i>Edit Post
                                </a>
                                <a href="{{ route('teacher.blog.index') }}" class="btn btn-outline-secondary">
                                    <i class="fas fa-list me-2"></i>View All Posts
                                </a>
                                <a href="{{ route('teacher.blog.create') }}" class="btn btn-outline-success">
                                    <i class="fas fa-plus me-2"></i>Create New Post
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Post Info -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">
                                <i class="fas fa-info-circle me-2"></i>Post Information
                            </h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <strong>Status:</strong> 
                                    <span class="badge bg-{{ $post->status === 'published' ? 'success' : 'warning' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </li>
                                <li class="mb-2">
                                    <strong>Created:</strong> {{ $post->created_at->format('M d, Y') }}
                                </li>
                                <li class="mb-2">
                                    <strong>Updated:</strong> {{ $post->updated_at->format('M d, Y') }}
                                </li>
                                <li class="mb-2">
                                    <strong>Word Count:</strong> {{ str_word_count($post->content) }}
                                </li>
                                <li class="mb-0">
                                    <strong>Reading Time:</strong> {{ ceil(str_word_count($post->content) / 200) }} min
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
