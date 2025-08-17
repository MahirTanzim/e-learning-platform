{{-- resources/views/review.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    body {
        background: #f4f7fa;
    }
    .review-card {
        background: #fff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transition: transform 0.2s ease-in-out;
    }
    .review-card:hover {
        transform: translateY(-3px);
        background: #fafafa;
    }
    .form-box {
        background: #fff;
        padding: 25px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    .btn-custom {
        background: linear-gradient(90deg, #4CAF50, #2e8b57);
        color: white;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-custom:hover {
        background: linear-gradient(90deg, #2e8b57, #4CAF50);
    }
    .avg-rating {
        font-size: 20px;
        font-weight: bold;
        color: #444;
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-4">📚 Course Review Page</h2>

    {{-- Review Form --}}
    <div class="form-box mx-auto" style="max-width: 550px;">
        <form id="reviewForm">
            <label class="fw-bold">Select Course:</label>
            <select id="course" class="form-control mb-3" required>
                <option value="">-- Select --</option>
                <option>Compiler Design</option>
                <option>Web Development</option>
                <option>Database Systems</option>
            </select>

            <label class="fw-bold">Your Name:</label>
            <input type="text" id="name" class="form-control mb-3" required>

            <label class="fw-bold">Your Email:</label>
            <input type="email" id="email" class="form-control mb-3" required>

            <label class="fw-bold">Rating (1-5):</label>
            <input type="number" id="rating" class="form-control mb-3" min="1" max="5" required>

            <label class="fw-bold">Review:</label>
            <textarea id="reviewText" rows="4" class="form-control mb-3" required></textarea>

            <button type="submit" class="btn btn-custom w-100">✨ Submit Review</button>
        </form>
    </div>

    {{-- Reviews Section --}}
    <div class="reviews mt-5 mx-auto" style="max-width: 600px;">
        <h3 class="mb-3">📝 All Reviews</h3>
        <div class="avg-rating text-center mb-4" id="avgRating">⭐ Average Rating: 0/5</div>
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
        reviewBox.classList.add('review-card', 'mb-3');
        reviewBox.innerHTML = `
            <h5 class="mb-1">${name} <small class="text-muted">(${course})</small></h5>
            <p class="text-secondary mb-1">📧 ${email}</p>
            <p class="mb-1">⭐ Rating: <strong>${rating}/5</strong></p>
            <p class="mb-2">${text}</p>
            <small class="text-muted">📅 Posted on: ${date}</small>
        `;

        reviewsDiv.appendChild(reviewBox);
        avgRatingDiv.innerText = `⭐ Average Rating: ${avg}/5`;

        form.reset();
    });
</script>
@endsection
