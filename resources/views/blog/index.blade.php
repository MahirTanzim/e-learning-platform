@extends('layouts.app')

@section('title', 'Blog')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <h1 class="mb-4">Blog</h1>
            
            @forelse($posts as $post)
                <article class="card mb-4 blog-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <img src="{{ $post->teacher->avatar_url }}" alt="{{ $post->teacher->name }}" 
                                 class="rounded-circle me-3" style="width: 40px; height: 40px;">
                            <div>
                                <h6 class="mb-0">{{ $post->teacher->name }}</h6>
                                <small class="text-muted">{{ $post->created_at->format('M d, Y') }}</small>
                            </div>
                        </div>
                        
                        <h3 class="card-title">
                            <a href="{{ route('blog.show', $post->slug) }}" class="text-decoration-none">
                                {{ $post->title }}
                            </a>
                        </h3>
                        
                        <p class="card-text text-muted">
                            {{ Str::limit($post->excerpt, 200) }}
                        </p>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex gap-3">
                                <span class="text-muted">
                                    <i class="fas fa-heart me-1"></i>{{ $post->likes()->count() }}
                                </span>
                                <span class="text-muted">
                                    <i class="fas fa-comment me-1"></i>{{ $post->comments()->count() }}
                                </span>
                            </div>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-outline-primary btn-sm">
                                Read More
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div class="text-center py-5">
                    <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                    <h4>No blog posts yet</h4>
                    <p class="text-muted">Check back later for new content!</p>
                </div>
            @endforelse
            
            <div class="d-flex justify-content-center">
                {{ $posts->links() }}
            </div>
        </div>
        
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Posts</h5>
                    @foreach($posts->take(5) as $recentPost)
                        <div class="mb-3">
                            <h6 class="mb-1">
                                <a href="{{ route('blog.show', $recentPost->slug) }}" class="text-decoration-none">
                                    {{ Str::limit($recentPost->title, 50) }}
                                </a>
                            </h6>
                            <small class="text-muted">{{ $recentPost->created_at->format('M d, Y') }}</small>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.blog-card {
    transition: transform 0.2s;
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.blog-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.blog-card .card-title a {
    color: #333;
}

.blog-card .card-title a:hover {
    color: #667eea;
}
</style>
@endsection 