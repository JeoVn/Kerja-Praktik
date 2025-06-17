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
    
    @stack('scripts')

    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p>&copy; {{ date('Y') }} AA Apotek Anugrah. Solusi Sehat Keluarga Anda</p>
        <p> Hubungi Kami 0899-9008-00 </p>
    </footer>
    
    {{-- You can also add additional script files here --}}
    @yield('scripts')

    <!-- Font Awesome CDN (if not already included in head) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
