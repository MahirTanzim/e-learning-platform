<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>English Courses - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .course-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .course-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }
        .card-header-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 1.5rem;
        }
        .card-header-custom h5 {
            margin: 0;
            font-weight: 600;
        }
        .master-card {
            background: white;
            border: none;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.15), 
                        0 0 0 1px rgba(255,255,255,0.05);
            position: relative;
            overflow: hidden;
        }
        .master-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            opacity: 0.1;
            z-index: 1;
        }
        .master-card .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            position: relative;
            z-index: 2;
        }
        .master-card .card-body {
            position: relative;
            z-index: 2;
        }
        .badge-custom {
            font-size: 0.75rem;
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
        }
        .btn-enroll {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            color: white;
        }
        .btn-enroll:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.4);
            color: white;
        }
        .list-item {
            padding: 0.25rem 0;
            border-left: 3px solid #667eea;
            padding-left: 1rem;
            margin-bottom: 0.5rem;
        }
        .master-card .list-item {
            border-left: 3px solid #667eea;
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
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">COURSES</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('courses.mathematics') }}">Mathematics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.physics') }}">Physics</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.chemistry') }}">Chemistry</a></li>
                                <li><a class="dropdown-item" href="{{ route('courses.biology') }}">Biology</a></li>
                                <li><a class="dropdown-item active" href="{{ route('courses.english') }}">English</a></li>
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

    <main class="container my-5">
        <h1 class="text-center mb-5">English Courses</h1>
        
        <!-- First Row - 2 Cards -->
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card course-card h-100">
                    <div class="card-header-custom">
                        <h5>📝 Reading Comprehension Strategies</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Master the art of understanding and analyzing texts through proven reading strategies and techniques.</p>
                        <ul class="list-unstyled">
                            <li class="list-item">Text Analysis Skills</li>
                            <li class="list-item">Critical Reading Techniques</li>
                            <li class="list-item">Vocabulary in Context</li>
                            <li class="list-item">Speed Reading Methods</li>
                        </ul>
                        <div class="mt-3">
                            <span class="badge bg-primary badge-custom">Duration: 2 Months</span>
                            <span class="badge bg-success badge-custom">Level: Intermediate</span>
                        </div>
                        <button class="btn btn-primary btn-enroll mt-3">Enroll Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card course-card h-100">
                    <div class="card-header-custom">
                        <h5>✍️ Writing & Vocabulary Building</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Enhance your writing skills and expand your vocabulary for effective communication.</p>
                        <ul class="list-unstyled">
                            <li class="list-item">Creative Writing Techniques</li>
                            <li class="list-item">Academic Writing Skills</li>
                            <li class="list-item">Word Power Building</li>
                            <li class="list-item">Essay Writing Mastery</li>
                        </ul>
                        <div class="mt-3">
                            <span class="badge bg-primary badge-custom">Duration: 3 Months</span>
                            <span class="badge bg-success badge-custom">Level: Beginner to Advanced</span>
                        </div>
                        <button class="btn btn-primary btn-enroll mt-3">Enroll Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Second Row - 2 Cards -->
        <div class="row mb-4">
            <div class="col-md-6 mb-4">
                <div class="card course-card h-100">
                    <div class="card-header-custom">
                        <h5>🗣️ Spoken English & Pronunciation</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Develop fluency in spoken English with proper pronunciation and communication skills.</p>
                        <ul class="list-unstyled">
                            <li class="list-item">Pronunciation Training</li>
                            <li class="list-item">Conversation Practice</li>
                            <li class="list-item">Public Speaking Skills</li>
                            <li class="list-item">Accent Reduction</li>
                        </ul>
                        <div class="mt-3">
                            <span class="badge bg-primary badge-custom">Duration: 4 Months</span>
                            <span class="badge bg-success badge-custom">Level: Beginner to Advanced</span>
                        </div>
                        <button class="btn btn-primary btn-enroll mt-3">Enroll Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card course-card h-100">
                    <div class="card-header-custom">
                        <h5>📚 English Grammar Fundamentals</h5>
                    </div>
                    <div class="card-body">
                        <p class="card-text">Build a strong foundation in English grammar with comprehensive rules and practice.</p>
                        <ul class="list-unstyled">
                            <li class="list-item">Parts of Speech</li>
                            <li class="list-item">Sentence Structure</li>
                            <li class="list-item">Tenses & Verb Forms</li>
                            <li class="list-item">Advanced Grammar Rules</li>
                        </ul>
                        <div class="mt-3">
                            <span class="badge bg-primary badge-custom">Duration: 3 Months</span>
                            <span class="badge bg-success badge-custom">Level: Beginner to Intermediate</span>
                        </div>
                        <button class="btn btn-primary btn-enroll mt-3">Enroll Now</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Third Row - 1 Full Width Card -->
        <div class="row">
            <div class="col-12">
                <div class="card master-card">
                    <div class="card-header">
                        <h4 class="mb-0">🎯 Master English Language Skills - Complete Package</h4>
                    </div>
                    <div class="card-body">
                        <p class="card-text lead">
                            Comprehensive English mastery program combining all aspects of language learning for complete fluency and proficiency.
                        </p>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <h6>What You'll Learn:</h6>
                                <ul class="list-unstyled">
                                    <li class="list-item">📖 Advanced Literature Analysis</li>
                                    <li class="list-item">💼 Business English Communication</li>
                                    <li class="list-item">🎭 Poetry & Drama Studies</li>
                                    <li class="list-item">📰 Media & Journalism English</li>
                                    <li class="list-item">🌍 International English Proficiency</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6>Course Features:</h6>
                                <ul class="list-unstyled">
                                    <li class="list-item">✅ Interactive Live Sessions</li>
                                    <li class="list-item">✅ Personalized Feedback</li>
                                    <li class="list-item">✅ Certificate of Completion</li>
                                    <li class="list-item">✅ Lifetime Access to Materials</li>
                                    <li class="list-item">✅ Expert Instructor Support</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <span class="badge bg-primary badge-custom">Duration: 12 Months</span>
                            <span class="badge bg-warning text-dark badge-custom">Level: All Levels</span>
                            <span class="badge bg-danger badge-custom">Premium Course</span>
                        </div>
                        
                        <div class="mt-4">
                            <button class="btn btn-enroll btn-lg me-3">Enroll in Master Course</button>
                            <button class="btn btn-outline-secondary">View Detailed Syllabus</button>
                            <button class="btn btn-outline-info">Download Brochure</button>
                        </div>
                    </div>
                </div>
            </div>
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