<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Create Account | TaskFlow</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/tasks.css') }}">
</head>

<body class="auth-page">

    <div class="auth-container">

        <div class="auth-logo">

            <div class="auth-logo-icon">
                <i class="fa-solid fa-check-double"></i>
            </div>

            <div>
                <h1>TaskFlow</h1>
                <span>Task Manager</span>
            </div>

        </div>


        <div class="auth-card">

            <div class="auth-header">

                <h2>Create your account</h2>

                <p>
                    Get started with your personal task manager.
                </p>

            </div>


            @if ($errors->any())

                <div class="auth-error">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <div>

                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach

                    </div>

                </div>

            @endif


            <form action="{{ route('register.store') }}" method="POST">

                @csrf


                <div class="auth-field">

                    <label for="name">
                        Full Name
                    </label>

                    <div class="auth-input-wrapper">

                        <i class="fa-regular fa-user"></i>

                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Your name" required autofocus>

                    </div>

                </div>


                <div class="auth-field">

                    <label for="email">
                        Email Address
                    </label>

                    <div class="auth-input-wrapper">

                        <i class="fa-regular fa-envelope"></i>

                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="you@example.com" required>

                    </div>

                </div>


                <div class="auth-field">

                    <label for="password">
                        Password
                    </label>

                    <div class="auth-input-wrapper">

                        <i class="fa-solid fa-lock"></i>

                        <input type="password" id="password" name="password" placeholder="Minimum 8 characters"
                            required>

                    </div>

                </div>


                <div class="auth-field">

                    <label for="password_confirmation">
                        Confirm Password
                    </label>

                    <div class="auth-input-wrapper">

                        <i class="fa-solid fa-shield-halved"></i>

                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Repeat your password" required>

                    </div>

                </div>


                <button type="submit" class="auth-submit">

                    <i class="fa-solid fa-user-plus"></i>

                    Create Account

                </button>

            </form>


            <div class="auth-footer">

                Already have an account?

                <a href="{{ route('login') }}">
                    Login
                </a>

            </div>

        </div>


        <div class="auth-credit">
            TaskFlow • Built with Laravel
        </div>

    </div>

</body>

</html>
