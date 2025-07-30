<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/register.css') }}">
</head>

<body>
    <div class="back-home">
        <a href="{{ url('/') }}">
            <i class="fas fa-arrow-left me-2"></i>Back to Home
        </a>
    </div>

    <div class="main-container">
        <div class="register-wrapper">
            <div class="register-left">
                <div class="brand-container">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD Logo" class="brand-logo-img">
                    <div class="brand-logo">AcademiaBD</div>
                </div>
                <div class="welcome-text">Join Our Community</div>
                <div class="welcome-subtext">
                    Start your learning journey today. Get access to expert-led courses and unlock your potential.
                </div>
                <div class="feature-list">
                    <div class="feature-item">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Expert-Led Courses</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-users"></i>
                        <span>Join 10,000+ Students</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-clock"></i>
                        <span>Learn at Your Own Pace</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-certificate"></i>
                        <span>Get Certified</span>
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

            <div class="register-right">
                <div class="register-form">
                    <h2 class="form-title">Create Account</h2>
                    <p class="form-subtitle">Fill in your details to get started</p>

                    @if (session('error'))
                        <div class="alert alert-danger border-0 rounded-3">
                            <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label for="role" class="form-label">Register As</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="">Select Your Role</option>
                                <option value="student">Student</option>
                                <option value="teacher">Teacher</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" required autofocus
                                placeholder="Enter your full name">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required
                                placeholder="Enter your email address">
                        </div>

                        <div class="form-group">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required
                                placeholder="Create a strong password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation" required placeholder="Confirm your password">
                        </div>

                        <button type="submit" class="btn btn-register text-white">
                            Create Account
                        </button>
                    </form>

                    <div class="divider">
                        <span>Already have an account?</span>
                    </div>

                    <div class="login-link">
                        <a href="{{ route('login') }}">Sign in to your account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
