<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
        .login-container {
            border: 1px solid #dee2e6;
            border-radius: 16px;
            background: #fff;
            padding: 2.5rem 2rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.10);
            min-width: 340px;
            max-width: 400px;
            width: 100%;
        }
        .login-container .form-label {
            font-weight: 500;
        }
        .login-container .btn-primary {
            font-weight: 600;
            letter-spacing: 1px;
        }
        .login-container .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13,110,253,.15);
        }
        .login-container .forgot-link {
            float: right;
            font-size: 0.95rem;
        }
    </style>
</head>
<body>
    <header>
        <!-- Navbar -->
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
        <div class="login-container mx-auto">
            <h2 class="mb-4 text-center">Welcome Back</h2>
            <p class="text-center text-muted mb-4" style="font-size:1rem;">Sign in to your AcademiaBD account</p>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="Enter your email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">
                        Password
                        <a href="#" class="forgot-link text-decoration-none text-primary">Forgot?</a>
                    </label>
                    <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
            </form>
            <div class="text-center mt-3">
                <span class="text-muted">Don't have an account?</span>
                <a href="{{ route('register') }}" class="text-primary text-decoration-none">Register</a>
            </div>
            <a href="{{ url('/') }}" class="btn btn-link w-100 mt-2">← Back to Home</a>
        </div>
    </main>
</body>
</html>