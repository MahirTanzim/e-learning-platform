@extends('layouts.admin')

@section('title', 'User Management')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="h3 mb-0">User Management</h1>
                <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-2"></i>Add New User
                </a>
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
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Courses</th>
                                    <th>Enrollments</th>
                                    <th>Joined</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $user->avatar_url }}" alt="{{ $user->name }}" 
                                                     class="rounded-circle me-3" style="width: 40px; height: 40px;">
                                                <div>
                                                    <h6 class="mb-0">{{ $user->name }}</h6>
                                                    <small class="text-muted">ID: {{ $user->id }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if($user->role === 'admin')
                                                <span class="badge bg-danger">Admin</span>
                                            @elseif($user->role === 'teacher')
                                                <span class="badge bg-success">Teacher</span>
                                            @else
                                                <span class="badge bg-primary">Student</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->status === 'active')
                                                <span class="badge bg-success">Active</span>
                                            @elseif($user->status === 'inactive')
                                                <span class="badge bg-secondary">Inactive</span>
                                            @else
                                                <span class="badge bg-warning">Suspended</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->role === 'teacher')
                                                <span class="badge bg-info">{{ $user->courses_count }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->role === 'student')
                                                <span class="badge bg-info">{{ $user->enrollments_count }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('admin.users.show', $user) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.users.edit', $user) }}" 
                                                   class="btn btn-sm btn-outline-secondary">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                @if($user->status === 'active')
                                                    <form action="{{ route('admin.users.suspend', $user) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-warning" 
                                                                onclick="return confirm('Are you sure you want to suspend this user?')">
                                                            <i class="fas fa-ban"></i>
                                                        </button>
                                                    </form>
                                                @else
                                                    <form action="{{ route('admin.users.activate', $user) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit" class="btn btn-sm btn-outline-success">
                                                            <i class="fas fa-check"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.users.destroy', $user) }}" 
                                                      method="POST" class="d-inline"
                                                      onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
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
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
