@extends('layouts.app')

@section('title', 'English Courses - AcademiaBD')

@section('content')
<div class="course-header">
    <h1 class="display-5 fw-bold text-primary">English Courses</h1>
    <p class="text-muted lead">Enhance your language, literature, and communication skills.</p>
</div>

<section class="course-section">
    <h2 class="mb-4 text-center">Featured English Courses</h2>
    <div class="row g-4">
        @foreach($courses as $course)
            @include('components.course-card', ['course' => $course])
        @endforeach
    </div>
</section>
@endsection
