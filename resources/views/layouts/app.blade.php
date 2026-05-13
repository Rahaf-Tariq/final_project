<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
 
        <title>@yield('title', 'LUXÉ CHRONO - Luxury Watches')</title>
 
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
        <style>
            :root {
                --primary-color: #D4AF37;
                --dark-color: #0d0d0d;
                --light-color: #f5f5f5;
            }
            * {
                font-family: 'Poppins', sans-serif;
            }
            body {
                background-color: var(--light-color);
                color: var(--dark-color);
            }
            h1, h2, h3, h4, h5, h6 {
                font-family: 'Playfair Display', serif;
                font-weight: 900;
                letter-spacing: 2px;
            }
            .navbar {
                background: var(--dark-color) !important;
                box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15);
                border-bottom: 2px solid var(--primary-color);
                padding: 15px 0;
                /* ✅ FIX: Navbar upar rahega har cheez se */
                z-index: 1050 !important;
                position: sticky;
                top: 0;
            }
            .navbar-brand {
                font-weight: 900;
                color: var(--primary-color) !important;
                font-size: 1.8rem;
                font-family: 'Playfair Display', serif;
                letter-spacing: 1px;
            }
            .nav-link {
                color: #e0e0e0 !important;
                margin: 0 15px;
                transition: all 0.3s;
                text-transform: uppercase;
                font-size: 0.85rem;
                font-weight: 600;
                letter-spacing: 1px;
            }
            .nav-link:hover {
                color: var(--primary-color) !important;
                transform: translateY(-2px);
            }
            .btn-primary {
                background-color: var(--primary-color);
                border-color: var(--primary-color);
                color: var(--dark-color);
                font-weight: 700;
                letter-spacing: 1px;
                text-transform: uppercase;
                font-size: 0.85rem;
                transition: all 0.3s;
            }
            .btn-primary:hover {
                background-color: #e6c451;
                border-color: #e6c451;
                box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
            }
            .cart-badge {
                position: absolute;
                top: -8px;
                right: -8px;
                background-color: var(--primary-color);
                color: var(--dark-color);
                border-radius: 50%;
                width: 20px;
                height: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 0.75rem;
                font-weight: 700;
            }
            .product-card {
                transition: all 0.4s ease;
                border: 1px solid #e0e0e0;
                background: white;
                position: relative;
                overflow: hidden;
            }
            .product-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(212, 175, 55, 0.15), transparent);
                transition: left 0.5s;
                z-index: 1;
            }
            .product-card:hover::before {
                left: 100%;
            }
            .product-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 15px 40px rgba(13, 13, 13, 0.15);
                border-color: var(--primary-color);
            }
            .product-image {
                height: 300px;
                object-fit: cover;
                background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
            }
            footer {
                background: var(--dark-color);
                color: #e0e0e0;
                border-top: 2px solid var(--primary-color);
                margin-top: 80px;
                padding: 60px 0 20px;
            }
            footer h5 {
                color: var(--primary-color);
                margin-bottom: 20px;
            }
            footer a {
                color: #e0e0e0;
                text-decoration: none;
                transition: color 0.3s;
            }
            footer a:hover {
                color: var(--primary-color);
            }
            .hero-section {
                background: linear-gradient(135deg, var(--dark-color) 0%, #1a1a1a 100%);
                color: white;
                padding: 100px 0;
                position: relative;
                overflow: hidden;
            }
            .hero-section::before {
                content: '';
                position: absolute;
                top: -50%;
                right: -10%;
                width: 500px;
                height: 500px;
                background: radial-gradient(circle, rgba(212, 175, 55, 0.1) 0%, transparent 70%);
                border-radius: 50%;
            }
            .hero-content {
                position: relative;
                z-index: 2;
            }
            .featured-section {
                padding: 80px 0;
            }
            .featured-section h2 {
                text-align: center;
                margin-bottom: 50px;
                color: var(--dark-color);
                position: relative;
                padding-bottom: 20px;
            }
            .featured-section h2::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%);
                width: 80px;
                height: 3px;
                background: var(--primary-color);
            }
            .price-original {
                text-decoration: line-through;
                color: #999;
                font-size: 0.9rem;
            }
            .price-current {
                color: var(--primary-color);
                font-size: 1.3rem;
                font-weight: 700;
            }
 
            /* ✅ FIX: Checkout page ka sticky sidebar navbar ke neeche rahega */
            .sticky-top.order-summary,
            .position-sticky,
            [style*="position: sticky"],
            [style*="position:sticky"] {
                z-index: 100 !important;
            }
        </style>
        @yield('styles')
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">
                    <i class="fas fa-hourglass-end"></i> LUXÉ CHRONO
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('products.index') }}">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link position-relative" href="{{ route('cart.index') }}">
                                <i class="fas fa-shopping-cart"></i> Cart
                                @php
                                    $cartCount = count(session()->get('cart', []));
                                @endphp
                                @if($cartCount > 0)
                                    <span class="cart-badge" id="cart-badge">{{ $cartCount }}</span>
                                @endif
                            </a>
                        </li>
                        @auth
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                                    {{ auth()->user()->name }}
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    {{-- ✅ FIX: profile.edit route nahi thi, is liye # kar diya --}}
                                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="dropdown-item">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Register</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
 
        <!-- Flash Messages -->
        @if ($message = session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if ($message = session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 10px;">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
 
        <!-- Main Content -->
        @yield('content')
 
        <!-- Footer -->
        <footer class="mt-5 py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h5>About Us</h5>
                        <p>Your one-stop shop for quality products at the best prices.</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Quick Links</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                            <li><a href="{{ route('products.index') }}" class="text-decoration-none">Products</a></li>
                            <li><a href="{{ route('contact.index') }}" class="text-decoration-none">Contact</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h5>Follow Us</h5>
                        <a href="#" class="me-3"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <hr>
                <div class="text-center">
                    <p>&copy; 2026 LUXÉ CHRONO. All rights reserved. Luxury Timepieces Crafted with Precision.</p>
                </div>
            </div>
        </footer>
 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            function updateCartBadge() {
                fetch('{{ route("cart.badge") }}')
                    .then(response => response.json())
                    .then(data => {
                        const badge = document.getElementById('cart-badge');
                        if (data.count > 0) {
                            if (!badge) {
                                const newBadge = document.createElement('span');
                                newBadge.id = 'cart-badge';
                                newBadge.className = 'cart-badge';
                                newBadge.textContent = data.count;
                                document.querySelector('[href="{{ route("cart.index") }}"]').appendChild(newBadge);
                            } else {
                                badge.textContent = data.count;
                            }
                        } else if (badge) {
                            badge.remove();
                        }
                    });
            }
        </script>

        @yield('scripts')
    </body>
</html>
 