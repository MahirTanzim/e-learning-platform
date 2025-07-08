<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
        }
        .center-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-container {
            border: 1px solid #dee2e6;
            border-radius: 16px;
            background: #fff;
            padding: 2.5rem 2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            min-width: 340px;
            max-width: 450px;
            width: 100%;
        }
        .register-container .form-label {
            font-weight: 500;
        }
        .register-container .btn-primary {
            font-weight: 600;
            letter-spacing: 1px;
        }
        .register-container .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.15);
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
                <div class="collapse navbar-collapse" id="navMenu">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" href="#">HOME</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Course 1</a></li>
                                <li><a class="dropdown-item" href="#">Course 2</a></li>
                            </ul>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{ route('become.teacher') }}">BECOME A TEACHER</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">BLOG</a></li>
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

    <main class="center-container">
        <div class="register-container mx-auto">
            <h2 class="mb-4 text-center">Create Account</h2>
            <p class="text-center text-muted mb-4" style="font-size:1rem;">Register your AcademiaBD account</p>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required placeholder="Enter your full name">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Create a password">
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required placeholder="Re-enter your password">
                </div>
                <div class="mb-4">
                    <label for="role" class="form-label">Register As</label>
                    <select class="form-select" id="role" name="role" required>
                        <option value="student">Student</option>
                        <option value="teacher">Teacher</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Register</button>
            </form>
            <div class="text-center mt-3">
                <span class="text-muted">Already have an account?</span>
                <a href="{{ route('login') }}" class="text-primary text-decoration-none">Login</a>
            </div>
            <a href="{{ url('/') }}" class="btn btn-link w-100 mt-2">← Back to Home</a>
        </div>
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