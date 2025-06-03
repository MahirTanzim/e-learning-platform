<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            border-bottom: 1px solid #ccc;
        }

        .nav-left,
        .nav-center,
        .nav-right {
            display: flex;
            align-items: center;
        }


        .dropbtn {
            background: none;
            border: none;
            font-size: 16px;
            color: #1a73e8;
            cursor: pointer;
            font-weight: bold;
        }


        .search-container {
            position: relative;
            margin-left: 15px;
        }

        .search-container input {
            padding: 8px 30px 8px 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .search-icon {
            position: absolute;
            right: 10px;
            top: 8px;
            font-size: 16px;
            color: #1a73e8;
        }

        .logo {
            height: 25px;
            margin-right: 8px;
        }

        .brand {
            font-size: 18px;
            font-weight: bold;
            color: #1a2e4f;
        }

        
        .nav-right .nav-link {
            margin-right: 15px;
            color: #1a73e8;
            text-decoration: none;
            font-weight: 500;
        }

        .signup-btn {
            background-color: #1a73e8;
            color: white;
            padding: 8px 14px;
            border-radius: 6px;
            text-decoration: none;
            font-weight: bold;
        }

        .nav-link:hover {
            color: #1a2e4f;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar">
            <div class="nav-left">
                <div class="dropdown">
                    <button class="dropbtn">Explore ▼</button>

                    <div class="dropdown-content">
                        <a href="#">Math</a>
                        <a href="#">Science</a>
                    </div>
                </div>
                <div class="search-container">
                    <input type="text" placeholder="Search" />
                    <span class="search-icon">🔍</span>
                </div>
            </div>

            <div class="nav-center">

                <img class="logo" src="resources\views\images\wqer.png" alt="">
                <span class="brand">joy Bangla Academy</span>
            </div>

            <div class="nav-right">
                <a href="#" class="nav-link">About Us</a>
                <a href="#" class="nav-link">Log in</a>
                <a href="#" class="signup-btn">Sign up</a>
            </div>
        </nav>
    </header>
    <main></main>
    <footer></footer>
    <h1>joy bangla</h1>
</body>

</html>
