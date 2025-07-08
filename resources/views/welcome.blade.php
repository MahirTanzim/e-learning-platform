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
                <div class="collapse navbar-collapse " id="navMenu" >
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#">HOME</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.mathematics') }}">Mathematics</a></li>
                                <li><a class="dropdown-item" aria-current="page" href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                <li><a class="dropdown-item">Biology</a></li>
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
        <section class="container py-5">
            <div class="row align-items-center flex-lg-row flex-column-reverse">
                <div class="col-lg-6 text-center mb-4 mb-lg-0">
                    <img src="{{ asset('assets/images/Hero.jpg') }}" alt="Hero" class="img-fluid rounded-4 shadow" style="max-width: 400px;">
                </div>
                <div class="col-lg-6 d-flex flex-column justify-content-center">
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 fs-6" style="width: fit-content;">Empowering Bangladesh</span>
                    <h1 class="fw-bold mb-3 display-5">Learn Anytime, Anywhere</h1>
                    <p class="mb-4 fs-5 text-secondary">
                        Welcome to <strong>AcademiaBD</strong> — your gateway to quality online education. Access expert-led courses, interactive lessons, and quizzes in Bangla or English. Study at your pace, from anywhere in Bangladesh.
                    </p>
                    <div>
                        <a href="#courses" class="hero-btn me-3">Browse Courses</a>
                        <a href="{{ route('register') }}" class="btn btn-outline-primary fw-bold px-4">Get Started</a>
                    </div>
                </div>
            </div>
        </section>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
