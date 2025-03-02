@extends('layouts.app')

@section('title', 'OTP Verification')

@section('content')
<h1 class="mb-0">OTP Verification</h1>
<hr/>
<div class="container">
    @if(session()->has('error'))
    <div class="alert alert-danger" role="alert">
        {{ session()->get('error') }}
    </div>
    @endif
    <form action="{{ route('otp.verify') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="otp" class="form-label">OTP</label>
            <input type="text" name="otp" class="form-control" id="otp" placeholder="Enter OTP" required>
            @error('otp')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid">
            <button type="submit" class="btn btn-primary">Verify OTP</button>
        </div>
    </form>
</div>
@endsection