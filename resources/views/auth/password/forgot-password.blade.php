<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Forgot Password</title>
    <link rel="shortcut icon" href="{{ Vite::asset('resources/images/Logo/mainLogo-light.png') }}" type="image/png">
    <link rel="icon" href="{{ Vite::asset('resources/images/Logo/mainLogo-light.png') }}" type="image/png">

    @vite('resources/sass/app.scss')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        /* Global Styles */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f6f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #333;
        }

        /* Card Container */
        .d-grid {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            max-width: 400px;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        .formContent {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Form Header */
        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-header i {
            font-size: 50px;
            color: #4e73df;
        }

        .form-header h4 {
            font-size: 24px;
            font-weight: 600;
            color: #333;
        }

        .form-header p {
            font-size: 14px;
            color: #888;
        }

        /* Input Group */
        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            position: relative;
        }

        .input-group img {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            opacity: 0.6;
        }

        .input-group input {
            width: 100%;
            padding: 12px 20px 12px 40px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .input-group input:focus {
            outline: none;
            border-color: #4e73df;
        }

        /* Error Message */
        .text-danger {
            font-size: 12px;
            color: #e74a3b;
            margin-top: 5px;
        }

        /* Button */
        .btn {
            width: 100%;
            padding: 15px;
            background-color: #4e73df;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .btn:hover {
            background-color: #365d93;
            transform: translateY(-2px);
        }

        .btn:active {
            background-color: #2c467a;
            transform: translateY(0);
        }

        /* Link to login */
        .link-to-login {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .link-to-login a {
            color: #4e73df;
            text-decoration: none;
        }

        .link-to-login a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            .d-grid {
                width: 90%;
                padding: 20px;
            }

            .form-header h4 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <form action="{{ route('forgot.password.post') }}" method="POST">
        @csrf
        <div class="d-grid">

            <!-- Form Header -->
            <div class="form-header">
                <i class="bi-person-circle fs-1"></i>
                <h4 class="fw-bold">Forgot your password?</h4>
                <p>Please enter your email address below, and we’ll send you a link to reset your password.</p>
            </div>

            <div class="formContent">

                <!-- Email Input -->
                <div class="col-md-6 mb-3 w-100">
                    <div class="input-group">
                        <img src="{{ Vite::asset('resources/images/email_outline.png') }}" alt="email icon">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" value="{{ old('email') }}" placeholder="Enter your email">
                    </div>
                    @error('email')
                    <div class="text-danger"><small>{{ $message }}</small></div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="col-md-6 d-grid m-auto w-100">
                    <button type="submit" class="btn"><i class="bi-check-circle me-2"></i>Send Reset Link</button>
                </div>

                <!-- Link to Login -->
                <div class="link-to-login">
                    <p>Remembered your password? <a href="{{ route('login') }}">Back to Login</a></p>
                </div>

            </div>

        </div>
    </form>
</body>

</html>
