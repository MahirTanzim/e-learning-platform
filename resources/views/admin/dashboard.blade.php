@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container-fluid py-4">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                            <p class="mb-0">Manage your e-learning platform and monitor system performance.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <i class="fas fa-shield-alt fa-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Users
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Courses
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCourses }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Enrollments
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalEnrollments }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Complaints
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingComplaints }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-exclamation-triangle fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Statistics -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">User Statistics</h6>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-primary">
                        View All Users
                    </a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 text-center mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-user-graduate fa-2x text-primary mb-2"></i>
                                <h4 class="mb-1">{{ $studentCount }}</h4>
                                <p class="text-muted mb-0">Students</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-chalkboard-teacher fa-2x text-success mb-2"></i>
                                <h4 class="mb-1">{{ $teacherCount }}</h4>
                                <p class="text-muted mb-0">Teachers</p>
                            </div>
                        </div>
                        <div class="col-md-4 text-center mb-3">
                            <div class="border rounded p-3">
                                <i class="fas fa-user-shield fa-2x text-warning mb-2"></i>
                                <h4 class="mb-1">{{ $adminCount }}</h4>
                                <p class="text-muted mb-0">Admins</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item d-flex align-items-center">
                            <i class="fas fa-user-plus text-success me-3"></i>
                            <div>
                                <small class="text-muted">New user registered</small>
                                <div class="fw-bold">{{ $recentUsers->first()->name ?? 'No recent activity' }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="fas fa-book text-primary me-3"></i>
                            <div>
                                <small class="text-muted">New course created</small>
                                <div class="fw-bold">{{ $recentCourses->first()->title ?? 'No recent activity' }}</div>
                            </div>
                        </div>
                        <div class="list-group-item d-flex align-items-center">
                            <i class="fas fa-graduation-cap text-info me-3"></i>
                            <div>
                                <small class="text-muted">New enrollment</small>
                                <div class="fw-bold">{{ $recentEnrollments->count() > 0 ? 'Student enrolled' : 'No recent activity' }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Course Management & Complaints -->
    <div class="row mb-4">
        <!-- Course Management -->
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Course Management</h6>
                    <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-primary">
                        Manage Courses
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Course</th>
                                    <th>Teacher</th>
                                    <th>Status</th>
                                    <th>Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentCourses as $course)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @if($course->thumbnail)
                                                    <img src="{{ asset('storage/' . $course->thumbnail) }}" 
                                                         alt="{{ $course->title }}" class="rounded me-2" 
                                                         style="width: 40px; height: 30px; object-fit: cover;">
                                                @else
                                                    <div class="bg-light rounded me-2 d-flex align-items-center justify-content-center" 
                                                         style="width: 40px; height: 30px;">
                                                        <i class="fas fa-book text-muted"></i>
                                                    </div>
                                                @endif
                                                <span>{{ $course->title }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $course->teacher->name }}</td>
                                        <td>
                                            <span class="badge bg-{{ $course->status === 'published' ? 'success' : 'warning' }}">
                                                {{ ucfirst($course->status) }}
                                            </span>
                                        </td>
                                        <td>{{ $course->enrollments()->count() }}</td>
                                        <td>
                                            <a href="{{ route('admin.courses.show', $course) }}" 
                                               class="btn btn-sm btn-outline-primary">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4">
                                            <i class="fas fa-book fa-2x text-muted mb-3"></i>
                                            <p class="text-muted">No courses available.</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Complaints -->
        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Complaints</h6>
                    <a href="{{ route('admin.complaints.index') }}" class="btn btn-sm btn-primary">
                        View All
                    </a>
                </div>
                <div class="card-body">
                    @if($recentComplaints->count() > 0)
                        @foreach($recentComplaints as $complaint)
                            <div class="border-bottom pb-3 mb-3">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-1">{{ $complaint->subject }}</h6>
                                    <span class="badge bg-{{ $complaint->status === 'pending' ? 'warning' : 'success' }}">
                                        {{ ucfirst($complaint->status) }}
                                    </span>
                                </div>
                                <p class="text-muted mb-2">{{ Str::limit($complaint->description, 80) }}</p>
                                <small class="text-muted">
                                    By {{ $complaint->complainant->name }} • {{ $complaint->created_at->diffForHumans() }}
                                </small>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-check-circle fa-2x text-success mb-3"></i>
                            <p class="text-muted">No pending complaints.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions & System Info -->
    <div class="row">
        <!-- Quick Actions -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.users.create') }}" class="btn btn-outline-primary w-100 mb-2">
                                <i class="fas fa-user-plus me-2"></i>Add User
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.courses.index') }}" class="btn btn-outline-success w-100 mb-2">
                                <i class="fas fa-book me-2"></i>Manage Courses
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.complaints.index') }}" class="btn btn-outline-warning w-100 mb-2">
                                <i class="fas fa-exclamation-triangle me-2"></i>Handle Complaints
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="#" class="btn btn-outline-info w-100 mb-2">
                                <i class="fas fa-chart-bar me-2"></i>View Reports
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Information -->
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">System Information</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-server fa-2x text-primary mb-2"></i>
                                <h5 class="mb-1">Laravel</h5>
                                <small class="text-muted">v{{ app()->version() }}</small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-database fa-2x text-success mb-2"></i>
                                <h5 class="mb-1">Database</h5>
                                <small class="text-muted">MySQL</small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-clock fa-2x text-info mb-2"></i>
                                <h5 class="mb-1">Uptime</h5>
                                <small class="text-muted">{{ now()->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="border rounded p-3 text-center">
                                <i class="fas fa-shield-alt fa-2x text-warning mb-2"></i>
                                <h5 class="mb-1">Status</h5>
                                <small class="text-success">Online</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.border-left-primary {
    border-left: 0.25rem solid #667eea !important;
}

.border-left-success {
    border-left: 0.25rem solid #28a745 !important;
}

.border-left-info {
    border-left: 0.25rem solid #17a2b8 !important;
}

.border-left-warning {
    border-left: 0.25rem solid #ffc107 !important;
}

.card {
    border: none;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.card:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}
</style>
@endsection