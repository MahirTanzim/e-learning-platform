<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s;
        }
        footer {
            margin-top: auto;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg shadow-sm bg-white">
            <div class="container justify-content-around">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD" height="35">
                </a>
                <h2 class="mr-5">AcademiaBD</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">HOME</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item active"
                                        href="{{ route('courses.mathematics') }}">Mathematics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.biology') }}">Biology</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.english') }}">English</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('become.teacher') }}">BECOME A
                                TEACHER</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">BLOG</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-5 mb-4">
        <h2 class="mb-4 text-center">Welcome to Your Student Dashboard</h2>

        <!-- Student Details Card -->
        <div class="row justify-content-center mb-4">
            <div class="col-md-8">
                <div class="card shadow-sm p-4">
                    <h5 class="mb-3">Student Details</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Name:</strong> John Doe</p>
                            <p><strong>Student ID:</strong> 202212345</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Email:</strong> johndoe@example.com</p>
                            <p><strong>Department:</strong> Computer Science</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Dashboard Cards -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h5>Enrolled Courses</h5>
                    <p>You are enrolled in 3 courses.</p>
                    <a href="#" class="btn btn-outline-success btn-sm">View Courses</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h5>Progress</h5>
                    <p>Biology: 70% complete</p>
                    <div class="progress">
                        <div class="progress-bar bg-success" style="width: 70%"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm p-3">
                    <h5>Messages</h5>
                    <p>You have 2 unread messages.</p>
                    <a href="#" class="btn btn-outline-success btn-sm">Go to Inbox</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fixed Footer -->
    <footer class="bg-dark text-white text-center py-3">
        &copy; {{ date('Y') }} AcademiaBD. All rights reserved.
    </footer>
</body>
</html>
