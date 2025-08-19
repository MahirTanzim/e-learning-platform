@extends('layouts.app')

@section('title', 'Payment Failed')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-danger">
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-danger" style="font-size: 4rem;"></i>
                    </div>
                    
                    <h2 class="text-danger mb-3">Payment Failed</h2>
                    <p class="lead mb-4">We're sorry, but there was an issue processing your payment for <strong>{{ $course->title }}</strong></p>
                    
                    <div class="alert alert-warning">
                        <h6><i class="fas fa-exclamation-triangle me-2"></i>Possible Reasons:</h6>
                        <ul class="list-unstyled mb-0">
                            <li><i class="fas fa-credit-card text-warning me-2"></i>Insufficient funds in your account</li>
                            <li><i class="fas fa-shield-alt text-warning me-2"></i>Card declined by your bank</li>
                            <li><i class="fas fa-exclamation text-warning me-2"></i>Invalid card information</li>
                            <li><i class="fas fa-clock text-warning me-2"></i>Payment gateway timeout</li>
                        </ul>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="{{ route('student.courses.payment', $course) }}" class="btn btn-primary btn-lg me-md-2">
                            <i class="fas fa-redo me-2"></i>Try Again
                        </a>
                        <a href="{{ route('student.courses.show', $course) }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>Back to Course
                        </a>
                    </div>
                    
                    <div class="mt-4">
                        <small class="text-muted">
                            If the problem persists, please contact our support team or try using a different payment method.
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
