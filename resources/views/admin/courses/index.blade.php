@extends('layouts.admin')

@section('title', 'Course Management')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Course Management</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Teacher</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Students</th>
                                    <th>Price</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($courses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($course->thumbnail)
                                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                         alt="{{ $course->title }}" class="rounded me-3" 
                                                         style="width: 60px; height: 45px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" 
                                                         style="width: 60px; height: 45px;">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <div>
                                                    <h6 class="mb-0">{{ $course->title }}</h6>
                                                    <small class="text-muted">{{ Str::limit($course->description, 50) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $course->teacher->avatar_url }}" alt="{{ $course->teacher->name }}" 
                                                     class="rounded-circle me-2" style="width: 30px; height: 30px;">
                                                <span>{{ $course->teacher->name }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $course->category->name }}</span>
                                        </td>
                                        <td>
                                            @if($course->status === 'published')
                                                <span class="badge bg-success">Published</span>
                                            @else
                                                <span class="badge bg-warning">Draft</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $course->enrollments_count }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold">${{ number_format($course->price, 2) }}</span>
                                        </td>
                                        <td>{{ $course->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.courses.show', $course) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.courses.edit', $course) }}" 
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($course->status === 'published')
                                                    <form action="{{ route('admin.courses.archive', $course) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-warning" 
                                                                onclick="return confirm('Are you sure you want to archive this course?')">
                                                            <i class="fas fa-archive"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.courses.publish', $course) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.courses.destroy', $course) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this course? This action cannot be undone.')">
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
                        {{ $courses->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
