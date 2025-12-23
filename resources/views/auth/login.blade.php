<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Utama - MPP Sukoharjo</title>
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f6f8fb;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-wrapper {
            display: flex;
            width: 900px;
            height: 500px;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 16px rgba(0,0,0,0.2);
        }

        .login-image {
            flex: 1;
            /* Menggunakan asset() untuk memanggil gambar dari folder public */
            background: url("{{ asset('images/gedung-mpp.jpeg') }}") no-repeat center center; 
            background-size: cover;
        }

        .login-form {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        h2 { text-align: center; margin-bottom: 5px; color: #222; }
        h3 { text-align: center; color: #0066cc; margin-top: 0; margin-bottom: 20px; font-weight: 500; }

        .google-btn {
            background-color: #f4f4f4;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            font-size: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            text-decoration: none;
            color: #333;
            transition: 0.3s;
        }

        .google-btn:hover { background-color: #eee; }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 20px 0 10px 0;
            color: #aaa;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #ddd;
            margin: 0 10px;
        }

        .input-group { margin-bottom: 15px; }

        input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px; 
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .login-btn {
            width: 100%;
            background-color: #0066cc;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.3s;
        }

        .login-btn:hover { background-color: #004d99; }

        .error-box {
            background-color: #fee2e2;
            color: #dc2626;
            padding: 10px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-image"></div>

    <div class="login-form">
        <h2>Log in</h2>
        <h3>Admin Utama</h3>

        <a href="#" class="google-btn">
            <img src="https://www.svgrepo.com/show/355037/google.svg" alt="Google" width="20">
            Log in With Google
        </a>

        <div class="divider">OR LOG IN WITH EMAIL</div>

        @if($errors->any())
            <div class="error-box">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf {{-- Wajib ada di Laravel untuk keamanan --}}
            
            <div class="input-group">
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
            </div>

            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <label style="font-size: 13px;">
                    <input type="checkbox" name="remember"> Keep me logged in
                </label>
                <a href="#" style="font-size: 13px; color: #e41e26; text-decoration: none;">Forgot Password?</a>
            </div>

            <button type="submit" class="login-btn">
                Log In <span style="font-size: 18px;">→</span>
            </button>
        </form>
    </div>
</div>

</body>
</html>