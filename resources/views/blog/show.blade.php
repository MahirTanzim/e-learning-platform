@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <article class="blog-post">
                <header class="mb-4">
                    <h1 class="display-4 fw-bold mb-3">{{ $post->title }}</h1>
                    
                    <div class="d-flex align-items-center mb-4">
                        <img src="{{ $post->teacher->avatar_url }}" alt="{{ $post->teacher->name }}" 
                             class="rounded-circle me-3" style="width: 50px; height: 50px;">
                        <div>
                            <h6 class="mb-0">{{ $post->teacher->name }}</h6>
                            <small class="text-muted">
                                {{ $post->created_at->format('F d, Y') }} • 
                                <i class="fas fa-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                    
                    @if($post->featured_image)
                        <img src="{{ asset('storage/' . $post->featured_image) }}" 
                             alt="{{ $post->title }}" class="img-fluid rounded mb-4">
                    @endif
                </header>
                
                <div class="blog-content mb-5">
                    {!! $post->content !!}
                </div>
                
                <div class="blog-actions mb-5">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex gap-3">
                            <button class="btn btn-outline-primary" id="likeBtn" data-post-id="{{ $post->id }}">
                                <i class="fas fa-heart me-2"></i>
                                <span id="likeCount">{{ $post->likes()->count() }}</span> Likes
                            </button>
                            <button class="btn btn-outline-secondary" onclick="scrollToComments()">
                                <i class="fas fa-comment me-2"></i>
                                {{ $post->comments()->count() }} Comments
                            </button>
                        </div>
                        
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-share"></i> Share
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="shareOnFacebook()">Facebook</a></li>
                                <li><a class="dropdown-item" href="#" onclick="shareOnTwitter()">Twitter</a></li>
                                <li><a class="dropdown-item" href="#" onclick="copyLink()">Copy Link</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <!-- Comments Section -->
                <section id="comments" class="comments-section">
                    <h4 class="mb-4">Comments ({{ $post->comments()->count() }})</h4>
                    
                    @auth
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="{{ route('teacher.blog.comment', $post) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <textarea name="content" class="form-control" rows="3" 
                                                  placeholder="Write a comment..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <a href="{{ route('login') }}">Login</a> to leave a comment.
                        </div>
                    @endauth
                    
                    <div class="comments-list">
                        @forelse($post->comments()->with('user')->latest()->get() as $comment)
                            <div class="comment-item card mb-3">
                                <div class="card-body">
                                    <div class="d-flex">
                                        <img src="{{ $comment->user->avatar_url }}" alt="{{ $comment->user->name }}" 
                                             class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">{{ $comment->user->name }}</h6>
                                                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                                                </div>
                                                @if(auth()->check() && (auth()->id() === $comment->user_id || auth()->user()->isAdmin()))
                                                    <form action="{{ route('teacher.blog.comment.destroy', [$post, $comment]) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                onclick="return confirm('Are you sure?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            <p class="mt-2 mb-0">{{ $comment->content }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-comments fa-2x text-muted mb-3"></i>
                                <p class="text-muted">No comments yet. Be the first to comment!</p>
                            </div>
                        @endforelse
                    </div>
                </section>
            </article>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">About the Author</h5>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ $post->teacher->avatar_url }}" alt="{{ $post->teacher->name }}" 
                             class="rounded-circle me-3" style="width: 60px; height: 60px;">
                        <div>
                            <h6 class="mb-1">{{ $post->teacher->name }}</h6>
                            <small class="text-muted">Teacher</small>
                        </div>
                    </div>
                    @if($post->teacher->profile)
                        <p class="text-muted">{{ Str::limit($post->teacher->profile->bio, 150) }}</p>
                    @endif
                    <a href="{{ route('student.teachers.show', $post->teacher) }}" class="btn btn-outline-primary btn-sm">
                        View Profile
                    </a>
                </div>
            </div>
            
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Recent Posts</h5>
                    @foreach($post->teacher->blogPosts()->where('id', '!=', $post->id)->latest()->limit(5)->get() as $recentPost)
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
.blog-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.blog-content img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 1rem 0;
}

.comment-item {
    border: none;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.comment-item:hover {
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
}
</style>

<script>
function scrollToComments() {
    document.getElementById('comments').scrollIntoView({ behavior: 'smooth' });
}

function shareOnFacebook() {
    window.open(`https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(window.location.href)}`, '_blank');
}

function shareOnTwitter() {
    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(window.location.href)}&text=${encodeURIComponent('{{ $post->title }}')}`, '_blank');
}

function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        alert('Link copied to clipboard!');
    });
}

// Like functionality
document.getElementById('likeBtn').addEventListener('click', function() {
    const postId = this.dataset.postId;
    const likeCount = document.getElementById('likeCount');
    
    fetch(`/api/blog/${postId}/like`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        likeCount.textContent = data.likes;
        if (data.liked) {
            this.classList.add('btn-primary');
            this.classList.remove('btn-outline-primary');
        } else {
            this.classList.remove('btn-primary');
            this.classList.add('btn-outline-primary');
        }
    });
});
</script>
@endsection 