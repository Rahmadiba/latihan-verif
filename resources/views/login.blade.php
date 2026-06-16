<!DOCTYPE html>
<html>
<head><title>Login</title>
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container">
    <h2>Laman Login E-Konseling</h2>
    
    @if($errors->has('login_error'))
        <p style="color:red">{{ $errors->first('login_error') }}</p>
    @endif

    <form action="{{ route('login.proses') }}" method="POST">
        @csrf <div>
            <label>Email:</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Password:</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Login</button>
    </form>
    </div>
</body>
</html>