@extends('layouts.teacher')

@section('title', 'Edit Course')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Edit Course: {{ $course->title }}</h1>
                <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Course
                </a>
            </div>

            <div class="card">
                <div class="card-body">
                    <form action="{{ route('teacher.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Course Title *</label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $course->title) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="description" class="form-label">Description *</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" 
                                              id="description" 
                                              name="description" 
                                              rows="6" 
                                              required>{{ old('description', $course->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="price" class="form-label">Price *</label>
                                            <div class="input-group">
                                                <span class="input-group-text">$</span>
                                                <input type="number" 
                                                       class="form-control @error('price') is-invalid @enderror" 
                                                       id="price" 
                                                       name="price" 
                                                       value="{{ old('price', $course->price) }}" 
                                                       step="0.01" 
                                                       min="0" 
                                                       required>
                                            </div>
                                            @error('price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="level" class="form-label">Difficulty Level *</label>
                                            <select class="form-select @error('level') is-invalid @enderror" 
                                                    id="level" 
                                                    name="level" 
                                                    required>
                                                <option value="beginner" {{ old('level', $course->level) === 'beginner' ? 'selected' : '' }}>Beginner</option>
                                                <option value="intermediate" {{ old('level', $course->level) === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                                                <option value="advanced" {{ old('level', $course->level) === 'advanced' ? 'selected' : '' }}>Advanced</option>
                                            </select>
                                            @error('level')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category *</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" 
                                            id="category_id" 
                                            name="category_id" 
                                            required>
                                        <option value="">Select a category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" 
                                                    {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="prerequisites" class="form-label">Prerequisites</label>
                                    <textarea class="form-control @error('prerequisites') is-invalid @enderror" 
                                              id="prerequisites" 
                                              name="prerequisites" 
                                              rows="3">{{ old('prerequisites', $course->prerequisites) }}</textarea>
                                    @error('prerequisites')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        What students should know before taking this course
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label for="learning_outcomes" class="form-label">Learning Outcomes</label>
                                    <textarea class="form-control @error('learning_outcomes') is-invalid @enderror" 
                                              id="learning_outcomes" 
                                              name="learning_outcomes" 
                                              rows="3">{{ old('learning_outcomes', $course->learning_outcomes) }}</textarea>
                                    @error('learning_outcomes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        What students will learn from this course
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label for="requirements" class="form-label">Requirements</label>
                                    <textarea class="form-control @error('requirements') is-invalid @enderror" 
                                              id="requirements" 
                                              name="requirements" 
                                              rows="3">{{ old('requirements', $course->requirements) }}</textarea>
                                    @error('requirements')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Software, tools, or materials needed
                                    </small>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="thumbnail" class="form-label">Course Thumbnail</label>
                                    @if($course->thumbnail)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                 alt="Current thumbnail" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 200px;">
                                        </div>
                                    @endif
                                    <input type="file" 
                                           class="form-control @error('thumbnail') is-invalid @enderror" 
                                           id="thumbnail" 
                                           name="thumbnail" 
                                           accept="image/*">
                                    @error('thumbnail')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        Leave empty to keep current thumbnail. Recommended size: 800x600px. Max size: 2MB.
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <label for="status" class="form-label">Course Status *</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status" 
                                            required>
                                        <option value="draft" {{ old('status', $course->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $course->status) === 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="archived" {{ old('status', $course->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">
                                        <strong>Draft:</strong> Only you can see this course<br>
                                        <strong>Published:</strong> Students can see and enroll in this course<br>
                                        <strong>Archived:</strong> Course is hidden from students
                                    </small>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" 
                                               type="checkbox" 
                                               id="certificate_available" 
                                               name="certificate_available" 
                                               value="1" 
                                               {{ old('certificate_available', $course->certificate_available) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="certificate_available">
                                            Certificate Available
                                        </label>
                                    </div>
                                    <small class="form-text text-muted">
                                        Students will receive a certificate upon completion
                                    </small>
                                </div>

                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <i class="fas fa-lightbulb me-2"></i>Publishing Tips
                                        </h6>
                                        <ul class="list-unstyled small mb-0">
                                            <li class="mb-2">• Ensure all content is complete</li>
                                            <li class="mb-2">• Add at least one module with videos</li>
                                            <li class="mb-2">• Set an appropriate price</li>
                                            <li class="mb-2">• Write clear descriptions</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-outline-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Update Course
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-resize textareas
    const textareas = document.querySelectorAll('textarea');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });

    // Preview new thumbnail
    const thumbnailInput = document.getElementById('thumbnail');
    thumbnailInput.addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // You can add thumbnail preview functionality here
            };
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endpush
@endsection
