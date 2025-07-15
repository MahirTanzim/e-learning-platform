<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 2rem 0;
        }

        .main-container {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 1rem;
        }

        .register-wrapper {
            display: flex;
            background: white;
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            min-height: 650px;
        }

        .register-left {
            flex: 1;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            position: relative;
        }

        .register-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="50" cy="50" r="2" fill="white" opacity="0.1"/></svg>');
            background-size: 30px 30px;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }

            100% {
                transform: translateY(0px);
            }
        }

        .brand-container {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            position: relative;
            z-index: 2;
        }

        .brand-logo-img {
            height: 60px;
            margin-right: 1rem;
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: bold;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .welcome-text {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .welcome-subtext {
            font-size: 1rem;
            opacity: 0.9;
            text-align: center;
            line-height: 1.6;
            position: relative;
            z-index: 2;
            margin-bottom: 2rem;
        }

        .feature-list {
            margin-bottom: 2rem;
            position: relative;
            z-index: 2;
        }

        .feature-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .feature-item i {
            margin-right: 0.5rem;
            color: #fff;
        }

        .contact-section {
            position: relative;
            z-index: 2;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            padding-top: 2rem;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 15px;
            padding: 1.5rem;
            backdrop-filter: blur(10px);
        }

        .contact-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: rgba(255, 255, 255, 0.98);
        }

        .contact-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.8rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.95);
        }

        .contact-item i {
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.95);
        }

        .location-item {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.95);
        }

        .location-item i {
            margin-right: 0.8rem;
            width: 20px;
            text-align: center;
            color: rgba(255, 255, 255, 0.95);
        }

        .map-container {
            margin: 1rem 0;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .map-preview {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #E8F5E8 0%, #C8E6C9 30%, #A5D6A7 60%, #81C784 100%);
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .map-preview::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                /* Roads - horizontal */
                linear-gradient(0deg, transparent 48%, #ffffff 49%, #ffffff 51%, transparent 52%),
                linear-gradient(0deg, transparent 28%, #ffffff 29%, #ffffff 31%, transparent 32%),
                linear-gradient(0deg, transparent 68%, #ffffff 69%, #ffffff 71%, transparent 72%),
                /* Roads - vertical */
                linear-gradient(90deg, transparent 25%, #ffffff 26%, #ffffff 28%, transparent 29%),
                linear-gradient(90deg, transparent 55%, #ffffff 56%, #ffffff 58%, transparent 59%),
                linear-gradient(90deg, transparent 75%, #ffffff 76%, #ffffff 78%, transparent 79%),
                /* Grid pattern */
                linear-gradient(45deg, transparent 47%, rgba(255, 255, 255, 0.1) 49%, rgba(255, 255, 255, 0.1) 51%, transparent 53%);
            background-size: 100% 25px, 100% 30px, 100% 20px, 25px 100%, 30px 100%, 20px 100%, 15px 15px;
            opacity: 0.8;
        }

        .map-preview::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                /* Area labels simulation */
                radial-gradient(ellipse 40px 20px at 30% 25%, rgba(255, 255, 255, 0.3) 30%, transparent 30%),
                radial-gradient(ellipse 35px 18px at 70% 40%, rgba(255, 255, 255, 0.3) 30%, transparent 30%),
                radial-gradient(ellipse 45px 22px at 20% 70%, rgba(255, 255, 255, 0.3) 30%, transparent 30%),
                radial-gradient(ellipse 38px 19px at 80% 80%, rgba(255, 255, 255, 0.3) 30%, transparent 30%),
                /* Water bodies */
                radial-gradient(ellipse 60px 30px at 15% 45%, rgba(135, 206, 250, 0.4) 40%, transparent 40%),
                radial-gradient(ellipse 50px 25px at 85% 60%, rgba(135, 206, 250, 0.4) 40%, transparent 40%);
            background-size: 100% 100%;
        }

        .map-roads {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                /* Major roads */
                linear-gradient(45deg, transparent 49%, #ffeb3b 49.5%, #ffeb3b 50.5%, transparent 51%),
                linear-gradient(-45deg, transparent 49%, #ff9800 49.5%, #ff9800 50.5%, transparent 51%);
            background-size: 80px 80px, 60px 60px;
            opacity: 0.6;
        }

        .map-location-marker {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            background: #FF1744;
            border-radius: 50% 50% 50% 0;
            transform: translate(-50%, -50%) rotate(-45deg);
            border: 3px solid white;
            box-shadow: 0 3px 10px rgba(255, 23, 68, 0.5);
            z-index: 3;
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translate(-50%, -50%) rotate(-45deg) translateY(0);
            }

            40% {
                transform: translate(-50%, -50%) rotate(-45deg) translateY(-5px);
            }

            60% {
                transform: translate(-50%, -50%) rotate(-45deg) translateY(-3px);
            }
        }

        .map-location-marker::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
        }

        .map-place-names {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 2;
        }

        .place-name {
            position: absolute;
            font-size: 0.7rem;
            font-weight: 600;
            color: #2E7D32;
            text-shadow: 1px 1px 2px rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .place-dhaka {
            top: 40%;
            left: 45%;
            transform: translate(-50%, -50%);
            font-size: 0.8rem;
            color: #1565C0;
        }

        .place-savar {
            top: 25%;
            left: 25%;
            transform: translate(-50%, -50%);
        }

        .place-narayanganj {
            top: 70%;
            left: 70%;
            transform: translate(-50%, -50%);
        }

        .place-hemayetpur {
            top: 35%;
            left: 15%;
            transform: translate(-50%, -50%);
        }

        .map-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            opacity: 0;
            z-index: 4;
        }

        .map-preview:hover .map-overlay {
            opacity: 1;
        }

        .map-btn {
            background: rgba(255, 255, 255, 0.95);
            color: #333;
            padding: 0.6rem 1.2rem;
            border-radius: 25px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            backdrop-filter: blur(10px);
        }

        .map-btn:hover {
            background: white;
            color: #333;
            transform: scale(1.05);
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.3);
        }

        .map-text {
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 0.5rem;
            text-align: center;
        }

        .social-links {
            margin-top: 1.5rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .social-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: rgba(255, 255, 255, 0.95);
            text-decoration: none;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .social-link:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            color: white;
        }

        .register-right {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: white;
        }

        .register-form {
            max-width: 400px;
            margin: 0 auto;
            width: 100%;
        }

        .form-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2d3748;
            margin-bottom: 0.5rem;
            text-align: center;
        }

        .form-subtitle {
            color: #718096;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.875rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8fafc;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
            background: white;
        }

        .form-control::placeholder {
            color: #a0aec0;
        }

        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            padding: 0.875rem 2rem;
            font-weight: 600;
            font-size: 1rem;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            width: 100%;
            position: relative;
            overflow: hidden;
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 15px 30px rgba(102, 126, 234, 0.3);
        }

        .btn-register::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .btn-register:hover::before {
            left: 100%;
        }

        .divider {
            text-align: center;
            margin: 2rem 0;
            position: relative;
        }

        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }

        .divider span {
            background: white;
            padding: 0 1rem;
            color: #a0aec0;
            font-size: 0.9rem;
        }

        .login-link {
            text-align: center;
            color: #718096;
        }

        .login-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            color: #764ba2;
        }

        .back-home {
            text-align: center;
            margin-bottom: 2rem;
        }

        .back-home a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: rgba(102, 126, 234, 0.1);
            transition: all 0.3s ease;
        }

        .back-home a:hover {
            background: rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .register-wrapper {
                flex-direction: column;
                margin: 1rem;
            }

            .register-left {
                padding: 2rem;
                min-height: 300px;
            }

            .register-right {
                padding: 2rem;
            }

            .brand-logo {
                font-size: 2rem;
            }

            .brand-logo-img {
                height: 40px;
            }

            .welcome-text {
                font-size: 1.2rem;
            }

            .brand-container {
                flex-direction: column;
                text-align: center;
            }

            .brand-logo-img {
                margin-right: 0;
                margin-bottom: 0.5rem;
            }

            .map-container {
                height: 100px;
            }
        }
    </style>
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
