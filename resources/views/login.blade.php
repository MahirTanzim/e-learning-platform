<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/login.css') }}">
</head>

<body>
    <div class="back-home">
        <a href="{{ url('/') }}">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
    </div>

    <div class="main-container">
        <div class="login-wrapper">
            <div class="login-left">
                <div class="brand-container">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD Logo" class="brand-logo-img">
                    <div class="brand-logo">AcademiaBD</div>
                </div>
                <div class="welcome-text">Welcome Back!</div>
                <div class="welcome-subtext">
                    Continue your learning journey with us. Access thousands of courses and expand your knowledge.
                </div>
                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Access to Premium Courses</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Expert Instructors</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Lifetime Learning Support</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Certificate of Completion</span>
                    </div>
                </div>

                <div class="contact-section">
                    <div class="contact-title">Contact Us</div>
                    <div class="contact-item">
                        <i class="fas fa-phone"></i>
                        <span>+880 1234 56789</span>
                    </div>
                    <div class="contact-item">
                        <i class="fas fa-envelope"></i>
                        <span>info@academiabd.com</span>
                    </div>
                    <div class="location-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Dhaka, Bangladesh</span>
                    </div>

                    <div class="map-container">
                        <div class="map-preview">
                            <div class="map-roads"></div>
                            <div class="map-place-names">
                                <div class="place-name place-dhaka">ঢাকা</div>
                                <div class="place-name place-savar">সাভার</div>
                                <div class="place-name place-narayanganj">নারায়ণগঞ্জ</div>
                                <div class="place-name place-hemayetpur">হেমায়েতপুর</div>
                            </div>
                            <div class="map-location-marker"></div>
                            <div class="map-overlay">
                                <a href="https://maps.google.com/?q=Dhaka,Bangladesh" target="_blank" class="map-btn">
                                    <i class="fas fa-map-marked-alt"></i>
                                    <span>View on Google Maps</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="map-text">Click to open in Google Maps</div>

                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" title="Google">
                            <i class="fab fa-google"></i>
                        </a>
                        <a href="#" class="social-link" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-link" title="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="login-right">
                <div class="login-form">
                    <h2 class="form-title">Sign In</h2>
                    <p class="form-subtitle">Enter your credentials to access your account</p>

                    @if (session('error'))
                        <div class="alert alert-danger border-0 rounded-3">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="role" class="form-label">Login As</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Select Your Role</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required autofocus
                                placeholder="Enter your email address">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="Enter your password">
                            <div class="forgot-password">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-login text-white">
                            Sign In
                        </button>
                    </form>

                    <div class="divider">
                        <span>Don't have an account?</span>
                    </div>

                    <div class="register-link">
                        <a href="{{ route('register') }}">Create new account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
