
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Teacher Vlogs & Courses - Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
        }
        .blog-header {
            background: #fff;
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 2rem;
            padding: 1.5rem 0;
        }
        .vlog-card {
            border-radius: 14px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            margin-bottom: 2rem;
        }
        .vlog-card .card-body {
            padding: 2rem;
        }
    </style>
</head>
<body>
    <header class="blog-header text-center">
        <h1 class="mb-2">Teacher Vlogs & Courses</h1>
        <p class="text-muted">Explore vlogs from our teachers and discover their courses!</p>
    </header>
    <main class="container">
        <div class="row">
            <!-- Vlog 1 -->
            <div class="col-md-6">
                <div class="card vlog-card">
                    <div class="card-body">
                        <h4 class="card-title">Mr. John Doe</h4>
                        <p class="card-text">Web Development Vlog: Learn the latest trends and tips in web development.</p>
                        <p><strong>Featured Course:</strong> Full Stack Web Development</p>
                        <a href="#" class="btn btn-primary btn-sm">Watch Vlog</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">View Course</a>
                    </div>
                </div>
            </div>
            <!-- Vlog 2 -->
            <div class="col-md-6">
                <div class="card vlog-card">
                    <div class="card-body">
                        <h4 class="card-title">Ms. Jane Smith</h4>
                        <p class="card-text">Data Science Vlog: Dive into the world of AI and data analysis.</p>
                        <p><strong>Featured Course:</strong> Introduction to Data Science</p>
                        <a href="#" class="btn btn-primary btn-sm">Watch Vlog</a>
                        <a href="#" class="btn btn-outline-secondary btn-sm">View Course</a>
                    </div>
                </div>
            </div>
            <!-- Add more vlogs below as needed -->
        </div>
    </main>
</body>
</html>