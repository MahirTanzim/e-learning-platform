@extends('layouts.teacher')

@section('title', 'My Blog Posts')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">My Blog Posts</h1>
                <a href="{{ route('teacher.blog.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Create New Post
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    @if($posts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Comments</th>
                                        <th>Likes</th>
                                        <th>Created</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($post->featured_image)
                                                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                                                             alt="{{ $post->title }}" 
                                                             class="rounded me-3" 
                                                             style="width: 50px; height: 50px; object-fit: cover;">
                                                    @endif
                                                    <div>
                                                        <h6 class="mb-0">{{ $post->title }}</h6>
                                                        <small class="text-muted">{{ Str::limit($post->content, 100) }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if($post->status === 'published')
                                                    <span class="badge bg-success">Published</span>
                                                @else
                                                    <span class="badge bg-warning">Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $post->comments_count }}</span>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary">{{ $post->likes_count }}</span>
                                            </td>
                                            <td>{{ $post->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('teacher.blog.show', $post) }}" 
                                                       class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('teacher.blog.edit', $post) }}" 
                                                       class="btn btn-sm btn-outline-secondary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('teacher.blog.destroy', $post) }}" 
                                                          method="POST" 
                                                          class="d-inline"
                                                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $posts->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                            <h4>No blog posts yet</h4>
                            <p class="text-muted">Start sharing your knowledge by creating your first blog post!</p>
                            <a href="{{ route('teacher.blog.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create Your First Post
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
