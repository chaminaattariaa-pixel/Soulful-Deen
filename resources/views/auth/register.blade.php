@extends('layouts')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #d0d2de, #3da372, #ece5f2);
        min-height: 100vh;
    }

    .register-card {
        background: rgba(14, 126, 81, 0.12);
        backdrop-filter: blur(12px);
        border-radius: 18px;
        padding: 35px;
        color: #fff;
        animation: fadeUp 1s ease;
        box-shadow: 0 20px 40px rgba(0,0,0,0.3);
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

    .register-card h3 {
        text-align: center;
        font-weight: 700;
        margin-bottom: 25px;
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
        box-shadow: none;
        color: #fff;
    }

    label {
        font-size: 14px;
        margin-bottom: 5px;
    }

    .btn-register {
        width: 100%;
        padding: 12px;
        border-radius: 30px;
        font-weight: 600;
        background: linear-gradient(45deg, #00c6ff, #00fff2);
        border: none;
        transition: 0.3s;
    }

    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0,114,255,0.6);
    }

    .extra-links {
        text-align: center;
        margin-top: 15px;
    }

    .extra-links a {
        color: #00c6ff;
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
            <div class="register-card">
                <h3>Create Account</h3>

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    <div class="mb-3">
                        <label>Full Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                    </div>

                    <div class="mb-3">
                        <label>Email Address</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                    </div>

                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Create password" required>
                    </div>

                    <div class="mb-3">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm password" required>
                    </div>

                    <button type="submit" class="btn btn-register mt-2">
                        Register
                    </button>

                    <div class="extra-links">
                        <p class="mt-3 mb-0">
                            Already have an account?
                            <a href="/login">Login</a>
                        </p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
