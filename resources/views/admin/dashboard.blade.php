
@extends('layouts.admin')

@section('content')
<!--
        Unified Admin / Teacher / Student Dashboard
        Converted from HTML to Blade. All JS and CSS are included inline for demo/prototype purposes.
        Replace static data with dynamic Blade variables as needed.
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Unified Admin / Teacher / Student Dashboard</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet"/>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <style>
        :root{
            --accent: #2b6cb0;    /* simple blue accent */
            --muted: #6c757d;
            --card-radius: 12px;
            --soft-bg: #f7f9fb;
        }

        body{
            background: var(--soft-bg);
            font-family: Inter, "Segoe UI", system-ui, -apple-system, "Helvetica Neue", Arial;
            color: #222;
        }

        /* Topbar */
        .topbar{
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: .5rem 1rem;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .brand {
            font-weight: 700;
            color: var(--accent);
            letter-spacing: .2px;
        }

        /* Layout */
        .app {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 1rem;
            padding: 1.25rem;
        }

        @media (max-width: 992px){
            .app {
                grid-template-columns: 1fr;
            }
        }

        /* Sidebar */
        .sidebar {
            background: #fff;
            padding: .75rem;
            border-radius: var(--card-radius);
            box-shadow: 0 6px 18px rgba(16,24,40,0.04);
            height: fit-content;
        }
        .nav-link { color: #495057; }
        .nav-link.active { color: var(--accent); font-weight:600; }

        /* Cards */
        .card-panel {
            border-radius: var(--card-radius);
            box-shadow: 0 6px 20px rgba(16,24,40,0.05);
            transition: transform .25s ease, box-shadow .25s ease;
        }
        .card-panel:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(16,24,40,0.06); }

        .small-muted { color: var(--muted); font-size: .9rem; }

        /* Animations */
        .fade-up { animation: fadeUp .6s ease both; }
        @keyframes fadeUp{ from{ opacity:0; transform: translateY(10px);} to{opacity:1; transform:none;} }

        /* Review boxes */
        .review { background:#fff; border-radius:10px; padding:12px; margin-bottom:10px; box-shadow:0 3px 12px rgba(16,24,40,0.03); }
        .badge-role { font-size:.75rem; padding:.35rem .5rem; border-radius:6px; }

        /* Tiny UI niceties */
        .icon-lg { font-size:1.45rem; }
        .muted-sm { color:#8891a6; font-size:.85rem; }

        /* responsive canvas container */
        .chart-wrap { min-height:220px; display:flex; align-items:center; }

        /* notification pulse */
        .notif-dot { width:10px; height:10px; background:#ff7b7b; display:inline-block; border-radius:50%; box-shadow: 0 0 0 rgba(255,123,123,0.4); animation: pulse 1.8s infinite; margin-left:6px; }
        @keyframes pulse { 0% { box-shadow:0 0 0 0 rgba(255,123,123,0.4);} 70% { box-shadow:0 0 0 8px rgba(255,123,123,0);} 100% { box-shadow:0 0 0 0 rgba(255,123,123,0);} }

        /* compact table visuals */
        table.table td, table.table th { vertical-align: middle; }
    </style>
</head>
<body>

    <!-- TOPBAR -->
    <div class="topbar d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <div class="brand d-flex align-items-center gap-2">
                <i class="bi bi-speedometer2" style="color:var(--accent)"></i>
                <span>EduPanel</span>
            </div>
            <div class="small-muted">unified admin • teacher • student prototype</div>
        </div>

        <div class="d-flex align-items-center gap-3">
            <div class="d-none d-md-block small-muted">Notifications</div>
            <div class="me-2">
                <button class="btn btn-outline-secondary btn-sm position-relative" id="btn-notif">
                    <i class="bi bi-bell"></i>
                    <span class="notif-dot" title="3 unread"></span>
                </button>
            </div>

            <!-- Role selector -->
            <div>
                <select id="roleSelect" class="form-select form-select-sm" aria-label="Select view role">
                    <option value="admin" selected>Admin View</option>
                    <option value="teacher">Teacher View</option>
                    <option value="student">Student View</option>
                </select>
            </div>
        </div>
    </div>

    <!-- APP GRID -->
    <div class="app container-fluid">
        <!-- SIDEBAR -->
        <aside class="sidebar fade-up">
            <div class="mb-3 d-flex align-items-center justify-content-between">
                <div>
                    <div class="fw-700">Admin Panel</div>
                    <div class="muted-sm">manage the system</div>
                </div>
                <button class="btn btn-sm btn-outline-secondary d-lg-none" id="toggleSidebar"><i class="bi bi-list"></i></button>
            </div>

            <nav class="nav flex-column">
                <a class="nav-link active" data-target="dashboard"> <i class="bi bi-grid-fill me-2"></i> Dashboard</a>
                <a class="nav-link" data-target="profiles"> <i class="bi bi-people me-2"></i> Profiles</a>
                <a class="nav-link" data-target="reviews"> <i class="bi bi-chat-left-text me-2"></i> Reviews</a>
                <a class="nav-link" data-target="suggestions"> <i class="bi bi-lightbulb me-2"></i> Suggestions</a>
                <a class="nav-link" data-target="tasks"> <i class="bi bi-check2-square me-2"></i> Tasks</a>
                <a class="nav-link" data-target="messages"> <i class="bi bi-envelope me-2"></i> Messages</a>
                <hr/>
                <a class="nav-link text-danger" id="logoutBtn"> <i class="bi bi-box-arrow-right me-2"></i> Logout</a>
            </nav>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="content">
            <!-- DASHBOARD PANEL -->
            <section id="panel-dashboard" class="fade-up mb-4">
                <div class="row g-3">
                    <!-- STAT CARDS -->
                    <div class="col-12">
                        <div class="row g-3">
                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 card-panel bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small-muted">Total Users</div>
                                            <div class="h4 mb-0" id="stat-users">--</div>
                                        </div>
                                        <i class="bi bi-people-fill icon-lg" style="color:var(--accent)"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 card-panel bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small-muted">Total Courses</div>
                                            <div class="h4 mb-0" id="stat-courses">--</div>
                                        </div>
                                        <i class="bi bi-journal-bookmark icon-lg" style="color:#198754"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 card-panel bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small-muted">Active Teachers</div>
                                            <div class="h4 mb-0" id="stat-teachers">--</div>
                                        </div>
                                        <i class="bi bi-person-badge-fill icon-lg" style="color:#0d6efd"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-3">
                                <div class="p-3 card-panel bg-white">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <div class="small-muted">Notifications</div>
                                            <div class="h4 mb-0" id="stat-notifs">--</div>
                                        </div>
                                        <i class="bi bi-bell icon-lg" style="color:#ff9f43"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Charts -->
                    <div class="col-12 col-lg-6">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>User Growth</strong>
                                    <div class="muted-sm">Monthly new users</div>
                                </div>
                                <div class="muted-sm">Last 6 months</div>
                            </div>
                            <div class="chart-wrap">
                                <canvas id="chartUserGrowth" style="width:100%"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-6">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>Course Enrollment</strong>
                                    <div class="muted-sm">Top subjects</div>
                                </div>
                                <div class="muted-sm">Current term</div>
                            </div>
                            <div class="chart-wrap">
                                <canvas id="chartCourseEnrollment"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- PROFILES PANEL -->
            <section id="panel-profiles" class="d-none fade-up mb-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div><strong>Teacher Profiles</strong><div class="muted-sm">Active & recent</div></div>
                                <div><button class="btn btn-sm btn-outline-secondary" id="btn-add-teacher"><i class="bi bi-plus"></i> New</button></div>
                            </div>

                            <ul class="list-group" id="teacherList">
                                <!-- JS populated -->
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div><strong>Student Profiles</strong><div class="muted-sm">Enrolled users</div></div>
                                <div><button class="btn btn-sm btn-outline-secondary" id="btn-add-student"><i class="bi bi-plus"></i> New</button></div>
                            </div>

                            <ul class="list-group" id="studentList">
                                <!-- JS populated -->
                            </ul>
                        </div>
                    </div>
                </div>
            </section>

            <!-- REVIEWS PANEL (Admin) -->
            <section id="panel-reviews" class="d-none fade-up mb-4">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div><strong>Teacher Reviews</strong><div class="muted-sm">Feedback left by teachers</div></div>
                                <div>
                                    <input class="form-control form-control-sm" id="searchTeacherRev" placeholder="Search review..."/>
                                </div>
                            </div>

                            <div id="teacherReviews">
                                <!-- JS populated -->
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div><strong>Student Reviews</strong><div class="muted-sm">Feedback left by students</div></div>
                                <div>
                                    <input class="form-control form-control-sm" id="searchStudentRev" placeholder="Search review..."/>
                                </div>
                            </div>

                            <div id="studentReviews">
                                <!-- JS populated -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SUGGESTIONS PANEL -->
            <section id="panel-suggestions" class="d-none fade-up mb-4">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card-panel p-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <strong>Suggestions</strong>
                                    <div class="muted-sm">Collected ideas & feature requests</div>
                                </div>
                                <div>
                                    <button class="btn btn-sm btn-outline-secondary" id="btn-add-suggestion"><i class="bi bi-plus"></i> Add</button>
                                </div>
                            </div>

                            <ul class="list-group" id="listSuggestions"></ul>
                        </div>
                    </div>

                    <div class="col-12 mt-2">
                        <div class="card-panel p-3">
                            <strong>Tips</strong>
                            <div class="row g-3 mt-2" id="tipsRow">
                                <!-- JS populated -->
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TASKS PANEL -->
            <section id="panel-tasks" class="d-none fade-up mb-4">
                <div class="card-panel p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div><strong>Tasks</strong><div class="muted-sm">Quick admin actions</div></div>
                        <div><button class="btn btn-sm btn-outline-secondary" id="btn-clear-tasks">Clear done</button></div>
                    </div>

                    <ul class="list-group" id="taskList">
                        <!-- JS populated -->
                    </ul>
                </div>
            </section>

            <!-- MESSAGES PANEL -->
            <section id="panel-messages" class="d-none fade-up mb-4">
                <div class="card-panel p-3">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div><strong>Messages</strong><div class="muted-sm">Inbox (preview)</div></div>
                        <div><button class="btn btn-sm btn-outline-secondary" id="btn-compose"><i class="bi bi-pencil-square"></i> Compose</button></div>
                    </div>

                    <table class="table table-hover mb-0">
                        <thead>
                            <tr><th>From</th><th>Subject</th><th>Date</th><th></th></tr>
                        </thead>
                        <tbody id="messageTableBody">
                            <!-- JS populated -->
                        </tbody>
                    </table>
                </div>
            </section>

        </main>
    </div>

    <!-- FOOTER -->
    <footer class="text-center small-muted py-3">Prototype • Front-end only • Connect to backend for dynamic data</footer>

    <!-- JS (app logic) -->
    <script>
        // ---------- SAMPLE DATA ----------
        const sampleStats = { users: 420, courses: 48, teachers: 28, notifications: 3 };
        const sampleUserGrowth = { labels:['Mar','Apr','May','Jun','Jul','Aug'], data:[35,45,55,70,95,120] };
        const sampleEnrollment = { labels:['Math','Physics','CS','Biology','History'], data:[120,95,75,60,45] };

        const teachers = [
            { id:1, name:'John Doe', subject:'Mathematics', joined:'2024-01-12' },
            { id:2, name:'Jane Smith', subject:'English', joined:'2023-11-04' },
            { id:3, name:'Mark Wilson', subject:'Physics', joined:'2024-05-08' }
        ];
        const students = [
            { id:1, name:'Alice Johnson', enrolled:6 },
            { id:2, name:'Bob Anderson', enrolled:4 },
            { id:3, name:'Charlie Brown', enrolled:5 }
        ];
        let teacherReviews = [
            { id:1, name:'John Doe', date:'2025-08-12', text:'Great platform; add analytics view.', approved:false },
            { id:2, name:'Emily Johnson', date:'2025-08-10', text:'Scheduling announcements would help.', approved:true }
        ];
        let studentReviews = [
            { id:1, name:'Michael Brown', date:'2025-08-11', text:'More video lessons please.', approved:false },
            { id:2, name:'Sophia Davis', date:'2025-08-09', text:'Dashboard could load faster on slow networks.', approved:true }
        ];
        let suggestions = [
            'Add a night mode for easier reading.',
            'Allow custom grading rubrics for teachers.',
            'Enable offline access to course materials.'
        ];
        let tips = [
            'Check dashboard daily for updates.',
            'Keep your profile updated for better suggestions.',
            'Use messaging to contact colleagues quickly.'
        ];
        let tasks = [
            { id:1, text:'Approve new course "Advanced HTML"', done:false },
            { id:2, text:'Review teacher requests', done:false },
            { id:3, text:'Respond to support ticket #1032', done:true }
        ];
        let messages = [
            { from:'Admin Team', subject:'System maintenance 15 Aug', date:'2025-08-07' },
            { from:'Support', subject:'Ticket #1032 response', date:'2025-08-10' }
        ];

        // ---------- UTIL & DOM ----------
        const qs = sel => document.querySelector(sel);
        const qsa = sel => document.querySelectorAll(sel);

        // Role switch: admin / teacher / student
        const roleSelect = qs('#roleSelect');
        const panels = {
            dashboard: qs('#panel-dashboard'),
            profiles: qs('#panel-profiles'),
            reviews: qs('#panel-reviews'),
            suggestions: qs('#panel-suggestions'),
            tasks: qs('#panel-tasks'),
            messages: qs('#panel-messages')
        };

        function showOnlyPanel(targetPanel){
            Object.values(panels).forEach(p => p.classList.add('d-none'));
            panels[targetPanel].classList.remove('d-none');
            // update active nav link
            qsa('.sidebar .nav-link').forEach(a => a.classList.toggle('active', a.dataset.target === targetPanel));
        }

        // update stats
        function renderStats(){
            qs('#stat-users').textContent = sampleStats.users;
            qs('#stat-courses').textContent = sampleStats.courses;
            qs('#stat-teachers').textContent = sampleStats.teachers;
            qs('#stat-notifs').textContent = sampleStats.notifications;
        }

        // render lists
        function renderTeacherList(){
            const container = qs('#teacherList');
            container.innerHTML = teachers.map(t => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold">${t.name}</div>
                        <div class="muted-sm">${t.subject} • Joined ${t.joined}</div>
                    </div>
                    <div><button class="btn btn-sm btn-outline-primary">View</button></div>
                </li>
            `).join('');
        }
        function renderStudentList(){
            const container = qs('#studentList');
            container.innerHTML = students.map(s => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <div class="fw-semibold">${s.name}</div>
                        <div class="muted-sm">${s.enrolled} enrolled courses</div>
                    </div>
                    <div><button class="btn btn-sm btn-outline-primary">View</button></div>
                </li>
            `).join('');
        }

        // reviews rendering (with approve/delete)
        function renderReviews(){
            const tcont = qs('#teacherReviews');
            tcont.innerHTML = teacherReviews.map(r => renderReviewHtml(r,'teacher')).join('');
            const scont = qs('#studentReviews');
            scont.innerHTML = studentReviews.map(r => renderReviewHtml(r,'student')).join('');

            // bind buttons
            qsa('.btn-approve').forEach(b => b.addEventListener('click', e=>{
                const id = +e.currentTarget.dataset.id;
                const role = e.currentTarget.dataset.role;
                toggleApprove(role, id);
            }));
            qsa('.btn-delete').forEach(b => b.addEventListener('click', e=>{
                const id = +e.currentTarget.dataset.id;
                const role = e.currentTarget.dataset.role;
                deleteReview(role,id);
            }));
        }
        function renderReviewHtml(r,role){
            return `
                <div class="review d-flex justify-content-between align-items-start">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <div class="fw-semibold">${r.name}</div>
                            <div class="badge ${r.approved ? 'bg-success text-white' : 'bg-secondary text-white'} badge-role">${r.approved ? 'Approved' : 'Pending'}</div>
                            <div class="muted-sm ms-2">${r.date}</div>
                        </div>
                        <div class="small-muted">${escapeHtml(r.text)}</div>
                    </div>
                    <div class="text-end">
                        <button class="btn btn-sm btn-outline-success btn-approve" data-id="${r.id}" data-role="${role}"><i class="bi bi-check-lg"></i></button>
                        <button class="btn btn-sm btn-outline-danger btn-delete" data-id="${r.id}" data-role="${role}"><i class="bi bi-trash"></i></button>
                    </div>
                </div>
            `;
        }

        function toggleApprove(role,id){
            const arr = role === 'teacher' ? teacherReviews : studentReviews;
            const idx = arr.findIndex(x => x.id === id);
            if(idx !== -1){ arr[idx].approved = !arr[idx].approved; renderReviews(); }
        }
        function deleteReview(role,id){
            if(!confirm('Delete this review?')) return;
            if(role === 'teacher'){
                teacherReviews = teacherReviews.filter(r => r.id !== id);
            } else {
                studentReviews = studentReviews.filter(r => r.id !== id);
            }
            renderReviews();
        }

        // suggestions & tips
        function renderSuggestions(){ qs('#listSuggestions').innerHTML = suggestions.map((s, i) => `<li class="list-group-item d-flex justify-content-between align-items-center">${escapeHtml(s)}<button class="btn btn-sm btn-outline-danger" data-i="${i}" onclick="removeSuggestion(${i})"><i class="bi bi-trash"></i></button></li>`).join(''); }
        function removeSuggestion(i){ suggestions.splice(i,1); renderSuggestions(); }

        function renderTips(){
            qs('#tipsRow').innerHTML = tips.map(t => `
                <div class="col-md-4">
                    <div class="p-3 card-panel">
                        <div class="fw-semibold">${escapeHtml(t)}</div>
                    </div>
                </div>
            `).join('');
        }

        // tasks & messages
        function renderTasks(){
            qs('#taskList').innerHTML = tasks.map(t => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div><input class="form-check-input me-2 task-check" data-id="${t.id}" type="checkbox" ${t.done ? 'checked' : ''}> ${escapeHtml(t.text)}</div>
                    <div><button class="btn btn-sm btn-outline-danger btn-task-del" data-id="${t.id}"><i class="bi bi-trash"></i></button></div>
                </li>
            `).join('');
            // bind checkboxes and delete
            qsa('.task-check').forEach(cb => cb.addEventListener('change', e=>{
                const id = +e.currentTarget.dataset.id;
                const task = tasks.find(t=>t.id===id); if(task) task.done = e.currentTarget.checked; renderTasks();
            }));
            qsa('.btn-task-del').forEach(b => b.addEventListener('click', e=>{
                const id = +e.currentTarget.dataset.id; tasks = tasks.filter(t=>t.id!==id); renderTasks();
            }));
        }

        function renderMessages(){
            qs('#messageTableBody').innerHTML = messages.map(m => `
                <tr>
                    <td>${escapeHtml(m.from)}</td>
                    <td>${escapeHtml(m.subject)}</td>
                    <td class="muted-sm">${escapeHtml(m.date)}</td>
                    <td><button class="btn btn-sm btn-outline-primary">Open</button></td>
                </tr>
            `).join('');
        }

        // ---------- CHARTS ----------
        let userChart, courseChart;
        function buildCharts(){
            const ctx1 = qs('#chartUserGrowth').getContext('2d');
            if(userChart) userChart.destroy();
            userChart = new Chart(ctx1, {
                type:'line',
                data: {
                    labels: sampleUserGrowth.labels,
                    datasets: [{ label:'New users', data: sampleUserGrowth.data, tension:.35, borderColor: 'var(--accent)', backgroundColor:'rgba(43,108,176,0.12)', pointRadius:3 }]
                },
                options: { responsive:true, plugins:{legend:{display:false}} }
            });

            const ctx2 = qs('#chartCourseEnrollment').getContext('2d');
            if(courseChart) courseChart.destroy();
            courseChart = new Chart(ctx2, {
                type:'bar',
                data: {
                    labels: sampleEnrollment.labels,
                    datasets:[{ label:'Enrollments', data: sampleEnrollment.data, borderRadius:6 }]
                },
                options:{ responsive:true, plugins:{legend:{display:false}} }
            });
        }

        // ---------- NAV & EVENTS ----------
        qsa('.sidebar .nav-link').forEach(a => {
            a.addEventListener('click', e => {
                const t = e.currentTarget.dataset.target;
                showOnlyPanel(t);
            });
        });

        // role change: can be used to customize views
        roleSelect.addEventListener('change', e => {
            const r = e.target.value;
            // simple demonstration: show dashboard for all,
            // but toggle visibility of certain panels, or pre-select nav:
            if(r === 'admin'){
                showOnlyPanel('dashboard');
                qs('.brand').textContent = 'EduPanel';
            } else if(r === 'teacher'){
                showOnlyPanel('profiles');
                qs('.brand').textContent = 'Teacher View';
            } else {
                showOnlyPanel('profiles');
                qs('.brand').textContent = 'Student View';
            }
        });

        // search filters for reviews
        qs('#searchTeacherRev').addEventListener('input', e => filterReviews('teacher', e.target.value));
        qs('#searchStudentRev').addEventListener('input', e => filterReviews('student', e.target.value));
        function filterReviews(role,q){
            q=q.trim().toLowerCase();
            const arr = role === 'teacher' ? teacherReviews : studentReviews;
            const cont = role === 'teacher' ? qs('#teacherReviews') : qs('#studentReviews');
            cont.innerHTML = arr.filter(r => r.name.toLowerCase().includes(q) || r.text.toLowerCase().includes(q)).map(r => renderReviewHtml(r, role)).join('');
            // rebind buttons after filtering
            qsa('.btn-approve').forEach(b => b.addEventListener('click', e=>{
                toggleApprove(e.currentTarget.dataset.role, +e.currentTarget.dataset.id);
            }));
            qsa('.btn-delete').forEach(b => b.addEventListener('click', e=>{
                deleteReview(e.currentTarget.dataset.role, +e.currentTarget.dataset.id);
            }));
        }

        // small helpers
        function escapeHtml(s){ if(!s) return ''; return s.replace(/[&<>"]'/g, function(m){ return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;','\'':'&#39;'}[m]; }); }

        // clear tasks
        qs('#btn-clear-tasks').addEventListener('click', ()=> { tasks = tasks.filter(t=>!t.done); renderTasks(); });

        // add suggestion
        qs('#btn-add-suggestion').addEventListener('click', ()=>{
            const val = prompt('Enter suggestion (front-end demo):');
            if(val) { suggestions.unshift(val); renderSuggestions(); }
        });

        // add teacher/student quick (demo)
        qs('#btn-add-teacher').addEventListener('click', ()=> { const name = prompt('Teacher name:'); if(name) { teachers.push({ id:Date.now(), name, subject:'New', joined: new Date().toISOString().slice(0,10) }); renderTeacherList(); } });
        qs('#btn-add-student').addEventListener('click', ()=> { const name = prompt('Student name:'); if(name) { students.push({ id:Date.now(), name, enrolled:0 }); renderStudentList(); } });

        // delete suggestion via global function binding used in markup
        window.removeSuggestion = removeSuggestion;

        // logout & other small actions
        qs('#logoutBtn').addEventListener('click', ()=> alert('Logout (demo)'));
        qs('#btn-notif').addEventListener('click', ()=> alert('You have ' + sampleStats.notifications + ' unread notifications (demo)'));

        // ---------- INITIAL RENDER ----------
        function init(){
            renderStats();
            renderTeacherList();
            renderStudentList();
            renderReviews();
            renderSuggestions();
            renderTips();
            renderTasks();
            renderMessages();
            buildCharts();
            showOnlyPanel('dashboard'); // default
        }
        init();

        // make sure charts adjust on resize
        window.addEventListener('resize', ()=> { if(userChart) userChart.resize(); if(courseChart) courseChart.resize(); });

    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
@endsection
