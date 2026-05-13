<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - LUXÉ CHRONO</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #D4AF37;
            --dark-color: #0d0d0d;
            --sidebar-bg: #1a1a1a;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f5f5f5;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            letter-spacing: 1px;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            background: linear-gradient(180deg, var(--sidebar-bg) 0%, #0d0d0d 100%);
            color: white;
            padding: 20px 0;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            border-right: 2px solid var(--primary-color);
        }

        .sidebar .logo {
            padding: 20px;
            text-align: center;
            font-size: 1.4rem;
            font-weight: 900;
            color: var(--primary-color);
            border-bottom: 2px solid rgba(212, 175, 55, 0.3);
            margin-bottom: 20px;
            font-family: 'Playfair Display', serif;
            letter-spacing: 2px;
        }

        .sidebar .nav-menu {
            list-style: none;
            padding: 0;
        }

        .sidebar .nav-menu li {
            margin: 0;
        }

        .sidebar .nav-menu a {
            display: block;
            padding: 15px 25px;
            color: rgba(224, 224, 224, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
            text-transform: uppercase;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-menu a:hover,
        .sidebar .nav-menu a.active {
            background-color: rgba(212, 175, 55, 0.15);
            color: var(--primary-color);
            border-left-color: var(--primary-color);
            padding-left: 30px;
        }

        /* Main Content Area */
        .main-content {
            margin-left: 250px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .top-header {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid var(--primary-color);
        }

        .top-header .admin-name {
            font-weight: 600;
            color: var(--dark-color);
        }

        .content {
            flex: 1;
            padding: 30px;
            background-color: #f5f5f5;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            text-align: center;
            margin-bottom: 20px;
            border-left: 4px solid var(--primary-color);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(212, 175, 55, 0.15);
        }

        .stat-card .value {
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--primary-color);
            font-family: 'Playfair Display', serif;
        }

        .stat-card .label {
            color: #666;
            font-size: 0.9rem;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
                border-right: none;
                border-bottom: 2px solid var(--primary-color);
            }

            .main-content {
                margin-left: 0;
            }

            .admin-container {
                flex-direction: column;
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <i class="fas fa-hourglass-end"></i> LUXÉ CHRONO
            </div>
            <ul class="nav-menu">
                <li><a href="{{ route('admin.dashboard') }}" class="@if(request()->routeIs('admin.dashboard')) active @endif">
                    <i class="fas fa-chart-line me-2"></i>Dashboard
                </a></li>
                <li><a href="{{ route('admin.products.index') }}" class="@if(request()->routeIs('admin.products.*')) active @endif">
                    <i class="fas fa-box me-2"></i>Products
                </a></li>
                <li><a href="{{ route('admin.orders.index') }}" class="@if(request()->routeIs('admin.orders.*')) active @endif">
                    <i class="fas fa-shopping-cart me-2"></i>Orders
                </a></li>
                <li><a href="{{ route('admin.order-items.index') }}" class="@if(request()->routeIs('admin.order-items.*')) active @endif">
                    <i class="fas fa-list me-2"></i>Order Items
                </a></li>
                <li><a href="{{ route('admin.users.index') }}" class="@if(request()->routeIs('admin.users.*')) active @endif">
                    <i class="fas fa-users me-2"></i>Users
                </a></li>
                <li><a href="{{ route('admin.admins.index') }}" class="@if(request()->routeIs('admin.admins.*')) active @endif">
                    <i class="fas fa-user-shield me-2"></i>Admins
                </a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Header -->
            <div class="top-header">
                <div></div>
                <div class="admin-name">
                    {{ auth('admin')->user()->name }}
                    <a href="javascript:void(0);" onclick="document.getElementById('logout-form').submit();" class="btn btn-sm btn-outline-danger ms-3">
                        <i class="fas fa-sign-out-alt me-1"></i>Logout
                    </a>
                    <form id="logout-form" method="POST" action="{{ route('admin.logout') }}" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

            <!-- Content -->
            <div class="content">
                <!-- Flash Messages -->
                @if ($message = session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if ($message = session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.5.1/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.5.1/vfs_fonts.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    @yield('scripts')
</body>
</html>
