
@extends('layout.admin-layout')

@section('content')

<main class="col-lg-10 col-md-9 bg-white text-dark p-3 p-lg-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">Account Security</h3>
            <p class="mb-0">Manage your password and account.</p>
        </div>

        <a href="{{ route('admin.profile') }}" class="btn btn-outline-dark">
            <i class="bi bi-arrow-left me-2"></i>
            Back to Profile
        </a>

    </div>


    <!-- Change Password -->
    <div class="card border-dark rounded-0 mb-4">

        <div class="card-header bg-white border-dark py-3">

            <h5 class="fw-bold mb-0">
                <i class="bi bi-shield-lock me-2"></i>
                Change Password
            </h5>

        </div>

        <div class="card-body p-4">

            <p class="text-muted mb-4">
                Enter your new password and confirm it to update your account password.
            </p>

            <form action="{{ route('admin.password.update') }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- New Password -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        New Password
                    </label>

                    <input
                        type="password"
                        name="password"
                        class="form-control rounded-0 @error('password') is-invalid @enderror"
                        placeholder="Enter new password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >


                </div>

                <!-- Confirm Password -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Confirm New Password
                    </label>

                    <input
                        type="password"
                        name="password_confirmation"
                        class="form-control rounded-0"
                        placeholder="Confirm new password"
                        minlength="8"
                        autocomplete="new-password"
                        required
                    >

                </div>

                <button type="submit" class="btn btn-dark">

                    <i class="bi bi-check-circle me-2"></i>
                    Update Password

                </button>

            </form>

        </div>

    </div>


    <!-- Delete Account -->
    <div class="card border-danger rounded-0">

        <div class="card-header bg-white border-danger py-3">

            <h5 class="fw-bold text-danger mb-0">
                <i class="bi bi-trash me-2"></i>
                Delete Account
            </h5>

        </div>

        <div class="card-body p-4">

            <p class="mb-4">
                Permanently delete your account. This action cannot be undone.
                Enter your current password to confirm account deletion.
            </p>

            <form action="{{ route('admin.account.delete') }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <!-- Password -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Current Password
                    </label>

                    <input
                        type="password"
                        name="delete_password"
                        class="form-control rounded-0 @error('delete_password') is-invalid @enderror"
                        placeholder="Enter your current password"
                        autocomplete="current-password"
                        required
                    >

                    @error('delete_password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <!-- Delete Button -->
                <button
                    type="submit"
                    class="btn btn-outline-danger"
                    onclick="return confirm('Are you sure you want to permanently delete your account?')">

                    <i class="bi bi-trash me-2"></i>
                    Delete My Account

                </button>

            </form>

        </div>

    </div>


    <!-- Footer -->
    <footer class="text-center py-4">

        <small class="text-muted">
            © {{ date('Y') }} Admin Panel. All rights reserved.
        </small>

    </footer>

</main>

@endsection
