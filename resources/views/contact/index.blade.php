@extends('layouts.app')

@section('title', 'Contact LUXÉ CHRONO - Luxury Watches')

@section('content')
    <div class="container py-5">
        <h1 class="mb-5 text-center" style="font-family: 'Playfair Display', serif; font-size: 2.5rem;">Connect With Our Concierge</h1>

        <div class="row">
            <!-- Contact Information -->
            <div class="col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Luxury Customer Support</h5>

                        <div class="mb-4">
                            <h6 style="color: var(--primary-color);" class="mb-2">
                                <i class="fas fa-map-marker-alt me-2"></i>Showroom
                            </h6>
                            <p class="text-muted">
                                Luxury Plaza, Level 5<br>
                                Downtown, Karachi<br>
                                Pakistan
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 style="color: var(--primary-color);" class="mb-2">
                                <i class="fas fa-phone me-2"></i>Phone
                            </h6>
                            <p class="text-muted">
                                <a href="tel:+923001234567" class="text-decoration-none" style="color: var(--primary-color);">+92-300-123-4567</a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 style="color: var(--primary-color);" class="mb-2">
                                <i class="fas fa-envelope me-2"></i>Email
                            </h6>
                            <p class="text-muted">
                                <a href="mailto:concierge@luxechrono.com" class="text-decoration-none" style="color: var(--primary-color);">concierge@luxechrono.com</a>
                            </p>
                        </div>

                        <div class="mb-4">
                            <h6 style="color: var(--primary-color);" class="mb-2">
                                <i class="fas fa-clock me-2"></i>Business Hours
                            </h6>
                            <p class="text-muted">
                                Monday - Saturday: 10:00 AM - 8:00 PM<br>
                                Saturday: 10:00 AM - 4:00 PM<br>
                                Sunday: Closed
                            </p>
                        </div>

                        <!-- Google Maps Embed -->
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.1567145914607!2d-74.00601592346894!3d40.71278371110073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a27e5f00001%3A0x91b6b4bddc15fcd5!2s123%20Main%20St%2C%20New%20York%2C%20NY%2010001!5e0!3m2!1sen!2sus!4v1234567890" 
                                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4">Share Your Inquiry</h5>

                        <form method="POST" action="{{ route('contact.store') }}" novalidate>
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name *</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Your Email *</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject *</label>
                                <input type="text" class="form-control @error('subject') is-invalid @enderror" 
                                       id="subject" name="subject" value="{{ old('subject') }}" required>
                                @error('subject')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-lg w-100" style="background-color: var(--primary-color); color: var(--dark-color); font-weight: 700;">
                                <i class="fas fa-paper-plane me-2"></i>Send Inquiry
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
