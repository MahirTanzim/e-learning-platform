<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .nav-link.active {
            border-bottom: 2px solid #fdb813;
        }

        .hero-btn {
            background-color: #13cefd;
            color: #000;
            font-weight: bold;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .hero-btn:hover {
            background-color: #e6a700;
        }
        .course-image {
            height: 200px;
            object-fit: cover;
        }
        .course-card {
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
            border-radius: 20px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .course-card:hover {
            transform: translateY(-5px);
            transition: transform 0.3s ease;
        }
    </style>
</head>

<body>
    <header>

        <nav class="navbar navbar-expand-lg shadow-sm">
            <div class="container justify-content-around">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD" height="35">
                </a>
                <h2 class="mr-5">AcademiaBD</h2>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#">HOME</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.mathematics') }}">Mathematics</a>
                                </li>
                                <li><a class="dropdown-item" aria-current="page"
                                        href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                <li><a class="dropdown-item">Biology</a></li>
                            </ul>

                        </li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('become.teacher') }}">BECOME A
                                TEACHER</a></li>

                        <li class="nav-item"><a class="nav-link" href="{{ route('blog') }}">BLOG</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                        <a href="{{ route('register') }}" class="me-3 text-dark">Register</a>
                        <a href="{{ route('login') }}" class="me-3 text-dark">Login</a>

                        <a href="#" class="me-3 text-dark position-relative">
                            🛒
                            <span
                                class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark">0</span>
                        </a>
                        <a href="#"><i class="bi bi-search"></i></a>
                    </div>
                </div>
            </div>
        </nav>
    </header>



    <main>
        <section class="container-fluid py-5" style="background: linear-gradient(90deg, #e0f7fa 0%, #fdf6e3 100%); border-radius: 0 0 40px 40px;">
            <div class="container">
            <div class="row align-items-center flex-lg-row flex-column-reverse">
                <div class="col-lg-6 text-center mb-4 mb-lg-0">
                <img src="{{ asset('assets/images/Hero.jpg') }}" alt="Hero" class="img-fluid rounded-4 shadow-lg"
                    style="max-width: 520px; border: 8px solid #fff;">

                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center align-items-lg-start align-items-center text-lg-start text-center">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2 fs-6 shadow-sm" style="width: fit-content; letter-spacing: 1px;">Empowering Bangladesh</span>
                <h1 class="fw-bold mb-3 display-4" style="color: #14213d;">Learn Anytime, Anywhere</h1>
                <p class="mb-4 fs-5 text-secondary" style="max-width: 500px;">
                    Welcome to <strong>AcademiaBD</strong> — your gateway to quality online education. Access
                    expert-led courses, interactive lessons, and quizzes in Bangla or English. Study at your pace,
                    from anywhere in Bangladesh.
                </p>
                <div>
                    <a href="#courses" class="hero-btn me-3 shadow-sm px-4 py-2">Browse Courses</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary fw-bold px-4 py-2 shadow-sm">Get Started</a>
                </div>
                </div>
            </div>
            </div>
        </section>

        <section class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <form action="" method="GET" class="input-group">
                        <input type="text" name="query" class="form-control"
                            placeholder="Search courses, topics, or teachers..." aria-label="Search" required>
                        <button class="btn btn-primary" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- ...existing code... -->

        <section class="container my-5"> 
            <h2 class="text-center fw-bold mb-5" style="color: #14213d;">Explore the Best Professional Online Courses in
            Bangladesh</h2>
            <div class="row g-4">
            <!-- Course Card 1 -->
            <div class="col-md-6 col-lg-4">
                <div class="card course-card shadow-sm h-100">
                <img src="{{ asset('assets/images/organic_chemistry.jpg') }}" class="card-img-top course-image"
                    alt="Organic Chemistry">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    Introduction to Organic Chemistry
                    </h5>
                    <p class="card-text text-muted">Understand carbon compounds, reaction types, and isomerism.
                    </p>
                    <div class="mb-2 text-secondary small">
                    <span class="me-3">৳ 1200</span>
                    <span class="me-3"><i class="bi bi-clock"></i> 7 hr</span>
                    <span><i class="bi bi-award"></i> Certification</span>
                    </div>
                    <div class="mb-2">
                    <span class="text-secondary small">Rating</span>
                    <span class="ms-2 text-warning">
                        ★★★★★
                    </span>
                    </div>
                    <a href="#" class="btn btn-warning w-100 fw-bold">Enrol Now</a>
                </div>
                </div>
            </div>
            <!-- Course Card 2 -->
            <div class="col-md-6 col-lg-4">
                <div class="card course-card shadow-sm h-100">
                <img src="{{ asset('assets/images/physical_chemistry.jpg') }}"
                    class="card-img-top course-image" alt="Physical Chemistry">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    Physical Chemistry Essentials
                    </h5>
                    <p class="card-text text-muted">Explore thermodynamics, kinetics, and chemical equilibrium.
                    </p>
                    <div class="mb-2 text-secondary small">
                    <span class="me-3">৳ 1500</span>
                    <span class="me-3"><i class="bi bi-clock"></i> 12 hr</span>
                    <span><i class="bi bi-award"></i> Certification</span>
                    </div>
                    <div class="mb-2">
                    <span class="text-secondary small">Rating</span>
                    <span class="ms-2 text-warning">
                        ★★★★★
                    </span>
                    </div>
                    <a href="#" class="btn btn-warning w-100 fw-bold">Enrol Now</a>
                </div>
                </div>
            </div>
            <!-- Course Card 3 -->
            <div class="col-md-6 col-lg-4">
                <div class="card course-card shadow-sm h-100">
                <img src="{{ asset('assets/images/algebra.jpg') }}" class="card-img-top course-image" alt="Algebra Course">
                    
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    Algebra Basics
                    </h5>
                    <p class="card-text text-muted">Understand the core principles of algebra with step-by-step guidance.</p>
                    <div class="mb-2 text-secondary small">
                    <span class="me-3">৳ 1300</span>
                    <span class="me-3"><i class="bi bi-clock"></i> 12 hr</span>
                    <span><i class="bi bi-award"></i> Certification</span>
                    </div>
                    <div class="mb-2">
                    <span class="text-secondary small">Rating</span>
                    <span class="ms-2 text-warning">
                        ★★★★★
                    </span>
                    </div>
                    <a href="#" class="btn btn-warning w-100 fw-bold">Enrol Now</a>
                </div>
                </div>
            </div>
            <!-- Course Card 4 -->
            <div class="col-md-6 col-lg-4">
                <div class="card course-card shadow-sm h-100">
                <img src="{{ asset('assets/images/classical_mechanics.jpg') }}" class="card-img-top course-image" alt="Classical Mechanics Course">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    Classical Mechanics Fundamentals
                    </h5>
                    <p class="card-text text-muted">Master the basics of motion, forces, and energy. Suitable for beginners.</p>
                    <div class="mb-2 text-secondary small">
                    <span class="me-3">৳ 1000</span>
                    <span class="me-3"><i class="bi bi-clock"></i> 15 hr</span>
                    <span><i class="bi bi-award"></i> Certification</span>
                    </div>
                    <div class="mb-2">
                    <span class="text-secondary small">Rating</span>
                    <span class="ms-2 text-warning">
                        ★★★★★
                    </span>
                    </div>
                    <a href="#" class="btn btn-warning w-100 fw-bold">Enrol Now</a>
                </div>
                </div>
            </div>
            <!-- Course Card 5 -->
            <div class="col-md-6 col-lg-4">
                <div class="card course-card shadow-sm h-100">
                <img src="{{ asset('assets/images/electromagnetism.jpg') }}" class="card-img-top course-image" alt="Electromagnetism Course">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    Electromagnetism: From Theory to Application
                    </h5>
                    <p class="card-text text-muted">Dive deep into electric and magnetic fields, and their interactions.</p>
                    <div class="mb-2 text-secondary small">
                    <span class="me-3">৳ 3000</span>
                    <span class="me-3"><i class="bi bi-clock"></i> 17.5 hr</span>
                    <span><i class="bi bi-award"></i> Certification</span>
                    </div>
                    <div class="mb-2">
                    <span class="text-secondary small">Rating</span>
                    <span class="ms-2 text-warning">
                        ★★★★★
                    </span>
                    </div>
                    <a href="#" class="btn btn-warning w-100 fw-bold">Enrol Now</a>
                </div>
                </div>
            </div>
            <!-- Course Card 6 -->
            <div class="col-md-6 col-lg-4">
                <div class="card course-card shadow-sm h-100">
                <img src="{{ asset('assets/images/DNA.jpg') }}" class="card-img-top course-image" alt="Electromagnetism Course">
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                    Introduction to Genetics and Evolution
                    </h5>
                    <p class="card-text text-muted">Explore the principles of genetics and the process of evolution.
                    <div class="mb-2 text-secondary small">
                    <span class="me-3">৳ 3000</span>
                    <span class="me-3"><i class="bi bi-clock"></i> 12 hr</span>
                    <span><i class="bi bi-award"></i> Certification</span>
                    </div>
                    <div class="mb-2">
                    <span class="text-secondary small">Rating</span>
                    <span class="ms-2 text-warning">
                        ★★★★★
                    </span>
                    </div>
                    <a href="#" class="btn btn-warning w-100 fw-bold">Enrol Now</a>
                </div>
                </div>
            </div>
            </div>
        </section>

        <!-- ...existing code... -->
    </main>
    <!-- Footer Section -->

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
