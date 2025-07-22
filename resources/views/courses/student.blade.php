<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/styles/student.css') }}">
</head>

<body class="py-5">

    <div class="container">

        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center mb-4" id="portalTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" data-bs-target="#dashboard"
                    type="button" role="tab">Dashboard</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab">Profile</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="courses-tab" data-bs-toggle="tab" data-bs-target="#courses" type="button"
                    role="tab">Courses</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="messages-tab" data-bs-toggle="tab" data-bs-target="#messages"
                    type="button" role="tab">Messages</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="progress-tab" data-bs-toggle="tab" data-bs-target="#progress"
                    type="button" role="tab">Progress</button>
            </li>
        </ul>

        <div class="tab-content" id="portalTabsContent">

            <!-- Dashboard -->
            <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
                <h3 class="section-title">Welcome, {{ Auth::user()->name }}</h3>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="card text-center p-3">
                            <h5>Courses Enrolled</h5>
                            <p class="fs-4 fw-bold">{{ count($courses) }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card text-center p-3">
                            <h5>Unread Messages</h5>
                            <p class="fs-4 fw-bold">{{ $messages->count() }}</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card text-center p-3">
                            <h5>Progress Average</h5>
                            <p class="fs-4 fw-bold">
                                {{ round($courses->avg('progress')) }}%
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile -->
            <div class="tab-pane fade" id="profile" role="tabpanel">
                <h3 class="section-title">👤 My Profile</h3>
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="{{ Auth::user()->email }}"
                            required>
                    </div>
                    <button type="submit" class="btn btn-success">Update</button>
                </form>
            </div>

            <!-- Courses -->
            <div class="tab-pane fade" id="courses" role="tabpanel">
                <h3 class="section-title">📚 My Courses</h3>
                <div class="row">
                    @foreach ($courses as $course)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5>{{ $course->title }}</h5>
                                    <p class="text-muted">{{ Str::limit($course->description, 100) }}</p>
                                    <a href="{{ route('courses.show', $course->id) }}" class="btn btn-custom">View
                                        Course</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Messages -->
            <div class="tab-pane fade" id="messages" role="tabpanel">
                <h3 class="section-title">📬 Notifications & Messages</h3>
                @forelse ($messages as $msg)
                    <div class="alert alert-info">
                        <strong>{{ $msg->title }}</strong><br>
                        {{ $msg->body }}
                        <small class="d-block text-muted mt-1">{{ $msg->created_at->diffForHumans() }}</small>
                    </div>
                @empty
                    <p class="text-muted">No messages yet.</p>
                @endforelse
            </div>

            <!-- Course Progress -->
            <div class="tab-pane fade" id="progress" role="tabpanel">
                <h3 class="section-title">📈 Course Progress</h3>
                @foreach ($courses as $course)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $course->title }}</strong>
                            <span>{{ $course->progress }}%</span>
                        </div>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" style="width: {{ $course->progress }}%;"
                                aria-valuenow="{{ $course->progress }}" aria-valuemin="0" aria-valuemax="100">
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
