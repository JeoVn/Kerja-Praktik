<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing - AA Apotek Anugrah</title>
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">


    {{-- Redirect after 3 seconds --}}
    <script>
        setTimeout(function () {
            window.location.href = "{{ route('login') }}";
        }, 3000); // 3000 ms = 3 detik
    </script>
</head>
<body>
    <div class="container">
        
        <div class="logo">💊</div>
        <h1>AA APOTEK ANUGRAH</h1>
        <p class="subtitle">Solusi Sehat Keluarga Anda</p>
        
    </div>
</body>
</html>
