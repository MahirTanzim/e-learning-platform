@extends('layouts.student')

@section('title', $video->title)

@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-lg-8">
      <div class="card mb-4">
        <div class="card-body">
          <div class="d-flex align-items-center mb-3">
            <div>
              <h2 class="mb-1">{{ $video->title }}</h2>
              <p class="text-muted mb-0">Course: {{ $course->title }}</p>
            </div>
          </div>

          <div class="ratio ratio-16x9 mb-3">
            <video id="course-video" controls preload="metadata" src="{{ $video->video_url }}"></video>
          </div>

          @if($video->description)
            <p class="text-muted">{{ $video->description }}</p>
          @endif

          <div class="d-flex justify-content-between">
            <div>
              <small class="text-muted">Duration: {{ $video->duration }} {{ $video->duration == 1 ? 'min' : 'mins' }}</small>
            </div>
            <div>
              <a href="{{ route('student.courses.preview', $course) }}" class="btn btn-outline-secondary btn-sm">Back to course</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card">
        <div class="card-header">
          <h6 class="mb-0">Module Videos</h6>
        </div>
        <div class="card-body p-0">
          <div class="list-group list-group-flush">
            @foreach($video->module->videos()->orderBy('order')->get() as $v)
              <a href="{{ route('student.courses.videos.watch', [$course, $v]) }}" class="list-group-item list-group-item-action d-flex justify-content-between align-items-center {{ $v->id === $video->id ? 'active' : '' }}">
                <div class="d-flex align-items-center">
                  <i class="fas fa-play-circle me-2"></i>
                  <span>{{ $v->title }}</span>
                </div>
                <small>{{ $v->duration }}m</small>
              </a>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
(function() {
  const videoEl = document.getElementById('course-video');
  if (!videoEl) return;

  const csrfToken = '{{ csrf_token() }}';
  const progressUrl = '{{ route('student.videos.progress', $video) }}';
  const reported = { lastMinutes: -1 };

  function sendProgress(minutes) {
    fetch(progressUrl, {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
        'Accept': 'application/json'
      },
      body: JSON.stringify({ watched_duration: minutes })
    }).catch(() => {});
  }

  // Report every ~10s and only when minute value increases
  let throttle; 
  videoEl.addEventListener('timeupdate', function() {
    if (throttle) return;
    throttle = setTimeout(() => { throttle = null; }, 10000);

    const minutes = Math.floor((videoEl.currentTime || 0) / 60);
    if (minutes !== reported.lastMinutes) {
      reported.lastMinutes = minutes;
      sendProgress(minutes);
    }
  });
})();
</script>
@endpush
@endsection
