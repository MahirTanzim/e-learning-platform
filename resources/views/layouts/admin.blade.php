
@extends('layouts.app')

@section('title', 'Admin Panel')

@push('styles')
<style>
    .admin-hero {
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        color: #fff;
        border-radius: 1rem;
        box-shadow: 0 8px 32px rgba(102,126,234,0.12);
        padding: 2.5rem 2rem 2rem 2rem;
        margin-bottom: 2.5rem;
        position: relative;
        overflow: hidden;
    }
    .admin-hero .fa-cogs {
        font-size: 2.5rem;
        opacity: 0.2;
        position: absolute;
        right: 2rem;
        top: 2rem;
    }
    .admin-card {
        border: none;
        border-radius: 1rem;
        background: linear-gradient(135deg, #f7fafc 60%, #e9e4f0 100%);
        box-shadow: 0 4px 16px rgba(102,126,234,0.08);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .admin-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(102,126,234,0.16);
    }
    .admin-card .icon {
        font-size: 2.2rem;
        margin-bottom: 0.5rem;
        color: #764ba2;
    }
    .admin-section-title {
        font-weight: 600;
        color: #667eea;
        margin-bottom: 1rem;
    }
    .list-group-item {
        border: none;
        border-radius: 0.5rem;
        margin-bottom: 0.5rem;
        background: #f7fafc;
        transition: background 0.2s;
    }
    .list-group-item:hover {
        background: #e9e4f0;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="admin-hero mb-5">
        <h1 class="mb-2">Welcome, Admin!</h1>
        <p class="lead mb-0">Monitor, manage, and grow your platform with powerful tools and insights.</p>
        <i class="fa fa-cogs"></i>
    </div>
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card admin-card text-center p-3">
                <div class="icon mb-2"><i class="fa fa-users"></i></div>
                <h6>Users</h6>
                <div class="display-6 fw-bold">{{ $userCount ?? '--' }}</div>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Manage</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card admin-card text-center p-3">
                <div class="icon mb-2"><i class="fa fa-book"></i></div>
                <h6>Courses</h6>
                <div class="display-6 fw-bold">{{ $courseCount ?? '--' }}</div>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">Manage</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card admin-card text-center p-3">
                <div class="icon mb-2"><i class="fa fa-exclamation-triangle"></i></div>
                <h6>Complaints</h6>
                <div class="display-6 fw-bold">{{ $complaintCount ?? '--' }}</div>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">View</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card admin-card text-center p-3">
                <div class="icon mb-2"><i class="fa fa-star"></i></div>
                <h6>Reviews</h6>
                <div class="display-6 fw-bold">{{ $reviewCount ?? '--' }}</div>
                <a href="#" class="btn btn-outline-primary btn-sm mt-2">View</a>
            </div>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-6">
            <div class="card admin-card p-4">
                <h5 class="admin-section-title"><i class="fa fa-bolt me-2"></i>Quick Actions</h5>
                <ul class="list-group mb-3">
                    <li class="list-group-item"><a href="#"><i class="fa fa-plus-circle me-2 text-success"></i>Add New Course</a></li>
                    <li class="list-group-item"><a href="#"><i class="fa fa-user-check me-2 text-primary"></i>Approve Teacher</a></li>
                    <li class="list-group-item"><a href="#"><i class="fa fa-bullhorn me-2 text-warning"></i>Send Announcement</a></li>
                    <li class="list-group-item"><a href="#"><i class="fa fa-users me-2 text-info"></i>View All Users</a></li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card admin-card p-4">
                <h5 class="admin-section-title"><i class="fa fa-history me-2"></i>Recent Activity</h5>
                <ul class="list-group mb-3">
                    <li class="list-group-item">User <b>John Doe</b> registered</li>
                    <li class="list-group-item">Course <b>Web Development</b> added</li>
                    <li class="list-group-item">Complaint received from <b>Jane</b></li>
                    <li class="list-group-item">Review approved for <b>Data Structures</b></li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
