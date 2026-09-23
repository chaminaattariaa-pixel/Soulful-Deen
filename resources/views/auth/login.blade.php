@extends('layouts')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #d0d2de, #3da372, #ece5f2);
        min-height: 100vh;
    }

    .login-card {
        background: rgba(198, 75, 198, 0.12);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 35px;
        color: #fff;
        animation: fadeUp 0.9s ease;
        box-shadow: 0 20px 40px rgba(0,0,0,0.35);
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-card h3 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 25px;
    }

    label {
        font-size: 14px;
        margin-bottom: 6px;
    }

    .form-control {
        background: rgba(255,255,255,0.15);
        border: none;
        color: #fff;
        padding: 12px;
        border-radius: 10px;
    }

    .form-control::placeholder {
        color: rgba(255,255,255,0.7);
    }

    .form-control:focus {
        background: rgba(255,255,255,0.2);
        color: #fff;
        box-shadow: none;
    }

    .form-check-input {
        background-color: transparent;
        border: 1px solid rgba(255,255,255,0.6);
    }

    .form-check-label {
        font-size: 14px;
    }

    .btn-login {
        width: 100%;
        padding: 12px;
        border-radius: 30px;
        font-weight: 600;
        background: linear-gradient(45deg, #43cea2, #185a9d);
        border: none;
        transition: 0.3s;
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(67,206,162,0.6);
    }

    .extra-links {
        text-align: center;
        margin-top: 15px;
    }

    .extra-links a {
        color: #43cea2;
        text-decoration: none;
        font-size: 14px;
    }

    .extra-links a:hover {
        text-decoration: underline;
    }
</style>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height:100vh;">
        <div class="col-md-5">
            <div class="login-card">
                <h3>Welcome Back</h3>

                <form method="POST" action="{{ route('login.post') }}">
                    @csrf

                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>

                    <div class="mb-3 d-flex justify-content-between align-items-center">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-info" style="font-size:14px;text-decoration:none;">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn btn-login mt-2">
                        Login
                    </button>

                    <div class="extra-links">
                        <p class="mt-3 mb-0">
                            Don’t have an account?
                            <a href="/register">Create one</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
