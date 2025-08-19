@extends('layouts.teacher')

@section('title', $course->title)

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <!-- Course Header -->
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-2">
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" 
                                 class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <h2 class="mb-2">{{ $course->title }}</h2>
                            <p class="text-muted mb-2">{{ $course->description }}</p>
                            <div class="row">
                                <div class="col-md-3">
                                    <small class="text-muted">Status</small><br>
                                    <span class="badge bg-{{ $course->status === 'published' ? 'success' : ($course->status === 'draft' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($course->status) }}
                                    </span>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Price</small><br>
                                    <strong>${{ number_format($course->price, 2) }}</strong>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Students</small><br>
                                    <strong>{{ $course->enrollments_count ?? 0 }}</strong>
                                </div>
                                <div class="col-md-3">
                                    <small class="text-muted">Level</small><br>
                                    <strong>{{ ucfirst($course->level) }}</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 text-end">
                            <a href="{{ route('teacher.courses.edit', $course) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i> Edit Course
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Course Management Tabs -->
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="courseTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" 
                                    data-bs-target="#overview" type="button" role="tab">
                                <i class="fas fa-eye me-2"></i>Overview
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="modules-tab" data-bs-toggle="tab" 
                                    data-bs-target="#modules" type="button" role="tab">
                                <i class="fas fa-list me-2"></i>Modules ({{ $course->modules->count() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="quizzes-tab" data-bs-toggle="tab" 
                                    data-bs-target="#quizzes" type="button" role="tab">
                                <i class="fas fa-question-circle me-2"></i>Quizzes ({{ $course->quizzes->count() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="assignments-tab" data-bs-toggle="tab" 
                                    data-bs-target="#assignments" type="button" role="tab">
                                <i class="fas fa-tasks me-2"></i>Assignments ({{ $course->assignments->count() }})
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="students-tab" data-bs-toggle="tab" 
                                    data-bs-target="#students" type="button" role="tab">
                                <i class="fas fa-users me-2"></i>Students ({{ $course->enrollments->count() }})
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="courseTabContent">
                        <!-- Overview Tab -->
                        <div class="tab-pane fade show active" id="overview" role="tabpanel">
                            <div class="row">
                                <div class="col-md-8">
                                    <h5>Course Description</h5>
                                    <p>{{ $course->description }}</p>
                                    
                                    @if($course->prerequisites)
                                        <h6>Prerequisites</h6>
                                        <p>{{ $course->prerequisites }}</p>
                                    @endif
                                    
                                    @if($course->learning_outcomes)
                                        <h6>Learning Outcomes</h6>
                                        <p>{{ $course->learning_outcomes }}</p>
                                    @endif
                                    
                                    @if($course->requirements)
                                        <h6>Requirements</h6>
                                        <p>{{ $course->requirements }}</p>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="card bg-light">
                                        <div class="card-header">
                                            <h6 class="mb-0">Quick Actions</h6>
                                        </div>
                                        <div class="card-body">
                                            <a href="{{ route('teacher.courses.modules.create', $course) }}" 
                                               class="btn btn-success btn-sm w-100 mb-2">
                                                <i class="fas fa-plus me-2"></i>Add Module
                                            </a>
                                            <a href="{{ route('teacher.courses.quizzes.create', $course) }}" 
                                               class="btn btn-info btn-sm w-100 mb-2">
                                                <i class="fas fa-plus me-2"></i>Add Quiz
                                            </a>
                                            <a href="{{ route('teacher.courses.assignments.create', $course) }}" 
                                               class="btn btn-warning btn-sm w-100 mb-2">
                                                <i class="fas fa-plus me-2"></i>Add Assignment
                                            </a>
                                            @if($course->status === 'draft')
                                                <form action="{{ route('teacher.courses.update', $course) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="published">
                                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                                        <i class="fas fa-globe me-2"></i>Publish Course
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modules Tab -->
                        <div class="tab-pane fade" id="modules" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Course Modules</h5>
                                <a href="{{ route('teacher.courses.modules.create', $course) }}" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Add Module
                                </a>
                            </div>
                            
                            @if($course->modules->count() > 0)
                                <div class="accordion" id="modulesAccordion">
                                    @foreach($course->modules as $module)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="module{{ $module->id }}">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" 
                                                        type="button" data-bs-toggle="collapse" 
                                                        data-bs-target="#collapse{{ $module->id }}">
                                                    <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                                        <span><strong>Module {{ $module->order }}:</strong> {{ $module->title }}</span>
                                                        <span class="badge bg-info">{{ $module->videos->count() }} videos</span>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapse{{ $module->id }}" 
                                                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                                 data-bs-parent="#modulesAccordion">
                                                <div class="accordion-body">
                                                    <p class="mb-3">{{ $module->description }}</p>
                                                    
                                                    <!-- Videos in this module -->
                                                    <div class="mb-3">
                                                        <h6>Videos:</h6>
                                                        @if($module->videos->count() > 0)
                                                            <div class="list-group">
                                                                @foreach($module->videos as $video)
                                                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                                                        <div>
                                                                            <strong>{{ $video->title }}</strong>
                                                                            <br>
                                                                            <small class="text-muted">
                                                                                Duration: {{ $video->duration }} minutes | 
                                                                                Order: {{ $video->order }}
                                                                                @if($video->is_free)
                                                                                    | <span class="badge bg-success">Free</span>
                                                                                @endif
                                                                            </small>
                                                                        </div>
                                                                        <div>
                                                                            <a href="{{ route('teacher.courses.videos.edit', [$course, $module, $video]) }}" 
                                                                               class="btn btn-sm btn-outline-primary">
                                                                                <i class="fas fa-edit"></i>
                                                                            </a>
                                                                            <form action="{{ route('teacher.courses.videos.destroy', [$course, $module, $video]) }}" 
                                                                                  method="POST" class="d-inline">
                                                                                @csrf
                                                                                @method('DELETE')
                                                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                                        onclick="return confirm('Are you sure?')">
                                                                                    <i class="fas fa-trash"></i>
                                                                                </button>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            <p class="text-muted">No videos in this module yet.</p>
                                                        @endif
                                                        
                                                        <a href="{{ route('teacher.courses.videos.create', [$course, $module]) }}" 
                                                           class="btn btn-sm btn-outline-success mt-2">
                                                            <i class="fas fa-plus me-2"></i>Add Video
                                                        </a>
                                                    </div>
                                                    
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('teacher.courses.modules.edit', [$course, $module]) }}" 
                                                           class="btn btn-sm btn-outline-primary">
                                                            <i class="fas fa-edit me-2"></i>Edit Module
                                                        </a>
                                                        <form action="{{ route('teacher.courses.modules.destroy', [$course, $module]) }}" 
                                                              method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                    onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-trash me-2"></i>Delete Module
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-list fa-3x text-muted mb-3"></i>
                                    <h5>No modules yet</h5>
                                    <p class="text-muted">Start building your course by adding modules.</p>
                                    <a href="{{ route('teacher.courses.modules.create', $course) }}" class="btn btn-success">
                                        <i class="fas fa-plus me-2"></i>Add Your First Module
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Quizzes Tab -->
                        <div class="tab-pane fade" id="quizzes" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Course Quizzes</h5>
                                <a href="{{ route('teacher.courses.quizzes.create', $course) }}" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Add Quiz
                                </a>
                            </div>
                            
                            @if($course->quizzes->count() > 0)
                                <div class="row">
                                    @foreach($course->quizzes as $quiz)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $quiz->title }}</h6>
                                                    <p class="card-text text-muted">{{ $quiz->description }}</p>
                                                    <div class="row text-center mb-3">
                                                        <div class="col-4">
                                                            <small class="text-muted">Time Limit</small><br>
                                                            <strong>{{ $quiz->time_limit ? $quiz->time_limit . ' min' : 'No limit' }}</strong>
                                                        </div>
                                                        <div class="col-4">
                                                            <small class="text-muted">Total Marks</small><br>
                                                            <strong>{{ $quiz->total_marks }}</strong>
                                                        </div>
                                                        <div class="col-4">
                                                            <small class="text-muted">Passing</small><br>
                                                            <strong>{{ $quiz->passing_marks }}</strong>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <a href="{{ route('teacher.courses.quizzes.show', [$course, $quiz]) }}" 
                                                           class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-eye me-2"></i>View
                                                        </a>
                                                        <div>
                                                            <a href="{{ route('teacher.courses.quizzes.edit', [$course, $quiz]) }}" 
                                                               class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('teacher.courses.quizzes.destroy', [$course, $quiz]) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                        onclick="return confirm('Are you sure?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-question-circle fa-3x text-muted mb-3"></i>
                                    <h5>No quizzes yet</h5>
                                    <p class="text-muted">Add quizzes to test your students' knowledge.</p>
                                    <a href="{{ route('teacher.courses.quizzes.create', $course) }}" class="btn btn-success">
                                        <i class="fas fa-plus me-2"></i>Add Your First Quiz
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Assignments Tab -->
                        <div class="tab-pane fade" id="assignments" role="tabpanel">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5>Course Assignments</h5>
                                <a href="{{ route('teacher.courses.assignments.create', $course) }}" class="btn btn-success">
                                    <i class="fas fa-plus me-2"></i>Add Assignment
                                </a>
                            </div>
                            
                            @if($course->assignments->count() > 0)
                                <div class="row">
                                    @foreach($course->assignments as $assignment)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ $assignment->title }}</h6>
                                                    <p class="card-text text-muted">{{ Str::limit($assignment->description, 100) }}</p>
                                                    <div class="row text-center mb-3">
                                                        <div class="col-6">
                                                            <small class="text-muted">Due Date</small><br>
                                                            <strong>{{ $assignment->due_date->format('M d, Y') }}</strong>
                                                        </div>
                                                        <div class="col-6">
                                                            <small class="text-muted">Total Marks</small><br>
                                                            <strong>{{ $assignment->total_marks }}</strong>
                                                        </div>
                                                    </div>
                                                    @if($assignment->attachment)
                                                        <div class="mb-3">
                                                            <small class="text-muted">Attachment:</small><br>
                                                            <a href="{{ asset('storage/' . $assignment->attachment) }}" 
                                                               target="_blank" class="btn btn-sm btn-outline-secondary">
                                                                <i class="fas fa-download me-2"></i>Download
                                                            </a>
                                                        </div>
                                                    @endif
                                                    <div class="d-flex justify-content-between">
                                                        <span class="badge bg-{{ $assignment->due_date->isPast() ? 'danger' : 'success' }}">
                                                            {{ $assignment->due_date->isPast() ? 'Overdue' : 'Active' }}
                                                        </span>
                                                        <div>
                                                            <a href="{{ route('teacher.courses.assignments.edit', [$course, $assignment]) }}" 
                                                               class="btn btn-sm btn-outline-primary">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <form action="{{ route('teacher.courses.assignments.destroy', [$course, $assignment]) }}" 
                                                                  method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                                        onclick="return confirm('Are you sure?')">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                                    <h5>No assignments yet</h5>
                                    <p class="text-muted">Add assignments to give your students practical work.</p>
                                    <a href="{{ route('teacher.courses.assignments.create', $course) }}" class="btn btn-success">
                                        <i class="fas fa-plus me-2"></i>Add Your First Assignment
                                    </a>
                                </div>
                            @endif
                        </div>

                        <!-- Students Tab -->
                        <div class="tab-pane fade" id="students" role="tabpanel">
                            <h5>Enrolled Students</h5>
                            
                            @if($course->enrollments->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Student</th>
                                                <th>Enrolled Date</th>
                                                <th>Progress</th>
                                                <th>Status</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($course->enrollments as $enrollment)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <img src="{{ $enrollment->student->avatar_url }}" 
                                                                 alt="{{ $enrollment->student->name }}" 
                                                                 class="rounded-circle me-2" style="width: 32px; height: 32px;">
                                                            <div>
                                                                <strong>{{ $enrollment->student->name }}</strong><br>
                                                                <small class="text-muted">{{ $enrollment->student->email }}</small>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $enrollment->enrolled_at->format('M d, Y') }}</td>
                                                    <td>
                                                        <div class="progress" style="height: 20px;">
                                                            <div class="progress-bar" role="progressbar" 
                                                                 style="width: {{ $enrollment->progress ?? 0 }}%">
                                                                {{ $enrollment->progress ?? 0 }}%
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        @if($enrollment->completed_at)
                                                            <span class="badge bg-success">Completed</span>
                                                        @else
                                                            <span class="badge bg-warning">In Progress</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-outline-info">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5>No students enrolled yet</h5>
                                    <p class="text-muted">Students will appear here once they enroll in your course.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
