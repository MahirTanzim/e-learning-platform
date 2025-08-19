@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-success">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="text-success mb-3">Payment Successful!</h2>
                    <p class="lead mb-4">Congratulations! You are now enrolled in <strong>{{ $course->title }}</strong></p>
                    
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle me-2"></i>What's Next?</h6>
                        <ul class="list-unstyled mb-0">
                            <li><i class="fas fa-play text-primary me-2"></i>Start watching course videos</li>
                            <li><i class="fas fa-question-circle text-primary me-2"></i>Take quizzes to test your knowledge</li>
                            <li><i class="fas fa-tasks text-primary me-2"></i>Complete assignments for hands-on practice</li>
                            <li><i class="fas fa-certificate text-primary me-2"></i>Earn your certificate upon completion</li>
                        </ul>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('student.courses.show', $course) }}" class="btn btn-success btn-lg me-md-2">
                            <i class="fas fa-play me-2"></i>Start Learning
                        </a>
                        <a href="{{ route('student.dashboard') }}" class="btn btn-outline-primary btn-lg">
                            <i class="fas fa-tachometer-alt me-2"></i>Go to Dashboard
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <small class="text-muted">
                            A confirmation email has been sent to your registered email address.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
