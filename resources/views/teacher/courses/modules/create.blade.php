@extends('layouts.teacher')

@section('title', 'Create Module')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create New Module</h4>
                        <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Course
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>Course: {{ $course->title }}</h6>
                        <p class="text-muted mb-0">Add a new module to organize your course content</p>
                    </div>

                    <form action="{{ route('teacher.courses.modules.store', $course) }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Module Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g., Introduction to Web Development" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Module Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="4" 
                                      placeholder="Describe what students will learn in this module...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="order" class="form-label">Module Order *</label>
                            <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                   id="order" name="order" value="{{ old('order', $course->modules->count() + 1) }}" 
                                   min="1" required>
                            <small class="form-text text-muted">
                                This determines the order in which modules appear in your course. 
                                Current modules: {{ $course->modules->pluck('order')->implode(', ') ?: 'None' }}
                            </small>
                            @error('order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-plus me-2"></i>Create Module
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
