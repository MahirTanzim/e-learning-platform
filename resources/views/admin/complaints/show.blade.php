@extends('layouts.admin')

@section('title', 'Complaint Details')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Complaint Details</h1>
                <a href="{{ route('admin.complaints.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i>Back to Complaints
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <!-- Complaint Information -->
                <div class="col-lg-8">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Complaint Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <strong>Subject:</strong>
                                    <p class="mb-0">{{ $complaint->subject }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Status:</strong>
                                    <p class="mb-0">
                                        @if($complaint->status === 'pending')
                                            <span class="badge bg-warning">Pending</span>
                                        @elseif($complaint->status === 'in_progress')
                                            <span class="badge bg-info">In Progress</span>
                                        @elseif($complaint->status === 'resolved')
                                            <span class="badge bg-success">Resolved</span>
                                        @else
                                            <span class="badge bg-secondary">Closed</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Description:</strong>
                                <p class="mb-0">{{ $complaint->description }}</p>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Filed:</strong>
                                    <p class="mb-0">{{ $complaint->created_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <strong>Last Updated:</strong>
                                    <p class="mb-0">{{ $complaint->updated_at->format('F d, Y \a\t g:i A') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Response Form -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Update Complaint</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.complaints.update', $complaint) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                        <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="in_progress" {{ $complaint->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                        <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                        <option value="closed" {{ $complaint->status === 'closed' ? 'selected' : '' }}>Closed</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="admin_response" class="form-label">Admin Response</label>
                                    <textarea class="form-control @error('admin_response') is-invalid @enderror" 
                                              id="admin_response" name="admin_response" rows="4" 
                                              placeholder="Provide a response to the complainant...">{{ old('admin_response', $complaint->admin_response) }}</textarea>
                                    @error('admin_response')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save me-2"></i>Update Complaint
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Complainant Information -->
                <div class="col-lg-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Complainant Information</h6>
                        </div>
                        <div class="card-body text-center">
                            <img src="{{ $complaint->complainant->avatar_url }}" 
                                 alt="{{ $complaint->complainant->name }}" 
                                 class="rounded-circle mb-3" style="width: 100px; height: 100px;">
                            <h5 class="mb-2">{{ $complaint->complainant->name }}</h5>
                            <p class="text-muted mb-3">{{ $complaint->complainant->email }}</p>
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <h6 class="mb-1">
                                        @if($complaint->complainant->role === 'admin')
                                            <span class="badge bg-danger">Admin</span>
                                        @elseif($complaint->complainant->role === 'teacher')
                                            <span class="badge bg-success">Teacher</span>
                                        @else
                                            <span class="badge bg-primary">Student</span>
                                        @endif
                                    </h6>
                                    <small class="text-muted">Role</small>
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">
                                        @if($complaint->complainant->status === 'active')
                                            <span class="badge bg-success">Active</span>
                                        @elseif($complaint->complainant->status === 'inactive')
                                            <span class="badge bg-secondary">Inactive</span>
                                        @else
                                            <span class="badge bg-warning">Suspended</span>
                                        @endif
                                    </h6>
                                    <small class="text-muted">Status</small>
                                </div>
                            </div>
                            
                            <hr>
                            <div class="row text-center">
                                <div class="col-6">
                                    <h6 class="mb-1">{{ $complaint->complainant->created_at->format('M d, Y') }}</h6>
                                    <small class="text-muted">Joined</small>
                                </div>
                                <div class="col-6">
                                    <h6 class="mb-1">{{ $complaint->complainant->last_login_at ? $complaint->complainant->last_login_at->format('M d, Y') : 'Never' }}</h6>
                                    <small class="text-muted">Last Login</small>
                                </div>
                            </div>
                            
                            <div class="mt-3">
                                <a href="{{ route('admin.users.show', $complaint->complainant) }}" class="btn btn-outline-primary btn-sm">
                                    View Full Profile
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Complaint History -->
                    <div class="card shadow">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Complaint History</h6>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-marker bg-primary"></div>
                                    <div class="timeline-content">
                                        <h6 class="mb-1">Complaint Filed</h6>
                                        <p class="text-muted mb-0">{{ $complaint->created_at->format('M d, Y g:i A') }}</p>
                                    </div>
                                </div>
                                
                                @if($complaint->updated_at != $complaint->created_at)
                                    <div class="timeline-item">
                                        <div class="timeline-marker bg-info"></div>
                                        <div class="timeline-content">
                                            <h6 class="mb-1">Last Updated</h6>
                                            <p class="text-muted mb-0">{{ $complaint->updated_at->format('M d, Y g:i A') }}</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
    margin-bottom: 20px;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    top: 5px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.timeline-item:not(:last-child)::before {
    content: '';
    position: absolute;
    left: -29px;
    top: 17px;
    width: 2px;
    height: calc(100% + 10px);
    background-color: #e3e6f0;
}

.timeline-content h6 {
    font-size: 0.875rem;
    margin-bottom: 0.25rem;
}

.timeline-content p {
    font-size: 0.75rem;
}
</style>
@endsection
