<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1rem;
            border-radius: 8px;
            margin: 0.2rem 0;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: white;
            background: rgba(255,255,255,0.1);
            transform: translateX(5px);
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .stats-card-success {
            background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%);
            color: white;
        }
        .stats-card-info {
            background: linear-gradient(135deg, #2196F3 0%, #1976D2 100%);
            color: white;
        }
        .stats-card-warning {
            background: linear-gradient(135deg, #FF9800 0%, #F57C00 100%);
            color: white;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-3 col-lg-2 d-md-block sidebar p-0">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD" height="40" class="mb-2">
                        <h5 class="text-white">Admin Panel</h5>
                        <small class="text-light">Welcome, {{ Auth::user()->name }}</small>
                    </div>
                    
                    <ul class="nav flex-column px-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users me-2"></i>Users Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-book me-2"></i>Courses Management
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chalkboard-teacher me-2"></i>Teachers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-graduation-cap me-2"></i>Students
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-chart-bar me-2"></i>Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li class="nav-item mt-3">
                            <a class="nav-link" href="{{ url('/') }}">
                                <i class="fas fa-home me-2"></i>Back to Website
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn nav-link text-start w-100 border-0 bg-transparent">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">
                        <i class="fas fa-tachometer-alt me-2 text-primary"></i>Admin Dashboard
                    </h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary">
                                <i class="fas fa-download me-1"></i>Export Report
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card text-center">
                            <div class="card-body">
                                <i class="fas fa-users fa-2x mb-3"></i>
                                <h5 class="card-title">Total Users</h5>
                                <h2 class="fw-bold">{{ \App\Models\User::count() }}</h2>
                                <small>All registered users</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card-success text-center">
                            <div class="card-body">
                                <i class="fas fa-chalkboard-teacher fa-2x mb-3"></i>
                                <h5 class="card-title">Teachers</h5>
                                <h2 class="fw-bold">{{ \App\Models\User::where('role', 'teacher')->count() }}</h2>
                                <small>Active instructors</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card-info text-center">
                            <div class="card-body">
                                <i class="fas fa-graduation-cap fa-2x mb-3"></i>
                                <h5 class="card-title">Students</h5>
                                <h2 class="fw-bold">{{ \App\Models\User::where('role', 'student')->count() }}</h2>
                                <small>Enrolled learners</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="card stats-card-warning text-center">
                            <div class="card-body">
                                <i class="fas fa-book fa-2x mb-3"></i>
                                <h5 class="card-title">Courses</h5>
                                <h2 class="fw-bold">45</h2>
                                <small>Available courses</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities -->
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-clock me-2"></i>Recent Activities
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-user-plus text-success me-2"></i>
                                            New student registered: John Doe
                                        </div>
                                        <small class="text-muted">2 hours ago</small>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-book text-primary me-2"></i>
                                            New course published: Advanced Physics
                                        </div>
                                        <small class="text-muted">5 hours ago</small>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-chalkboard-teacher text-info me-2"></i>
                                            Teacher profile updated: Sarah Ahmed
                                        </div>
                                        <small class="text-muted">1 day ago</small>
                                    </div>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <i class="fas fa-shopping-cart text-warning me-2"></i>
                                            Course purchased: Mathematics Basics
                                        </div>
                                        <small class="text-muted">2 days ago</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-chart-pie me-2"></i>Quick Stats
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Course Completion Rate</span>
                                        <strong>85%</strong>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-success" style="width: 85%"></div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Student Satisfaction</span>
                                        <strong>92%</strong>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-info" style="width: 92%"></div>
                                    </div>
                                </div>
                                
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between">
                                        <span>Revenue Target</span>
                                        <strong>78%</strong>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-warning" style="width: 78%"></div>
                                    </div>
                                </div>
                                
                                <div class="text-center mt-3">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="fas fa-chart-line me-1"></i>View Detailed Report
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-dark text-white">
                                <h5 class="mb-0">
                                    <i class="fas fa-bolt me-2"></i>Quick Actions
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-primary w-100">
                                            <i class="fas fa-plus me-2"></i>Add New Course
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-success w-100">
                                            <i class="fas fa-user-plus me-2"></i>Add New Teacher
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-info w-100">
                                            <i class="fas fa-envelope me-2"></i>Send Newsletter
                                        </button>
                                    </div>
                                    <div class="col-md-3 mb-2">
                                        <button class="btn btn-outline-warning w-100">
                                            <i class="fas fa-cog me-2"></i>System Settings
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>