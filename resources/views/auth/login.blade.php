
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | MONOTECH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div id="siteHeader"></div>

    <main class="account-page">
        <div class="container">

            <div class="account-card">

                <div class="eyebrow mb-2">Welcome back</div>

                <h1>Login to your account</h1>

                <p class="text-secondary mb-4">
                    Sign in to keep track of your MONOTECH shopping.
                </p>

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    {{-- Email Address --}}
                    <div class="mb-3">

                        <label class="form-label" for="email">
                            Email address
                        </label>

                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                            name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                            placeholder="you@example.com">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>

                    {{-- Password --}}
                    <div class="mb-3">

                        <label class="form-label" for="password">
                            Password
                        </label>

                        <input id="password" class="form-control @error('password') is-invalid @enderror"
                            type="password" name="password" required autocomplete="current-password"
                            placeholder="Enter password">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>

                    {{-- Remember Me --}}
                    <div class="mb-3">

                        <label for="remember_me" class="form-check-label">

                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">

                            Remember me

                        </label>

                    </div>

                    {{-- Forgot Password & Login --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-4">

                        @if (Route::has('password.request'))

                            <a class="text-decoration-none small text-secondary" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>

                        @endif

                        <button class="btn-mono" type="submit">
                            Log in
                        </button>

                    </div>

                    {{-- Google Login --}}
                    <div class="text-center my-4">

                        <div class="d-flex align-items-center gap-3 mb-3">

                            <hr class="flex-grow-1">

                            <span class="text-secondary small">OR</span>

                            <hr class="flex-grow-1">

                        </div>

                      <div class="mt-4">
    <a href="{{ route('google.login') }}"
        class="btn btn-light border w-100 d-flex align-items-center justify-content-center gap-3 py-2 text-dark">

        <svg width="20" height="20" viewBox="0 0 48 48">
            <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 3.15 13.22l7.98 6.19C13.07 13.72 18.06 9.5 24 9.5z"/>
            <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.72 7.18l7.24 5.62c4.23-3.91 6.67-9.68 6.67-17.27z"/>
            <path fill="#FBBC05" d="M10.53 28.59a14.4 14.4 0 0 1 0-9.18l-7.98-6.19a24 24 0 0 0 0 21.56z"/>
            <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.91-5.81l-7.24-5.62c-2.01 1.35-4.58 2.15-8.67 2.15-5.94 0-10.93-4.22-12.87-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
        </svg>

        <span class="fw-semibold">Continue with Google</span>
    </a>
</div>

                    </div>

                    {{-- Register --}}
                    <p class="account-switch text-center mt-4 mb-0">

                        Don't have an account?

                        <a href="{{ route('register') }}">
                            Register
                        </a>

                    </p>

                </form>

            </div>

        </div>
    </main>

    <div id="siteFooter"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/shared.js') }}"></script>

</body>

</html>
```