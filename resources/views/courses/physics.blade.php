<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Physics Courses - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .course-header {
            text-align: center;
            padding: 3rem 1rem 1rem;
            background-color: #fff;
            border-bottom: 1px solid #e9ecef;
        }
        .course-section {
            padding: 3rem 0;
        }
        .course-card {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
        }
        .course-image {
            height: 200px;
            object-fit: cover;
            width: 100%;
        }
        .nav-link.active-course {
            border-bottom: 2px solid #fdb813;
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
                            <a class="nav-link dropdown-toggle active-course" href="#" role="button" data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.mathematics') }}">Mathematics</a></li>
                                <li><a class="dropdown-item" aria-current="page" href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('become.teacher') }}">BECOME A TEACHER</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">BLOG</a></li>
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

    <main class="container">
        <div class="course-header">
            <h1 class="display-5 fw-bold text-primary">Physics Courses</h1>
            <p class="text-muted lead">Explore the fundamental laws of the universe and beyond.</p>
        </div>

        <section class="course-section">
            <h2 class="mb-4 text-center">Featured Physics Courses</h2>
            <div class="row g-4">
                <div class="col-md-6 col-lg-4">
                    <div class="card course-card">
                        {{-- Image for Classical Mechanics --}}
                        <img src="{{ asset('assets/images/classical_mechanics.jpg') }}" class="card-img-top course-image" alt="Classical Mechanics Course">
                        <div class="card-body">
                            <h5 class="card-title">Classical Mechanics Fundamentals</h5>
                            <p class="card-text text-muted">Master the basics of motion, forces, and energy. Suitable for beginners.</p>
                            <span class="badge bg-info text-dark mb-2">Beginner</span>
                            <a href="#" class="btn btn-primary w-100 mt-2">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card course-card">
                        {{-- Image for Electromagnetism --}}
                        <img src="{{ asset('assets/images/electromagnetism.jpg') }}" class="card-img-top course-image" alt="Electromagnetism Course">
                        <div class="card-body">
                            <h5 class="card-title">Electromagnetism: From Theory to Application</h5>
                            <p class="card-text text-muted">Dive deep into electric and magnetic fields, and their interactions.</p>
                            <span class="badge bg-warning text-dark mb-2">Intermediate</span>
                            <a href="#" class="btn btn-primary w-100 mt-2">Enroll Now</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="card course-card">
                        {{-- Image for Quantum Physics --}}
                        <img src="{{ asset('assets/images/quantum_physics.jpg') }}" class="card-img-top course-image" alt="Quantum Physics Course">
                        <div class="card-body">
                            <h5 class="card-title">Introduction to Quantum Physics</h5>
                            <p class="card-text text-muted">Unravel the mysteries of the quantum world. Advanced concepts explained.</p>
                            <span class="badge bg-danger mb-2">Advanced</span>
                            <a href="#" class="btn btn-primary w-100 mt-2">Enroll Now</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-black text-white py-3">
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