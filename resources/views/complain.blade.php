
@extends('layouts.app')

@section('title', 'Submit a Complaint')

@section('content')
<div class="container py-5">
	<div class="row justify-content-center">
		<div class="col-md-7">
			<div class="card shadow-lg border-0">
				<div class="card-body p-4">
					<h3 class="mb-3 text-primary"><i class="fa fa-exclamation-circle me-2"></i>Submit a Complaint</h3>
					<p class="text-muted mb-4">Have an issue or suggestion? Let us know and our team will get back to you as soon as possible.</p>
					<form method="POST" action="{{ route('complaints.store') }}">
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
						<div class="mb-3 form-check">
							<input type="checkbox" class="form-check-input" id="urgent" name="urgent">
							<label class="form-check-label text-danger" for="urgent">Mark as urgent</label>
						</div>
						<button type="submit" class="btn btn-primary w-100">Send Complaint <i class="fa fa-paper-plane ms-2"></i></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
