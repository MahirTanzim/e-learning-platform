@extends('layouts.app') {{-- Adjust this if your layout is named differently --}}

@section('content')
<div class="container my-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Become a Teacher</h1>
        <p class="text-muted">Share your knowledge and inspire thousands of students online</p>
    </div>

    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="{{ asset('images/teacher-illustration.png') }}" alt="Become a Teacher" class="img-fluid rounded">
        </div>
        <div class="col-md-6">
            <h3 class="fw-semibold">Why Teach with AcademiaBD?</h3>
            <ul class="list-unstyled mt-3">
                <li>✔️ Reach thousands of eager learners</li>
                <li>✔️ Set your own schedule and course prices</li>
                <li>✔️ Get full support from our content team</li>
                <li>✔️ Earn money doing what you love</li>
            </ul>
            <a href="{{ route('register') }}" class="btn btn-primary mt-4">Start Teaching</a>
        </div>
    </div>

    <div class="text-center mt-5">
        <h4>Already a teacher?</h4>
        <a href="{{ route('login') }}" class="btn btn-outline-secondary mt-2">Log In to Your Dashboard</a>
    </div>
</div>
@endsection
