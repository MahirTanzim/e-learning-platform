<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>English Courses - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/english.css') }}">
</head>

<body class="d-flex flex-column min-vh-100">
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
                        <li><a class="nav-link" href="{{ url('/') }}">HOME</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.mathematics') }}">Mathematics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.biology') }}">Biology</a></li>
                                <li><a class="dropdown-item active" href="{{ route('courses.english') }}">English</a></li>
                            </ul>
                        </li>
                        <li><a class="nav-link" href="{{ route('become.teacher') }}">BECOME A TEACHER</a></li>
                        <li><a class="nav-link" href="{{ route('blog') }}">BLOG</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('register') }}" class="me-3 text-dark">Register</a>
                        <a href="{{ route('login') }}" class="me-3 text-dark">Login</a>
                        <a href="#" class="me-3 text-dark position-relative">
                            🛒
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">0</span>
                        </a>
                        <a href="#"><i class="bi bi-search"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <main class="flex-grow-1">
        <div class="course-header">
            <h1 class="display-5 fw-bold text-success">English Courses</h1>
            <p class="text-muted lead">Improve your language skills for communication, writing, and more.</p>
        </div>

        <section class="course-section">
            <h2 class="mb-4 text-center">Featured English Courses</h2>
            <div class="row g-4">
                @forelse ($courses as $course)
                    <div class="col-md-6 col-lg-4">
                        <div class="card course-card">
                            <img src="{{ asset($course->image) }}" class="card-img-top course-image" alt="{{ $course->title }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <p class="card-text text-muted">{{ $course->description }}</p>
                                <span class="badge bg-secondary mb-2">{{ ucfirst($course->level) ?? 'N/A' }}</span>
                                <a href="{{ route('courses.purchase', ['id' => $course->id]) }}" class="btn btn-primary w-100 mt-2">Enroll Now</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-muted">No English courses available at the moment.</p>
                @endforelse
            </div>
        </section>
    </main>

    <footer class="bg-black text-white py-3 mt-auto">
        <div class="container text-center">
            <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD" height="28" class="mb-2">
            <p class="mb-1 small">© {{ date('Y') }} AcademiaBD. All rights reserved.</p>
            <p class="mb-0 small">
                <a href="mailto:info@academiabd.com" class="text-white text-decoration-none">info@academiabd.com</a> |
                <a href="tel:+880123456789" class="text-white text-decoration-none">+880 1234 56789</a>
            </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
