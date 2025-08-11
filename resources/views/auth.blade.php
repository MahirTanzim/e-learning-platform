<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - AcademiaBD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .auth-card {
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            background: #fff;
            padding: 2.5rem 2rem;
        }
        .form-control:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 0.2rem rgba(118,75,162,.25);
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #764ba2;
            letter-spacing: 2px;
        }
        .role-select {
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center min-vh-100">
        <div class="col-md-5">
            <div class="auth-card">
                <div class="text-center mb-4">
                    <span class="logo">Academia<span style="color:#667eea;">BD</span></span>
                    <h4 class="mt-2 mb-0 fw-bold">Sign In to Your Account</h4>
                    <p class="text-muted mb-0">Please enter your credentials</p>
                </div>
                @if(session('error'))
                    <div class="alert alert-danger py-2">{{ session('error') }}</div>
                @endif
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" required autofocus placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required placeholder="Enter your password">
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Login as</label>
                        <select class="form-select role-select" id="role" name="role" required>
                            <option value="" disabled selected>Select role</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-primary btn-lg" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            Login
                        </button>
                    </div>
                    <div class="text-center">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="fw-semibold" style="color:#764ba2;">Register</a>
                    </div>
                </form>
            </div>
        </div>