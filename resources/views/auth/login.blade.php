<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    
    <form action="{{ route('login') }}" method="POST">
        @csrf
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
</body>
</html> -->
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
                <img src="{{ asset('images/logo.png') }}" alt="Logo Apotek" class="logo">
                <h1>AA APOTEK ANUGRAH</h1>
                <p class="subtitle">SOLUSI SEHAT KELUARGA ANDA</p>
                <small class="powered">Powered by PT Kimara Indonesia</small>
            </div>
        </div>
        <div class="right-panel">
            <div class="login-box">
                <h2>Login</h2>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <label for="email">Username</label>
                    <input type="text" name="email" id="email" placeholder="Enter your username" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" placeholder="Enter your password" required>

                    <div class="forgot">
                        <a href="#">Forgot Password?</a>
                    </div>

                    <button type="submit">Login</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
