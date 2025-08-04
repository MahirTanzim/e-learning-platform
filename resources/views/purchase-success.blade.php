<!DOCTYPE html>
<html>
<head>
    <title>Purchase Successful</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f4f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .message {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #16a34a;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #16a34a;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #15803d;
        }
    </style>
</head>
<body>
    <div class="message">
        <h1>🎉 Congrats on purchasing the course!</h1>
        <p>The course has been added to your <strong>My Courses</strong> section in the student portal.</p>
        <a href="{{ route('student.dashboard') }}">Go to Dashboard</a>
    </div>
</body>
</html>
