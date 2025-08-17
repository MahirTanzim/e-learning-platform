{{-- resources/views/course-review.blade.php --}}
@extends('layouts.app') {{-- Or your own layout file --}}

@section('content')
<div class="container py-4">

  <h2 class="text-center mb-4">📚 Course Review Page</h2>

  <form id="reviewForm" class="bg-white p-4 rounded shadow-sm mx-auto" style="max-width: 500px;">
    <label>Select Course:</label>
    <select id="course" class="form-control" required>
      <option value="">-- Select --</option>
      <option>Compiler Design</option>
      <option>Web Development</option>
      <option>Database Systems</option>
    </select>

    <label class="mt-3">Your Name:</label>
    <input type="text" id="name" class="form-control" required>

    <label class="mt-3">Rating (1-5):</label>
    <input type="number" id="rating" min="1" max="5" class="form-control" required>

    <label class="mt-3">Review:</label>
    <textarea id="reviewText" rows="4" class="form-control" required></textarea>

    <button type="submit" class="btn btn-success mt-3 w-100">Submit Review</button>
  </form>

  <div class="reviews mt-4 mx-auto" style="max-width: 500px;">
    <h3>All Reviews</h3>
    <div id="reviews"></div>
  </div>

</div>

@endsection

@push('scripts')
<script>
  const form = document.getElementById('reviewForm');
  const reviewsDiv = document.getElementById('reviews');

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    const course = document.getElementById('course').value;
    const name = document.getElementById('name').value;
    const rating = document.getElementById('rating').value;
    const text = document.getElementById('reviewText').value;

    const reviewBox = document.createElement('div');
    reviewBox.classList.add('p-3', 'bg-white', 'rounded', 'shadow-sm', 'mb-3');
    reviewBox.innerHTML = `
      <h4>${name} (${course})</h4>
      <p>⭐ Rating: ${rating}/5</p>
      <p>${text}</p>
    `;

    reviewsDiv.appendChild(reviewBox);
    form.reset();
  });
</script>
@endpush
