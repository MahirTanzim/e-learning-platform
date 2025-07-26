
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success px-5">
        <a class="navbar-brand" href="{{ url('/') }}">AcademiaBD</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('student.dashboard') }}">Dashboard</a></li>
                
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Welcome to Your Student Dashboard</h2>
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

    <footer class="bg-dark text-white text-center py-3 mt-5">
        &copy; {{ date('Y') }} AcademiaBD. All rights reserved.
    </footer>
</body>
</html>
