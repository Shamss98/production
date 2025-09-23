
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'متجرنا')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    @include('layoutes.navbar')
    <header>
        
    </header>
    <main>
        @yield('content')
    </main>
    <footer style="background: #f3f4f6; border-top: 1px solid #e5e7eb; padding: 2rem 0; margin-top: 2rem;">
        <div style="max-width: 1200px; margin: 0 auto; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.5rem; padding: 0 1rem;">
            <div>
                <a href="{{ url('/') }}" style="font-weight: bold; font-size: 1.2rem; color: #111827; text-decoration: none;">Shop</a>
                <p style="margin: 0.5rem 0 0 0; color: #6b7280;">&copy; {{ date('Y') }} My Application. All rights reserved.</p>
            </div>
            <nav>
                <ul style="display: flex; gap: 1.5rem; list-style: none; margin: 0; padding: 0;">
                    <li><a href="{{ url('/') }}" style="color: #374151; text-decoration: none;">Home</a></li>
                    <li><a href="{{ url('/shop') }}" style="color: #374151; text-decoration: none;">Shop</a></li>
                    <li><a href="{{ url('/deals') }}" style="color: #374151; text-decoration: none;">Deals</a></li>
                    <li><a href="{{ url('/contact') }}" style="color: #374151; text-decoration: none;">Contact</a></li>
                </ul>
            </nav>
            <div style="color: #6b7280; font-size: 0.95rem;">
                Follow us:
                <a href="#" style="margin-left: 0.5rem; color: #374151; text-decoration: none;">Twitter</a> |
                <a href="#" style="margin-left: 0.5rem; color: #374151; text-decoration: none;">Facebook</a> |
                <a href="#" style="margin-left: 0.5rem; color: #374151; text-decoration: none;">Instagram</a>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>