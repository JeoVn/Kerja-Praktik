<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Default Title')</title>

    <!-- Tambahkan CSS Flex Layout -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1; /* Isi ruang yang tersisa antara header dan footer */
        }

        footer {
            color: hsla(222, 62.20%, 92.70%, 0.99);
            text-align: center;
            padding: 20px 10px;
            background-color: #3F5FAF;
        }
    </style>

    @stack('styles')
</head>

<body>
    <!-- Konten Utama -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer>
        <p style="font-size: 16px; margin: 0;">
            &copy; {{ date('Y') }} <strong>AA Apotek Anugrah</strong> – Solusi Sehat Keluarga Anda
        </p>
        <p style="margin-top: 10px;">
            <a href="https://wa.me/628999008007" target="_blank" style="color: hsla(222, 62.20%, 92.70%, 0.99); text-decoration: none; font-size: 16px;">
                <i class="fab fa-whatsapp" style="margin-right: 8px;"></i>Hubungi Kami via WhatsApp
            </a>
        </p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    @stack('scripts')
    @yield('scripts')
</body>
</html>
