@extends('layouts.app')

@section('title', 'Course Payment')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Complete Your Enrollment</h4>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Course Summary -->
                    <div class="row mb-4">
                        <div class="col-md-3">
                            <img src="{{ $course->thumbnail_url }}" alt="{{ $course->title }}" 
                                 class="img-fluid rounded">
                        </div>
                        <div class="col-md-9">
                            <h5>{{ $course->title }}</h5>
                            <p class="text-muted">{{ $course->description }}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Teacher:</strong> {{ $course->teacher->name }}<br>
                                    <strong>Level:</strong> {{ ucfirst($course->level) }}<br>
                                    <strong>Duration:</strong> {{ $course->duration ?? 'N/A' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Category:</strong> {{ $course->category->name }}<br>
                                    <strong>Total Videos:</strong> {{ $course->total_videos }}<br>
                                    <strong>Total Students:</strong> {{ $course->total_students }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <!-- Payment Form -->
                    <form action="{{ route('student.courses.process-payment', $course) }}" method="POST" id="payment-form">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-8">
                                <h5 class="mb-3">Payment Information</h5>
                                
                                <div class="form-group mb-3">
                                    <label for="cardholder_name" class="form-label">Cardholder Name *</label>
                                    <input type="text" class="form-control @error('cardholder_name') is-invalid @enderror" 
                                           id="cardholder_name" name="cardholder_name" 
                                           value="{{ old('cardholder_name') }}" required>
                                    @error('cardholder_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label for="card_number" class="form-label">Card Number *</label>
                                    <input type="text" class="form-control @error('card_number') is-invalid @enderror" 
                                           id="card_number" name="card_number" 
                                           value="{{ old('card_number') }}" 
                                           placeholder="1234 5678 9012 3456" maxlength="16" required>
                                    @error('card_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="expiry_month" class="form-label">Expiry Month *</label>
                                            <select class="form-select @error('expiry_month') is-invalid @enderror" 
                                                    id="expiry_month" name="expiry_month" required>
                                                <option value="">Month</option>
                                                @for($i = 1; $i <= 12; $i++)
                                                    <option value="{{ $i }}" {{ old('expiry_month') == $i ? 'selected' : '' }}>
                                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('expiry_month')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="expiry_year" class="form-label">Expiry Year *</label>
                                            <select class="form-select @error('expiry_year') is-invalid @enderror" 
                                                    id="expiry_year" name="expiry_year" required>
                                                <option value="">Year</option>
                                                @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                                    <option value="{{ $i }}" {{ old('expiry_year') == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                            @error('expiry_year')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label for="cvv" class="form-label">CVV *</label>
                                            <input type="text" class="form-control @error('cvv') is-invalid @enderror" 
                                                   id="cvv" name="cvv" value="{{ old('cvv') }}" 
                                                   placeholder="123" maxlength="3" required>
                                            @error('cvv')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Test Card Information -->
                                <div class="alert alert-info">
                                    <h6>Test Cards (Dummy Payment Gateway):</h6>
                                    <ul class="mb-0">
                                        <li><strong>Success:</strong> Any card number except 0000000000000000 or 1111111111111111</li>
                                        <li><strong>Declined:</strong> 0000000000000000 or 1111111111111111</li>
                                        <li><strong>CVV:</strong> Any 3 digits</li>
                                        <li><strong>Expiry:</strong> Any future date</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Payment Summary -->
                            <div class="col-md-4">
                                <div class="card bg-light">
                                    <div class="card-header">
                                        <h6 class="mb-0">Payment Summary</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Course Price:</span>
                                            <span>${{ number_format($course->price, 2) }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Tax:</span>
                                            <span>$0.00</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Processing Fee:</span>
                                            <span>$0.00</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total:</span>
                                            <span>${{ number_format($course->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <button type="submit" class="btn btn-success btn-lg w-100" id="pay-button">
                                        <i class="fas fa-lock me-2"></i>Pay ${{ number_format($course->price, 2) }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('payment-form').addEventListener('submit', function(e) {
    const payButton = document.getElementById('pay-button');
    payButton.disabled = true;
    payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
});

// Format card number with spaces
document.getElementById('card_number').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\s+/g, '').replace(/[^0-9]/gi, '');
    let formattedValue = value.replace(/(\d{4})/g, '$1 ').trim();
    e.target.value = formattedValue;
});

// Format CVV to only allow numbers
document.getElementById('cvv').addEventListener('input', function(e) {
    e.target.value = e.target.value.replace(/[^0-9]/g, '');
});
</script>
@endsection
