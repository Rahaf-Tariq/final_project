@extends('layouts.app')

@section('title', 'Profile - ShopHub')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body p-5">
                        <h1 class="card-title mb-4">My Profile</h1>

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <p class="form-control-plaintext">{{ auth()->user()->name }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <p class="form-control-plaintext">{{ auth()->user()->email }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <p class="form-control-plaintext">{{ auth()->user()->phone ?? 'Not set' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <p class="form-control-plaintext">{{ auth()->user()->address ?? 'Not set' }}</p>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Member Since</label>
                            <p class="form-control-plaintext">{{ auth()->user()->created_at->format('d M Y') }}</p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
