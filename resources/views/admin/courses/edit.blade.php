@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Course</h1>

    <form action="{{ route('admin.courses.update', $course) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Course Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $course->title }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" required>{{ $course->description }}</textarea>
        </div>

        <div class="form-group">
            <label for="video">Upload Video</label>
            <input type="file" name="video" id="video" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Course</button>
    </form>
</div>
@endsection
