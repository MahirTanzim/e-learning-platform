<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Purchase Course</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card p-4 shadow">
            <h2 class="mb-3">Purchase Course</h2>

            <h4>{{ $course->title }}</h4>
            <p>{{ $course->description }}</p>
            <p><strong>Level:</strong> {{ $course->level }}</p>
            <p><strong>Price:</strong> {{ $course->price }}</p>
            <img src="{{ asset($course->image) }}" class="img-fluid mb-3" style="max-height: 250px; width: auto; object-fit: contain;">


            <a href="{{ route('purchase.success') }}" class="btn btn-success">Proceed to Pay</a>

        </div>
    </div>
</body>
</html>
