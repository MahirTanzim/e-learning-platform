@extends('layouts.teacher')

@section('title', 'Create Assignment')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create New Assignment</h4>
                        <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Course
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>Course: {{ $course->title }}</h6>
                        <p class="text-muted mb-0">Create an assignment to give your students practical work</p>
                    </div>

                    <form action="{{ route('teacher.courses.assignments.store', $course) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Assignment Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g., Build a Personal Portfolio Website" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Assignment Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="6" 
                                      placeholder="Provide detailed instructions for the assignment...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="due_date" class="form-label">Due Date *</label>
                                    <input type="datetime-local" class="form-control @error('due_date') is-invalid @enderror" 
                                           id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                                    @error('due_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="total_marks" class="form-label">Total Marks *</label>
                                    <input type="number" class="form-control @error('total_marks') is-invalid @enderror" 
                                           id="total_marks" name="total_marks" value="{{ old('total_marks', 100) }}" 
                                           min="1" max="1000" required>
                                    @error('total_marks')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="attachment" class="form-label">Assignment File (Optional)</label>
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" 
                                   id="attachment" name="attachment" accept=".pdf,.doc,.docx,.txt">
                            <small class="form-text text-muted">
                                Supported formats: PDF, DOC, DOCX, TXT<br>
                                Maximum size: 10MB
                            </small>
                            @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="submission_instructions" class="form-label">Submission Instructions</label>
                            <textarea class="form-control @error('submission_instructions') is-invalid @enderror" 
                                      id="submission_instructions" name="submission_instructions" rows="3" 
                                      placeholder="How should students submit their work?">{{ old('submission_instructions') }}</textarea>
                            @error('submission_instructions')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="rubric" class="form-label">Grading Rubric</label>
                            <textarea class="form-control @error('rubric') is-invalid @enderror" 
                                      id="rubric" name="rubric" rows="4" 
                                      placeholder="Provide grading criteria and point breakdown...">{{ old('rubric') }}</textarea>
                            <small class="form-text text-muted">
                                Help students understand how their work will be evaluated
                            </small>
                            @error('rubric')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="allow_late_submission" name="allow_late_submission" value="1" 
                                       {{ old('allow_late_submission') ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_late_submission">
                                    Allow late submissions
                                </label>
                                <small class="form-text text-muted d-block">
                                    Students can submit after the due date (with potential penalties)
                                </small>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="require_peer_review" name="require_peer_review" value="1" 
                                       {{ old('require_peer_review') ? 'checked' : '' }}>
                                <label class="form-check-label" for="require_peer_review">
                                    Require peer review
                                </label>
                                <small class="form-text text-muted d-block">
                                    Students must review each other's work before final grading
                                </small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Create Assignment
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Assignment Creation Tips -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Assignment Creation Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Provide clear, step-by-step instructions</li>
                        <li>Include examples or sample work when possible</li>
                        <li>Set realistic due dates that give students enough time</li>
                        <li>Create detailed rubrics for fair and consistent grading</li>
                        <li>Consider the complexity and time required for completion</li>
                        <li>Include submission format requirements</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Set minimum due date to tomorrow
const tomorrow = new Date();
tomorrow.setDate(tomorrow.getDate() + 1);
tomorrow.setHours(23, 59, 0, 0);

const dueDateInput = document.getElementById('due_date');
dueDateInput.min = tomorrow.toISOString().slice(0, 16);

// File size validation
document.getElementById('attachment').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const fileSize = file.size / (1024 * 1024); // Convert to MB
        
        if (fileSize > 10) {
            alert('File size exceeds 10MB limit. Please choose a smaller file.');
            this.value = '';
        }
    }
});

// Auto-generate submission instructions if empty
document.getElementById('submission_instructions').addEventListener('blur', function() {
    if (!this.value.trim()) {
        this.value = 'Please submit your completed assignment as a single file (PDF, DOC, or DOCX). Include your name and student ID in the document header.';
    }
});
</script>
@endsection
