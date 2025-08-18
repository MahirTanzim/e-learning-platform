@extends('layouts.app')

@section('title', 'Admin Panel')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-body p-4">
                    <h2 class="mb-4 text-primary"><i class="fa fa-cogs me-2"></i>Admin Dashboard</h2>
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="card text-center bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Users</h5>
                                    <p class="card-text display-6">{{ $userCount ?? '--' }}</p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Courses</h5>
                                    <p class="card-text display-6">{{ $courseCount ?? '--' }}</p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">Manage</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Complaints</h5>
                                    <p class="card-text display-6">{{ $complaintCount ?? '--' }}</p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card text-center bg-light">
                                <div class="card-body">
                                    <h5 class="card-title">Reviews</h5>
                                    <p class="card-text display-6">{{ $reviewCount ?? '--' }}</p>
                                    <a href="#" class="btn btn-outline-primary btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Quick Actions</h5>
                            <ul class="list-group mb-3">
                                <li class="list-group-item"><a href="#">Add New Course</a></li>
                                <li class="list-group-item"><a href="#">Approve Teacher</a></li>
                                <li class="list-group-item"><a href="#">Send Announcement</a></li>
                                <li class="list-group-item"><a href="#">View All Users</a></li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h5>Recent Activity</h5>
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
        </div>
    </div>
</div>
@endsection
