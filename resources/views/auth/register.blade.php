@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="auth-card">
    <div class="auth-header text-center py-4">
        <h3><i class="fas fa-user-plus me-2"></i>Create Account</h3>
        <p class="mb-0">Join our learning community</p>
    </div>
    
    <div class="p-4">
        <form method="POST" action="{{ route('register') }}">
            @csrf
            
            
            
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                       id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="password_confirmation" 
                       name="password_confirmation" required>
            </div>
            
            <div class="mb-3">
                <label for="role" class="form-label">I am a</label>
                <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
                    <option value="">Select Role</option>
                    <option value="student" {{ old('role') == 'student' ? 'selected' : '' }}>Student</option>
                    <option value="teacher" {{ old('role') == 'teacher' ? 'selected' : '' }}>Teacher</option>
                </select>
                @error('role')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary w-100 mb-3">
                <i class="fas fa-user-plus me-2"></i>Create Account
            </button>
        </form>
        
        <div class="text-center">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
        </div>
    </div>
</div>
@endsection