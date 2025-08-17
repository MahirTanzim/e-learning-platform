{{-- resources/views/course-review.blade.php --}}
@extends('layouts.app') {{-- optional: use your layout --}}

@section('content')
<div class="wrap">
    <div class="header">
        <div>
            <div class="title">📚 Course Review</div>
            <div class="sub">Share your thoughts about the course — ratings, comments, pros/cons, everything here.</div>
        </div>
        <div class="pill">
            <span>Total Reviews:</span>
            <b id="totalCount">0</b>
        </div>
    </div>

    <div class="grid">
        <!-- LEFT: Form -->
        <div class="card">
            <div class="avg">
                <span>Average Rating</span>
                <b><span id="avgScore">0.0</span>/5</b>
                <span class="tag" id="avgTag">No data</span>
            </div>

            <form id="reviewForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div style="flex:1 1 220px">
                        <label>Select Course</label>
                        <select id="course" name="course" required>
                            <option value="" disabled selected>Select a course</option>
                            <option>Data Structures</option>
                            <option>Compiler Design</option>
                            <option>Web Development</option>
                            <option>Database Systems</option>
                            <option>Operating Systems</option>
                        </select>
                    </div>
                    <div style="flex:1 1 220px">
                        <label>Your Name</label>
                        <input id="name" name="name" type="text" placeholder="Enter your name" required />
                    </div>
                    <div style="flex:1 1 220px">
                        <label>Email (Optional)</label>
                        <input id="email" name="email" type="email" placeholder="example@mail.com" />
                    </div>
                </div>

                <div class="row" style="margin-top:10px">
                    <div style="flex:1 1 220px">
                        <label>Review Title</label>
                        <input id="title" name="title" type="text" placeholder="One-line summary of your experience" maxlength="80" required />
                        <div class="counter"><span id="titleCount">0</span>/80</div>
                    </div>
                    <div style="flex:1 1 220px">
                        <label>Rating</label>
                        <div class="stars" id="stars"></div>
                    </div>
                </div>

                <div style="margin-top:10px">
                    <label>Review Description</label>
                    <textarea id="body" name="body" placeholder="Write about course content, teaching, resources — what you liked/disliked." maxlength="600" required></textarea>
                    <div class="counter"><span id="bodyCount">0</span>/600</div>
                </div>

                <div class="row" style="margin-top:10px">
                    <div style="flex:1 1 220px">
                        <label>Pros</label>
                        <input id="pros" name="pros" type="text" placeholder="e.g., clear notes, practical examples" />
                    </div>
                    <div style="flex:1 1 220px">
                        <label>Cons</label>
                        <input id="cons" name="cons" type="text" placeholder="e.g., too many assignments, fast pace" />
                    </div>
                </div>

                <div class="row" style="margin-top:10px; align-items:center">
                    <div class="pill">
                        Recommend?
                        <div id="recommend" class="switch" role="switch" aria-checked="false" tabindex="0"></div>
                    </div>
                    <div class="pill">
                        Proof (Optional)
                        <input id="proof" name="proof" type="file" accept="image/*,.pdf" style="border:none;background:transparent;padding:0" />
                    </div>
                </div>

                <div class="sep"></div>

                <div class="row" style="justify-content:space-between; align-items:center">
                    <button class="btn" type="submit">
                        ✅ Submit Review
                    </button>
                    <button class="btn" type="button" id="clearAll" title="Clear All">🗑️ Clear All</button>
                </div>
            </form>
        </div>

        <!-- RIGHT: Reviews -->
        <div class="card">
            <div class="row" style="justify-content:space-between; align-items:center">
                <div class="pill">Sort By:
                    <select id="sortBy" style="margin-left:8px">
                        <option value="new">Newest</option>
                        <option value="high">Highest Rated</option>
                        <option value="low">Lowest Rated</option>
                    </select>
                </div>
                <div class="pill">Search:
                    <input id="search" type="text" placeholder="Search by course/name/title…" style="width:180px" />
                </div>
            </div>

            <div id="list" style="margin-top:12px"></div>
            <div id="empty" class="empty">No reviews yet. Be the first to add one! ✍️</div>
        </div>
    </div>
</div>
@endsection
