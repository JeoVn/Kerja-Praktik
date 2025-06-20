<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - AA Apotek Anugrah</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="left-panel">
            <div class="logo-box">
                <img src="/uploads/obat/logo.jpg" alt="Logo" width="200" height="200">
                                <h1>AA APOTEK ANUGRAH</h1>
                <p class="subtitle">SOLUSI SEHAT KELUARGA ANDA</p>
                
            </div>
        </div>
        <div class="right-panel">
            <div class="login-box">
    <h2>Login</h2>
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
 
    {{-- MENAMPILKAN PESAN ERROR ATAU SUKSES --}}
    @if ($errors->any())
        <div class="alert alert-danger" style="color: red; margin-bottom: 20px;">
            <ul style="list-style-type: none; padding: 0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success" style="color: green; margin-bottom: 20px;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label for="email">Username</label>
        <input type="text" name="email" id="email" placeholder="Enter your username" required>

        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required>

        <div class="forgot" style="margin-top: 10px;">
   
    <a href="{{ route('password.request') }}">Lupa Password?</a>
</div>


        <button type="submit">Login</button>
    </form>
</div>

        </div>
    </div>
</body>
</html>
