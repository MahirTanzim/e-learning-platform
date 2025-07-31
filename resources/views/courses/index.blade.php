@extends('layouts.app')

@section('title', 'All Courses')

@section('content')
<div class="container py-5">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-lg-8">
            <h1 class="fw-bold">All Courses</h1>
            <p class="text-muted">Discover thousands of courses to advance your skills</p>
        </div>
        <div class="col-lg-4">
            <form method="GET" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" 
                       placeholder="Search courses..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <div class="row">
        <!-- Filters Sidebar -->
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Filters</h5>
                </div>
                <div class="card-body">
                    <form method="GET">
                        <!-- Categories Filter -->
                        <div class="mb-4">
                            <h6>Categories</h6>
                            @foreach($categories as $category)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="categories[]" 
                                           value="{{ $category->id }}" id="cat{{ $category->id }}"
                                           {{ in_array($category->id, request('categories', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="cat{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Level Filter -->
                        <div class="mb-4">
                            <h6>Level</h6>
                            @foreach(['beginner', 'intermediate', 'advanced'] as $level)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="level" 
                                           value="{{ $level }}" id="{{ $level }}"
                                           {{ request('level') == $level ? 'checked' : '' }}>
                                    <label class="form-check-label" for="{{ $level }}">
                                        {{ ucfirst($level) }}
                                    </label>
                                </div>
                            @endforeach
                        </div>

                        <!-- Price Filter -->
                        <div class="mb-4">
                            <h6>Price</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" 
                                       value="free" id="free" {{ request('price') == 'free' ? 'checked' : '' }}>
                                <label class="form-check-label" for="free">Free</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="price" 
                                       value="paid" id="paid" {{ request('price') == 'paid' ? 'checked' : '' }}>
                                <label class="form-check-label" for="paid">Paid</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary w-100 mt-2">Clear</a>
                    </form>
                </div>
            </div>
        </div>

        <!-- Courses Grid -->
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <p class="text-muted mb-0">{{ $courses->total() }} courses found</p>
                <select class="form-select w-auto" onchange="location = this.value;">
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'latest']) }}" 
                            {{ request('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'popular']) }}" 
                            {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_low']) }}" 
                            {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                    <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_high']) }}" 
                            {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                </select>
            </div>

            <div class="row">
                @forelse($courses as $course)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card course-card h-100">
                            <img src="{{ $course->thumbnail_url }}" class="card-img-top" 
                                 alt="{{ $course->title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <span class="badge bg-primary mb-2 align-self-start">{{ $course->category->name }}</span>
                                <h5 class="card-title">{{ $course->title }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($course->description, 80) }}
                                </p>
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <small class="text-muted">
                                        <i class="fas fa-user me-1"></i>{{ $course->teacher->name }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="fas fa-users me-1"></i>{{ $course->total_students }}
                                    </small>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        @if($course->price > 0)
                                            <span class="h5 text-primary mb-0">${{ $course->price }}</span>
                                        @else
                                            <span class="h5 text-success mb-0">Free</span>
                                        @endif
                                    </div>
                                    <div>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $course->average_rating)
                                                <i class="fas fa-star text-warning"></i>
                                            @else
                                                <i class="far fa-star text-warning"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                                <a href="{{ route('courses.show', $course->slug) }}" 
                                   class="btn btn-primary mt-3">View Course</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-search fa-3x text-muted mb-3"></i>
                            <h4>No courses found</h4>
                            <p class="text-muted">Try adjusting your filters or search terms</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($courses->hasPages())
                <div class="d-flex justify-content-center mt-4">
                    {{ $courses->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection