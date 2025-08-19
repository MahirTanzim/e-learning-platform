@extends('layouts.teacher')

@section('title', 'Upload Video')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Upload New Video</h4>
                        <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Course
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>Course: {{ $course->title }}</h6>
                        <h6>Module: {{ $module->title }}</h6>
                        <p class="text-muted mb-0">Upload a video to this module</p>
                    </div>

                    <form action="{{ route('teacher.courses.videos.store', [$course, $module]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Video Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g., Introduction to HTML Basics" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Video Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Brief description of what this video covers...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="video" class="form-label">Video File *</label>
                                    <input type="file" class="form-control @error('video') is-invalid @enderror" 
                                           id="video" name="video" accept="video/*" required>
                                    <small class="form-text text-muted">
                                        Supported formats: MP4, AVI, MOV, WMV<br>
                                        Maximum size: 100MB
                                    </small>
                                    @error('video')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="duration" class="form-label">Duration (minutes) *</label>
                                    <input type="number" class="form-control @error('duration') is-invalid @enderror" 
                                           id="duration" name="duration" value="{{ old('duration') }}" 
                                           min="1" max="999" required>
                                    @error('duration')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="order" class="form-label">Video Order *</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror" 
                                           id="order" name="order" value="{{ old('order', $module->videos->count() + 1) }}" 
                                           min="1" required>
                                    <small class="form-text text-muted">
                                        This determines the order in which videos appear in this module. 
                                        Current videos: {{ $module->videos->pluck('order')->implode(', ') ?: 'None' }}
                                    </small>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="form-check mt-4">
                                        <input class="form-check-input" type="checkbox" id="is_free" name="is_free" value="1" 
                                               {{ old('is_free') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_free">
                                            Make this video free for preview
                                        </label>
                                        <small class="form-text text-muted d-block">
                                            Free videos can be watched by anyone without enrolling in the course
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Upload Progress Bar -->
                        <div class="progress mb-3 d-none" id="upload-progress">
                            <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-info" id="upload-btn">
                                <i class="fas fa-upload me-2"></i>Upload Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('video').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Show file info
        const fileSize = (file.size / (1024 * 1024)).toFixed(2);
        const fileName = file.name;
        
        // Create file info display
        let fileInfo = document.getElementById('file-info');
        if (!fileInfo) {
            fileInfo = document.createElement('div');
            fileInfo.id = 'file-info';
            fileInfo.className = 'alert alert-info mt-2';
            document.getElementById('video').parentNode.appendChild(fileInfo);
        }
        
        fileInfo.innerHTML = `
            <strong>Selected File:</strong> ${fileName}<br>
            <strong>Size:</strong> ${fileSize} MB<br>
            <strong>Type:</strong> ${file.type}
        `;
        
        // Validate file size
        if (file.size > 100 * 1024 * 1024) { // 100MB
            fileInfo.className = 'alert alert-danger mt-2';
            fileInfo.innerHTML += '<br><strong class="text-danger">File size exceeds 100MB limit!</strong>';
            document.getElementById('upload-btn').disabled = true;
        } else {
            document.getElementById('upload-btn').disabled = false;
        }
    }
});

document.querySelector('form').addEventListener('submit', function(e) {
    const videoFile = document.getElementById('video').files[0];
    if (videoFile && videoFile.size > 100 * 1024 * 1024) {
        e.preventDefault();
        alert('File size exceeds 100MB limit. Please choose a smaller file.');
        return false;
    }
    
    // Show progress bar
    const progressBar = document.getElementById('upload-progress');
    const progressBarInner = progressBar.querySelector('.progress-bar');
    progressBar.classList.remove('d-none');
    
    // Simulate upload progress
    let progress = 0;
    const interval = setInterval(() => {
        progress += Math.random() * 15;
        if (progress > 90) progress = 90;
        progressBarInner.style.width = progress + '%';
        progressBarInner.textContent = Math.round(progress) + '%';
    }, 200);
    
    // Store interval to clear later
    this.dataset.progressInterval = interval;
});
</script>
@endsection
