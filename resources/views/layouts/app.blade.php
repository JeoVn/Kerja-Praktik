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
<!-- Footer -->
<footer style=" color: white; text-align: center; padding: 20px 10px; margin-top: 50px;">
    <p style="font-size: 16px; margin: 0;">
        &copy; {{ date('Y') }} <strong>AA Apotek Anugrah</strong> – Solusi Sehat Keluarga Anda
    </p>
    <p style="margin-top: 10px;">
        <a href="https://wa.me/628999008007" target="_blank" style="color: #ffffff; text-decoration: none; font-size: 16px;">
            <i class="fab fa-whatsapp" style="margin-right: 8px;"></i>Hubungi Kami via WhatsApp
        </a>
    </p>
</footer>

    
    {{-- You can also add additional script files here --}}
    @yield('scripts')

    <!-- Font Awesome CDN (if not already included in head) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
