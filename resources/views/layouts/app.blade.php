<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>
       
    @stack('styles')

    <!-- Anda dapat menambahkan link CSS atau meta tag lainnya di sini -->
</head>

<body>

    <!-- Header -->
    <header>
        <nav>
            <!-- Menu navigasi bisa ditambahkan di sini -->
        </nav>
    </header>
@stack('scripts')
@yield('scripts')

    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>Footer Content</p>
    </footer>
    
    {{-- ... mungkin sebelum script JS --}}
    @yield('scripts')

</body>
</html>

