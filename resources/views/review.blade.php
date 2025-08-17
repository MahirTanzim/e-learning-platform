{{-- resources/views/review.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="text-center">📚 Course Review Page</h2>

    <form id="reviewForm" class="bg-white p-4 rounded shadow mx-auto" style="max-width: 500px;">
        <label>Select Course:</label>
        <select id="course" class="form-control" required>
            <option value="">-- Select --</option>
            <option>Compiler Design</option>
            <option>Web Development</option>
            <option>Database Systems</option>
        </select>

        <label class="mt-3">Your Name:</label>
        <input type="text" id="name" class="form-control" required>

        <label class="mt-3">Your Email:</label>
        <input type="email" id="email" class="form-control" required>

        <label class="mt-3">Rating (1-5):</label>
        <input type="number" id="rating" class="form-control" min="1" max="5" required>

        <label class="mt-3">Review:</label>
        <textarea id="reviewText" rows="4" class="form-control" required></textarea>

        <button type="submit" class="btn btn-success w-100 mt-3">Submit Review</button>
    </form>

    <div class="reviews mt-5 mx-auto" style="max-width: 500px;">
        <h3>All Reviews</h3>
        <div class="avg-rating text-center fw-bold mb-3" id="avgRating">⭐ Average Rating: 0/5</div>
    </div>
</div>

<script>
    const form = document.getElementById('reviewForm');
    const reviewsDiv = document.querySelector('.reviews');
    const avgRatingDiv = document.getElementById('avgRating');
    let ratings = [];

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const course = document.getElementById('course').value;
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const rating = parseInt(document.getElementById('rating').value);
        const text = document.getElementById('reviewText').value;
        const date = new Date().toLocaleString();

        ratings.push(rating);
        const avg = (ratings.reduce((a, b) => a + b, 0) / ratings.length).toFixed(1);

        const reviewBox = document.createElement('div');
        reviewBox.classList.add('p-3', 'mb-3', 'bg-white', 'rounded', 'shadow-sm');
        reviewBox.innerHTML = `
            <h5>${name} (${course})</h5>
            <p>📧 ${email}</p>
            <p>⭐ Rating: ${rating}/5</p>
            <p>${text}</p>
            <small>Posted on: ${date}</small>
        `;

        reviewsDiv.appendChild(reviewBox);
        avgRatingDiv.innerText = `⭐ Average Rating: ${avg}/5`;

        form.reset();
    });
</script>
@endsection
