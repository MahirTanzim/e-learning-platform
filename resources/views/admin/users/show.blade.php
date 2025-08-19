@extends('layouts.admin')

@section('title', 'User Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">User Details</h1>
                <div>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary me-2">
                        <i class="fas fa-edit me-2"></i>Edit User
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Users
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- User Information -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">User Information</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" 
                                 class="rounded-circle mb-3" style="width: 120px; height: 120px;">
                            <h4 class="mb-2">{{ $user->name }}</h4>
                            <p class="text-muted mb-3">{{ $user->email }}</p>
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <h5 class="mb-1">
                                        @if($user->role === 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif($user->role === 'teacher')
                                            <span class="badge bg-success">Teacher</span>
                                        @else
                                            <span class="badge bg-primary">Student</span>
                                        @endif
                                    </h5>
                                    <small class="text-muted">Role</small>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1">
                                        @if($user->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($user->status === 'inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @else
                                            <span class="badge bg-warning">Suspended</span>
                                        @endif
                                    </h5>
                                    <small class="text-muted">Status</small>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <h5 class="mb-1">{{ $user->created_at->format('M d, Y') }}</h5>
                                    <small class="text-muted">Joined</small>
                                </div>
                                <div class="col-6">
                                    <h5 class="mb-1">{{ $user->last_login_at ? $user->last_login_at->format('M d, Y') : 'Never' }}</h5>
                                    <small class="text-muted">Last Login</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($user->profile)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Profile Information</h6>
                            </div>
                            <div class="card-body">
                                @if($user->profile->bio)
                                    <p><strong>Bio:</strong> {{ $user->profile->bio }}</p>
                                @endif
                                @if($user->profile->phone)
                                    <p><strong>Phone:</strong> {{ $user->profile->phone }}</p>
                                @endif
                                @if($user->profile->address)
                                    <p><strong>Address:</strong> {{ $user->profile->address }}</p>
                                @endif
                                @if($user->profile->website)
                                    <p><strong>Website:</strong> <a href="{{ $user->profile->website }}" target="_blank">{{ $user->profile->website }}</a></p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- User Activity -->
                <div class="col-lg-8">
                    @if($user->role === 'teacher')
                        <!-- Teacher Courses -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Courses Created</h6>
                            </div>
                            <div class="card-body">
                                @if($user->courses->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Course</th>
                                                    <th>Status</th>
                                                    <th>Students</th>
                                                    <th>Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->courses as $course)
                                                    <tr>
                                                        <td>
                                                            <h6 class="mb-0">{{ $course->title }}</h6>
                                                            <small class="text-muted">{{ $course->category->name }}</small>
                                                        </td>
                                                        <td>
                                                            @if($course->status === 'published')
                                                                <span class="badge bg-success">Published</span>
                                                            @else
                                                                <span class="badge bg-warning">Draft</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $course->enrollments_count }}</td>
                                                        <td>{{ $course->created_at->format('M d, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">No courses created yet.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Teacher Blog Posts -->
                        @if($user->blogPosts->count() > 0)
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Blog Posts</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Post</th>
                                                    <th>Status</th>
                                                    <th>Comments</th>
                                                    <th>Created</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->blogPosts as $post)
                                                    <tr>
                                                        <td>
                                                            <h6 class="mb-0">{{ $post->title }}</h6>
                                                            <small class="text-muted">{{ Str::limit($post->content, 50) }}</small>
                                                        </td>
                                                        <td>
                                                            @if($post->status === 'published')
                                                                <span class="badge bg-success">Published</span>
                                                            @else
                                                                <span class="badge bg-warning">Draft</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $post->comments->count() }}</td>
                                                        <td>{{ $post->created_at->format('M d, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif

                    @if($user->role === 'student')
                        <!-- Student Enrollments -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Course Enrollments</h6>
                            </div>
                            <div class="card-body">
                                @if($user->enrollments->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>Course</th>
                                                    <th>Teacher</th>
                                                    <th>Progress</th>
                                                    <th>Enrolled</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($user->enrollments as $enrollment)
                                                    <tr>
                                                        <td>
                                                            <h6 class="mb-0">{{ $enrollment->course->title }}</h6>
                                                            <small class="text-muted">{{ $enrollment->course->category->name }}</small>
                                                        </td>
                                                        <td>{{ $enrollment->course->teacher->name }}</td>
                                                        <td>
                                                            <div class="progress" style="height: 6px;">
                                                                <div class="progress-bar" role="progressbar" 
                                                                     style="width: {{ $enrollment->progress ?? 0 }}%;"></div>
                                                            </div>
                                                            <small class="text-muted">{{ $enrollment->progress ?? 0 }}%</small>
                                                        </td>
                                                        <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p class="text-muted">No course enrollments yet.</p>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- User Reviews -->
                    @if($user->reviews->count() > 0)
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Reviews</h6>
                            </div>
                            <div class="card-body">
                                @foreach($user->reviews as $review)
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $review->course->title }}</h6>
                                                <div class="mb-2">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></i>
                                                    @endfor
                                                    <span class="ms-2 text-muted">{{ $review->rating }}/5</span>
                                                </div>
                                                <p class="mb-1">{{ $review->comment }}</p>
                                            </div>
                                            <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- User Complaints -->
                    @if($user->complaints->count() > 0)
                        <div class="card shadow">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">Complaints Filed</h6>
                            </div>
                            <div class="card-body">
                                @foreach($user->complaints as $complaint)
                                    <div class="border-bottom pb-3 mb-3">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $complaint->subject }}</h6>
                                                <p class="mb-1">{{ $complaint->description }}</p>
                                                <span class="badge bg-{{ $complaint->status === 'pending' ? 'warning' : ($complaint->status === 'resolved' ? 'success' : 'info') }}">
                                                    {{ ucfirst($complaint->status) }}
                                                </span>
                                            </div>
                                            <small class="text-muted">{{ $complaint->created_at->format('M d, Y') }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
