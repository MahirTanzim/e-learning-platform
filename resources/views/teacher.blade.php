<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Teacher Portal - AcademiaBD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Body & background */
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #13cefd, #e6a700);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            padding: 2rem 0;
        }

        /* Container styling like login page */
        .portal-container {
            max-width: 900px;
            background: #fff;
            margin: 0 auto;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.12);
            padding: 2rem 2.5rem;
        }

        /* Heading */
        h2 {
            color: #14213d;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            letter-spacing: 1.3px;
        }

        /* Nav tabs */
        .nav-tabs {
            border-bottom: none;
            justify-content: center;
        }
        .nav-tabs .nav-link {
            border: none;
            color: #14213d;
            font-weight: 600;
            font-size: 1rem;
            padding: 0.75rem 1.25rem;
            border-radius: 12px 12px 0 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .nav-tabs .nav-link:hover {
            background-color: #e6a700;
            color: #fff;
        }
        .nav-tabs .nav-link.active {
            background-color: #0d6efd;
            color: white;
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
        }

        /* Tab content box */
        .tab-content {
            border: none;
            padding: 1.5rem 1rem 2rem;
            background: #f8f9fa;
            border-radius: 0 16px 16px 16px;
            box-shadow: inset 0 0 8px rgba(0,0,0,0.05);
            min-height: 350px;
        }

        /* Cards in dashboard and other sections */
        .card {
            border-radius: 14px;
            box-shadow: 0 4px 16px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.15);
        }

        /* Form elements styling (from login style) */
        input.form-control,
        textarea.form-control {
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-size: 1rem;
            border: 1.5px solid #ccc;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        input.form-control:focus,
        textarea.form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 8px rgba(13, 110, 253, 0.4);
            outline: none;
        }
        button.btn-primary, button.btn-success {
            border-radius: 12px;
            font-weight: 700;
            letter-spacing: 1.2px;
            padding: 0.65rem 1.5rem;
            box-shadow: 0 4px 12px rgba(13,110,253,0.6);
            transition: background-color 0.3s ease;
        }
        button.btn-primary:hover {
            background-color: #0a58ca;
            box-shadow: 0 6px 16px rgba(10, 88, 202, 0.8);
        }
        button.btn-success:hover {
            background-color: #198754cc;
            box-shadow: 0 6px 16px rgba(25, 135, 84, 0.8);
        }

        /* Progress bar smooth transition */
        .progress-bar {
            transition: width 0.5s ease-in-out;
        }

        /* Message alert styles */
        .alert strong {
            font-weight: 600;
        }

        /* Responsive tweaks */
        @media (max-width: 768px) {
            .portal-container {
                padding: 1.5rem 1rem;
            }
            .nav-tabs .nav-link {
                font-size: 0.9rem;
                padding: 0.5rem 0.75rem;
            }
        }
    </style>
</head>
<body>

<div class="portal-container">

    <h2>👨‍🏫 Teacher Portal</h2>

    <!-- Nav Tabs -->
    <ul class="nav nav-tabs mb-4" id="teacherTabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#dashboard" type="button">Dashboard</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile" type="button">Profile</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#myCourses" type="button">My Courses</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#createCourse" type="button">Create Course</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#messages" type="button">Messages</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#assignments" type="button">Assignments</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#progress" type="button">Progress</button></li>
    </ul>

    <!-- Tab Content -->
    <div class="tab-content">

        <!-- Dashboard -->
        <div class="tab-pane fade show active" id="dashboard" role="tabpanel">
            <h4>📊 Dashboard Overview</h4>
            <div class="row mt-3 g-4">
                <div class="col-md-4">
                    <div class="card p-3 text-center">
                        <h5>Courses Created</h5>
                        <p class="display-6 text-primary">5</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 text-center">
                        <h5>Total Students</h5>
                        <p class="display-6 text-primary">120</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card p-3 text-center">
                        <h5>Pending Assignments</h5>
                        <p class="display-6 text-primary">15</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile -->
        <div class="tab-pane fade" id="profile" role="tabpanel">
            <h4>👤 Profile Settings</h4>
            <form class="mt-3" method="POST" action="{{ route('teacher.profile.update') }}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $teacher->name ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $teacher->email ?? '') }}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Change Password</label>
                    <input id="password" name="password" type="password" class="form-control" placeholder="New Password">
                </div>
                <button type="submit" class="btn btn-primary">Update Profile</button>
            </form>
        </div>

        <!-- My Courses -->
        <div class="tab-pane fade" id="myCourses" role="tabpanel">
            <h4>📚 My Courses</h4>
            <div class="row mt-3 g-4">
                {{-- Example Course Card --}}
                @foreach ($courses as $course)
                <div class="col-md-4">
                    <div class="card p-3">
                        <h5>{{ $course->title }}</h5>
                        <p>{{ Str::limit($course->description, 80) }}</p>
                        <a href="{{ route('teacher.courses.edit', $course->id) }}" class="btn btn-sm btn-outline-primary">Manage</a>
                    </div>
                </div>
                @endforeach
                @if($courses->isEmpty())
                <p class="text-muted">No courses created yet.</p>
                @endif
            </div>
        </div>

        <!-- Create Course -->
        <div class="tab-pane fade" id="createCourse" role="tabpanel">
            <h4>📝 Create New Course</h4>
            <form class="mt-3" method="POST" action="{{ route('teacher.courses.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Course Title</label>
                    <input id="title" name="title" type="text" class="form-control" placeholder="Course Name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" rows="4" class="form-control" placeholder="Course Description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="material" class="form-label">Upload Material</label>
                    <input id="material" name="material" type="file" class="form-control" accept=".pdf,.doc,.docx,.ppt,.pptx" required>
                </div>
                <button type="submit" class="btn btn-success">Create Course</button>
            </form>
        </div>

        <!-- Messages -->
        <div class="tab-pane fade" id="messages" role="tabpanel">
            <h4>📬 Messages</h4>
            <div class="mt-3">
                @forelse ($messages as $msg)
                    <div class="alert alert-info">
                        <strong>{{ $msg->sender_name }}:</strong> {{ $msg->content }}
                    </div>
                @empty
                    <p class="text-muted">No messages yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Assignments -->
        <div class="tab-pane fade" id="assignments" role="tabpanel">
            <h4>📂 Assignment Submissions</h4>
            <div class="mt-3">
                @forelse ($assignments as $assignment)
                    <div class="card p-3 mb-3">
                        <strong>{{ $assignment->student_name }}:</strong> {{ $assignment->title }} - <a href="{{ route('assignments.download', $assignment->id) }}">Download</a>
                        <form action="{{ route('assignments.grade', $assignment->id) }}" method="POST" class="mt-2 d-flex align-items-center" style="gap: 0.5rem;">
                            @csrf
                            <input type="number" name="grade" class="form-control w-25" placeholder="Grade" min="0" max="100" required>
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                @empty
                    <p class="text-muted">No assignment submissions yet.</p>
                @endforelse
            </div>
        </div>

        <!-- Progress -->
        <div class="tab-pane fade" id="progress" role="tabpanel">
            <h4>📈 Student Progress</h4>
            <div class="mt-3">
                @forelse ($progressReports as $progress)
                    <p>{{ $progress->student_name }} – {{ $progress->progress_percentage }}%</p>
                    <div class="progress mb-3">
                        <div class="progress-bar
                            @if($progress->progress_percentage >= 80) bg-success
                            @elseif($progress->progress_percentage >= 50) bg-info
                            @else bg-warning
                            @endif"
                            style="width: {{ $progress->progress_percentage }}%;">
                            {{ $progress->progress_percentage }}%
                        </div>
                    </div>
                @empty
                    <p class="text-muted">No progress reports available.</p>
                @endforelse
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
