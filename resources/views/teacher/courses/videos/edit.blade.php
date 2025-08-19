@extends('layouts.teacher')

@section('title', 'Edit Video')

@section('content')
<div class="container py-4">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow">
				<div class="card-header bg-warning text-white">
					<div class="d-flex justify-content-between align-items-center">
						<h4 class="mb-0">Edit Video</h4>
						<a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-light btn-sm">
							<i class="fas fa-arrow-left me-2"></i>Back to Course
						</a>
					</div>
				</div>
				<div class="card-body">
					<div class="mb-4">
						<h6>Course: {{ $course->title }}</h6>
						<h6>Module: {{ $module->title }}</h6>
					</div>

					<form action="{{ route('teacher.courses.videos.update', [$course, $module, $video]) }}" method="POST" enctype="multipart/form-data">
						@csrf
						@method('PATCH')

						<div class="form-group mb-3">
							<label for="title" class="form-label">Video Title *</label>
							<input type="text" class="form-control @error('title') is-invalid @enderror" 
							       id="title" name="title" value="{{ old('title', $video->title) }}" required>
							@error('title')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-group mb-3">
							<label for="description" class="form-label">Video Description</label>
							<textarea class="form-control @error('description') is-invalid @enderror" 
							          id="description" name="description" rows="3">{{ old('description', $video->description) }}</textarea>
							@error('description')
								<div class="invalid-feedback">{{ $message }}</div>
							@enderror
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label class="form-label">Current Video</label>
									<div class="border rounded p-2">
										<small class="text-muted">Stored at: storage/{{ $video->video_url }}</small>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="video" class="form-label">Replace Video (optional)</label>
									<input type="file" class="form-control @error('video') is-invalid @enderror" 
									       id="video" name="video" accept="video/*">
									<small class="form-text text-muted">Max size 100MB. MP4/AVI/MOV/WMV</small>
									@error('video')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="duration" class="form-label">Duration (minutes) *</label>
									<input type="number" class="form-control @error('duration') is-invalid @enderror" 
									       id="duration" name="duration" value="{{ old('duration', $video->duration) }}" min="1" required>
									@error('duration')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-3">
									<label for="order" class="form-label">Video Order *</label>
									<input type="number" class="form-control @error('order') is-invalid @enderror" 
									       id="order" name="order" value="{{ old('order', $video->order) }}" min="1" required>
									@error('order')
										<div class="invalid-feedback">{{ $message }}</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="form-check mb-3">
							<input class="form-check-input" type="checkbox" id="is_free" name="is_free" value="1" 
							       {{ old('is_free', $video->is_free) ? 'checked' : '' }}>
							<label class="form-check-label" for="is_free">Make this video free for preview</label>
						</div>

						<div class="d-flex justify-content-between">
							<a href="{{ route('teacher.courses.show', $course) }}" class="btn btn-secondary">
								<i class="fas fa-times me-2"></i>Cancel
							</a>
							<button type="submit" class="btn btn-warning">
								<i class="fas fa-save me-2"></i>Update Video
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
