
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
    .admin-notif {
        position: absolute;
        top: 2rem;
        left: 2rem;
        z-index: 2;
    }
    .notif-bell {
        font-size: 1.7rem;
        color: #fff;
        cursor: pointer;
        position: relative;
    }
    .notif-dot {
        position: absolute;
        top: 0;
        right: -4px;
        width: 10px;
        height: 10px;
        background: #ff7b7b;
        border-radius: 50%;
        border: 2px solid #fff;
        animation: pulse 1.8s infinite;
    }
    @keyframes pulse { 0% { box-shadow:0 0 0 0 rgba(255,123,123,0.4);} 70% { box-shadow:0 0 0 8px rgba(255,123,123,0);} 100% { box-shadow:0 0 0 0 rgba(255,123,123,0);} }
    .dark-mode {
        background: #181a1b !important;
        color: #e0e0e0 !important;
    }
    .dark-mode .admin-card, .dark-mode .list-group-item {
        background: #23272b !important;
        color: #e0e0e0 !important;
    }
    .dark-toggle {
        position: absolute;
        top: 2rem;
        right: 5.5rem;
        z-index: 2;
    }
    .search-bar {
        width: 320px;
        max-width: 100%;
        margin-bottom: 1.5rem;
    }
    .profile-widget {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(102,126,234,0.08);
        padding: 1rem 1.5rem;
        margin-bottom: 2rem;
    }
    .profile-widget img {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #764ba2;
    }
    .profile-widget .name {
        font-weight: 600;
        font-size: 1.2rem;
    }
    .profile-widget .role {
        color: #764ba2;
        font-size: 0.95rem;
    }
    .recent-table th, .recent-table td {
        vertical-align: middle;
    }
    .recent-table tr {
        transition: background 0.2s;
    }
    .recent-table tr:hover {
        background: #f7fafc;
    }
</style>
@endpush

@section('content')

<div class="container py-5" id="adminDashboard">
    <!-- Notification Bell & Dark Mode Toggle -->
    <div class="admin-notif">
        <span class="notif-bell position-relative" id="notifBell">
            <i class="fa fa-bell"></i>
            <span class="notif-dot" title="3 new"></span>
        </span>
    </div>
    <div class="dark-toggle">
        <button class="btn btn-outline-light btn-sm" id="darkModeBtn"><i class="fa fa-moon"></i></button>
    </div>

    <!-- Profile Widget -->
    <div class="profile-widget">
        <img src="{{ auth()->user()->avatar_url ?? 'https://i.pravatar.cc/100?img=1' }}" alt="Admin Avatar">
        <div>
            <div class="name">{{ auth()->user()->name ?? 'Admin' }}</div>
            <div class="role">Administrator</div>
        </div>
        <a href="#" class="btn btn-outline-primary btn-sm ms-auto">Settings</a>
    </div>

    <!-- Search Bar -->
    <input type="text" class="form-control search-bar" placeholder="Search users, courses, complaints..." id="adminSearch">

    <!-- Analytics Chart -->
    <div class="card admin-card mb-4 p-4">
        <h5 class="admin-section-title mb-3"><i class="fa fa-chart-line me-2"></i>Platform Analytics</h5>
        <canvas id="adminChart" height="80"></canvas>
    </div>

    <!-- Quick Stats -->
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

    <!-- Recent Complaints Table -->
    <div class="card admin-card p-4 mb-4">
        <h5 class="admin-section-title mb-3"><i class="fa fa-exclamation-circle me-2"></i>Recent Complaints</h5>
        <div class="table-responsive">
            <table class="table recent-table align-middle">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>User</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Course Issue</td>
                        <td>Jane Doe</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>2025-08-18</td>
                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a> <a href="#" class="btn btn-sm btn-outline-success">Resolve</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Payment Problem</td>
                        <td>John Smith</td>
                        <td><span class="badge bg-success">Resolved</span></td>
                        <td>2025-08-17</td>
                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Content Error</td>
                        <td>Emily Clark</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td>2025-08-16</td>
                        <td><a href="#" class="btn btn-sm btn-outline-primary">View</a> <a href="#" class="btn btn-sm btn-outline-success">Resolve</a></td>
                    </tr>
                </tbody>
            </table>
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

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
// Chart.js demo data
const ctx = document.getElementById('adminChart').getContext('2d');
const adminChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug'],
        datasets: [
            { label: 'Users', data: [120, 150, 180, 210, 250], borderColor: '#667eea', backgroundColor: 'rgba(102,126,234,0.1)', tension: 0.4 },
            { label: 'Courses', data: [10, 15, 18, 22, 25], borderColor: '#764ba2', backgroundColor: 'rgba(118,75,162,0.1)', tension: 0.4 }
        ]
    },
    options: { responsive: true, plugins: { legend: { display: true } } }
});

// Dark mode toggle
const darkBtn = document.getElementById('darkModeBtn');
darkBtn.addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
});

// Notification bell click
document.getElementById('notifBell').addEventListener('click', function() {
    alert('You have 3 new notifications!');
});
</script>
@endpush
@endsection
