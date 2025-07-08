<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Become a Teacher</title>
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

        .benefit-list li::marker {
            color: #13cefd;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg shadow-sm bg-white">
            <div class="container justify-content-around">
                <a class="navbar-brand" href="#">
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.mathematics') }}">Mathematics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.biology') }}">Biology</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.english') }}">English</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link active" href="{{ route('become.teacher') }}">BECOME A TEACHER</a></li>
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

    <main>
        <section class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Become a Teacher on AcademiaBD</h2>
                    <p class="mb-3">
                        Share your skills with thousands of eager learners across Bangladesh. As a teacher at AcademiaBD, you’ll have the platform, tools, and freedom to teach in your own way anytime, anywhere.
                    </p>
                    <ul class="mb-4 benefit-list">
                        <li class="mb-2">📚 Teach topics you're passionate about</li>
                        <li class="mb-2">💻 Flexible schedule  work remotely</li>
                        <li class="mb-2">💰 Earn money from your courses</li>
                        <li class="mb-2">📈 Become more Popular</li>
                    </ul>
                    <a href="{{ route('register') }}" class="hero-btn">Drop Your Application →</a>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('assets/images/become-teacher.jpg') }}" alt="Become a Teacher" class="img-fluid rounded-circle shadow" style="max-width: 350px;">
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
