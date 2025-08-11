{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('content')
<style>
    /* Dashboard styling */
    .card {
        transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        border-radius: 15px;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0px 8px 20px rgba(0,0,0,0.1);
    }
    .stat-number {
        font-size: 2rem;
        font-weight: bold;
    }
    .fade-in {
        animation: fadeIn 1s ease-in-out;
    }
    @keyframes fadeIn {
        0% {opacity: 0;}
        100% {opacity: 1;}
    }
</style>

<div class="container mt-5 fade-in">
    <h1 class="mb-4">Admin Dashboard</h1>

    {{-- Statistics Row --}}
    <div class="row text-center">
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <div class="stat-number text-primary">{{ $userCount ?? '0' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-header">Total Courses</div>
                <div class="card-body">
                    <div class="stat-number text-success">{{ $courseCount ?? '0' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-header">Admins</div>
                <div class="card-body">
                    <div class="stat-number text-info">{{ $adminCount ?? '0' }}</div>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card bg-light">
                <div class="card-header">Reviews</div>
                <div class="card-body">
                    <div class="stat-number text-warning">{{ $reviewCount ?? '0' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Users & Courses --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Recent Users</div>
                <ul class="list-group list-group-flush">
                    @forelse($recentUsers ?? [] as $user)
                        <li class="list-group-item">
                            {{ $user->name }} - 
                            <span class="badge bg-{{ $user->role === 'Teacher' ? 'info' : 'secondary' }}">
                                {{ $user->role }}
                            </span>
                        </li>
                    @empty
                        <li class="list-group-item">No recent users.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Recent Courses</div>
                <ul class="list-group list-group-flush">
                    @forelse($recentCourses ?? [] as $course)
                        <li class="list-group-item">{{ $course->title }} ({{ $course->subject }})</li>
                    @empty
                        <li class="list-group-item">No recent courses.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- Reviews & Suggestions --}}
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Teacher Reviews & Tips</div>
                <ul class="list-group list-group-flush">
                    @forelse($teacherReviews ?? [] as $review)
                        <li class="list-group-item">
                            <strong>{{ $review->teacher_name }}:</strong> {{ $review->comment }}
                        </li>
                    @empty
                        <li class="list-group-item">No teacher reviews yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Student Reviews & Suggestions</div>
                <ul class="list-group list-group-flush">
                    @forelse($studentReviews ?? [] as $review)
                        <li class="list-group-item">
                            <strong>{{ $review->student_name }}:</strong> {{ $review->comment }}
                        </li>
                    @empty
                        <li class="list-group-item">No student reviews yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    {{-- Tips Section --}}
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card bg-light">
                <div class="card-header">General Tips</div>
                <div class="card-body">
                    <ul>
                        @forelse($tips ?? [] as $tip)
                            <li>{{ $tip }}</li>
                        @empty
                            <li>No tips available at the moment.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
