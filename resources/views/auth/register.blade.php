
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Register | MONOTECH</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>

    <div id="siteHeader"></div>

    <main class="account-page">

        <div class="container">

            <div class="account-card">

                <div class="eyebrow mb-2">Join MONOTECH</div>

                <h1>Create an account</h1>

                <p class="text-secondary mb-4">
                    Register to make your shopping experience easier.
                </p>

                <form method="POST" action="{{ route('register') }}">

                    @csrf

                    {{-- Name --}}
                    <div class="mb-3">

                        <label class="form-label" for="name">
                            Name
                        </label>

                        <input
                            id="name"
                            class="form-control @error('name') is-invalid @enderror"
                            type="text"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autofocus
                            autocomplete="name"
                            placeholder="Your full name">

                        <x-input-error :messages="$errors->get('name')" class="mt-2" />

                    </div>

                    {{-- Email Address --}}
                    <div class="mb-3">

                        <label class="form-label" for="email">
                            Email
                        </label>

                        <input
                            id="email"
                            class="form-control @error('email') is-invalid @enderror"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="username"
                            placeholder="you@example.com">

                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>

                    {{-- Password --}}
                    <div class="mb-3">

                        <label class="form-label" for="password">
                            Password
                        </label>

                        <input
                            id="password"
                            class="form-control @error('password') is-invalid @enderror"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password"
                            placeholder="Enter password">

                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>

                    {{-- Confirm Password --}}
                    <div class="mb-3">

                        <label class="form-label" for="password_confirmation">
                            Confirm Password
                        </label>

                        <input
                            id="password_confirmation"
                            class="form-control @error('password_confirmation') is-invalid @enderror"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Repeat password">

                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    </div>

                    {{-- Login & Register --}}
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2 mt-4">

                        <a
                            class="text-decoration-none text-secondary small"
                            href="{{ route('login') }}">

                            Already registered?

                        </a>

                        <button class="btn-mono" type="submit">
                            Register
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </main>

    <div id="siteFooter"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/js/shared.js') }}"></script>

</body>
</html>
