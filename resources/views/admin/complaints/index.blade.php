@extends('layouts.admin')

@section('title', 'Complaint Management')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">Complaint Management</h1>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Complainant</th>
                                    <th>Subject</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Filed</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($complaints as $complaint)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $complaint->complainant->avatar_url }}" 
                                                     alt="{{ $complaint->complainant->name }}" 
                                                     class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                                <div>
                                                    <h6 class="mb-0">{{ $complaint->complainant->name }}</h6>
                                                    <small class="text-muted">{{ $complaint->complainant->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6 class="mb-0">{{ $complaint->subject }}</h6>
                                        </td>
                                        <td>
                                            <p class="text-muted mb-0">{{ Str::limit($complaint->description, 100) }}</p>
                                        </td>
                                        <td>
                                            @if($complaint->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($complaint->status === 'in_progress')
                                                <span class="badge bg-info">In Progress</span>
                                            @elseif($complaint->status === 'resolved')
                                                <span class="badge bg-success">Resolved</span>
                                            @else
                                                <span class="badge bg-secondary">Closed</span>
                                            @endif
                                        </td>
                                        <td>{{ $complaint->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.complaints.show', $complaint) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <form action="{{ route('admin.complaints.destroy', $complaint) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this complaint?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $complaints->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
