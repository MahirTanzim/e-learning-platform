<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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
      background-color: #fdb813;
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


  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container justify-content-around">
      <a class="navbar-brand" href="#">
        <img src="{{ asset('assets/images/logo.png') }}" alt="AcademiaBD" height="35">
      </a>
      <h2>AcademiaBD</h2>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">FEATURES</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Feature 1</a></li>
              <li><a class="dropdown-item" href="#">Feature 2</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="#">BECOME AN INSTRUCTOR</a></li>
          <li class="nav-item"><a class="nav-link" href="#">BLOG</a></li>
        </ul>
        <div class="d-flex align-items-center">
          <a href="#" class="me-3 text-dark">Register</a>
          <a href="#" class="me-3 text-dark">Login</a>
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
        <h1 class="fw-bold mb-4">Start shaping your future learning online!</h1>
        <p class="mb-4">
          Goedu online Courses, your best choice to find the best online courses in Bangladesh 
          <strong>Now officially GEAC accredited.</strong> Learn at your convenience. 
          Quality professional courses with certificates and varieties of topics.
        </p>
        <button class="hero-btn">Browse All</button>
      </div>
      <div class="col-lg-6 text-center">
        <img src="your-hero-image.png" alt="Hero" class="img-fluid">
      </div>
    </div>
  </section>
  </main>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
