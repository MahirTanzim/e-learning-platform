
@extends('layouts.app')

@section('title', 'Submit a Complaint')

@section('content')

<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card shadow-lg border-0 mb-4">
				<div class="card-body p-4">
					<h3 class="mb-3 text-primary"><i class="fa fa-exclamation-circle me-2"></i>Submit a Complaint</h3>
					<p class="text-muted mb-4">Have an issue or suggestion? Let us know and our team will get back to you as soon as possible.</p>
					<form method="POST" action="{{ route('complaints.store') }}" enctype="multipart/form-data">
						@csrf
						<div class="mb-3">
							<label for="subject" class="form-label">Subject</label>
							<input type="text" class="form-control" id="subject" name="subject" placeholder="Short summary (e.g., Course issue, Payment, etc.)" required>
						</div>
						<div class="mb-3">
							<label for="message" class="form-label">Message</label>
							<textarea class="form-control" id="message" name="message" rows="5" placeholder="Describe your complaint or suggestion in detail..." required></textarea>
						</div>
						<div class="mb-3">
							<label for="email" class="form-label">Your Email (optional)</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="you@email.com">
						</div>
						<div class="mb-3">
							<label for="attachment" class="form-label">Attachment (optional)</label>
							<input type="file" class="form-control" id="attachment" name="attachment" accept="image/*,.pdf,.doc,.docx">
						</div>
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="urgent" name="urgent">
							<label class="form-check-label text-danger" for="urgent">Mark as urgent</label>
						</div>
						<button type="submit" class="btn btn-primary w-100">Send Complaint <i class="fa fa-paper-plane ms-2"></i></button>
					</form>
				</div>
			</div>

			<!-- Previous Complaints Table -->
			<div class="card shadow-sm border-0">
				<div class="card-body p-4">
					<h5 class="mb-3"><i class="fa fa-list me-2"></i>Your Previous Complaints</h5>
					<div class="table-responsive">
						<table class="table table-hover align-middle">
							<thead>
								<tr>
									<th>#</th>
									<th>Subject</th>
									<th>Status</th>
									<th>Date</th>
									<th>Attachment</th>
									<th>Admin Response</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>1</td>
									<td>Course Issue</td>
									<td><span class="badge bg-warning text-dark">Pending</span></td>
									<td>2025-08-18</td>
									<td><a href="#" class="btn btn-sm btn-outline-secondary">View</a></td>
									<td><span class="text-muted">--</span></td>
								</tr>
								<tr>
									<td>2</td>
									<td>Payment Problem</td>
									<td><span class="badge bg-success">Resolved</span></td>
									<td>2025-08-15</td>
									<td><a href="#" class="btn btn-sm btn-outline-secondary">View</a></td>
									<td>Refund processed. Thank you!</td>
								</tr>
								<tr>
									<td>3</td>
									<td>Content Error</td>
									<td><span class="badge bg-warning text-dark">Pending</span></td>
									<td>2025-08-10</td>
									<td><a href="#" class="btn btn-sm btn-outline-secondary">View</a></td>
									<td><span class="text-muted">--</span></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
