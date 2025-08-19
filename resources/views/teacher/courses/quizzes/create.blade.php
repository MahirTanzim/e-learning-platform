@extends('layouts.teacher')

@section('title', 'Create Quiz')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-warning text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Create New Quiz</h4>
                        <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-2"></i>Back to Course
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-4">
                        <h6>Course: {{ $course->title }}</h6>
                        <p class="text-muted mb-0">Create a quiz to test your students' knowledge</p>
                    </div>

                    <form action="{{ route('teacher.courses.quizzes.store', $course) }}" method="POST">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="title" class="form-label">Quiz Title *</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                   id="title" name="title" value="{{ old('title') }}" 
                                   placeholder="e.g., HTML Fundamentals Quiz" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="description" class="form-label">Quiz Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Describe what this quiz covers...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="time_limit" class="form-label">Time Limit (minutes)</label>
                                    <input type="number" class="form-control @error('time_limit') is-invalid @enderror" 
                                           id="time_limit" name="time_limit" value="{{ old('time_limit') }}" 
                                           min="1" max="180" placeholder="No limit">
                                    <small class="form-text text-muted">Leave empty for no time limit</small>
                                    @error('time_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label for="passing_marks" class="form-label">Passing Marks *</label>
                                    <input type="number" class="form-control @error('passing_marks') is-invalid @enderror" 
                                           id="passing_marks" name="passing_marks" value="{{ old('passing_marks', 60) }}" 
                                           min="1" max="1000" required>
                                    <small class="form-text text-muted">Students must score this to pass</small>
                                    @error('passing_marks')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="shuffle_questions" name="shuffle_questions" value="1" 
                                       {{ old('shuffle_questions') ? 'checked' : '' }}>
                                <label class="form-check-label" for="shuffle_questions">
                                    Shuffle questions for each student
                                </label>
                                <small class="form-text text-muted d-block">
                                    Questions will appear in random order for each student
                                </small>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="show_results" name="show_results" value="1" 
                                       {{ old('show_results', 1) ? 'checked' : '' }}>
                                <label class="form-check-label" for="show_results">
                                    Show results immediately after submission
                                </label>
                                <small class="form-text text-muted d-block">
                                    Students can see their score and correct answers right away
                                </small>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="allow_retake" name="allow_retake" value="1" 
                                       {{ old('allow_retake') ? 'checked' : '' }}>
                                <label class="form-check-label" for="allow_retake">
                                    Allow students to retake the quiz
                                </label>
                                <small class="form-text text-muted d-block">
                                    Students can attempt the quiz multiple times
                                </small>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-secondary">
                                <i class="fas fa-times me-2"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-plus me-2"></i>Create Quiz
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quiz Creation Tips -->
            <div class="card mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-lightbulb me-2"></i>Quiz Creation Tips</h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Create clear, concise questions that test specific knowledge</li>
                        <li>Use a mix of question types (multiple choice, true/false, etc.)</li>
                        <li>Set reasonable time limits based on question complexity</li>
                        <li>Ensure passing marks are achievable but challenging</li>
                        <li>Consider allowing retakes for learning purposes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validate passing marks against total marks
document.getElementById('total_marks').addEventListener('input', function() {
    const totalMarks = parseInt(this.value) || 0;
    const passingMarks = parseInt(document.getElementById('passing_marks').value) || 0;
    
    if (passingMarks > totalMarks) {
        document.getElementById('passing_marks').setCustomValidity('Passing marks cannot exceed total marks');
    } else {
        document.getElementById('passing_marks').setCustomValidity('');
    }
});

document.getElementById('passing_marks').addEventListener('input', function() {
    const totalMarks = parseInt(document.getElementById('total_marks').value) || 0;
    const passingMarks = parseInt(this.value) || 0;
    
    if (passingMarks > totalMarks) {
        this.setCustomValidity('Passing marks cannot exceed total marks');
    } else {
        this.setCustomValidity('');
    }
});
</script>
@endsection
