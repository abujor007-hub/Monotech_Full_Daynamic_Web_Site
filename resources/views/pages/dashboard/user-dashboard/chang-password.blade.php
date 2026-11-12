 
@extends('layout.user-dayout')

@section('content')

<div class="container pt-3 pb-5">

    <div class="mb-4">
        <h3 class="fw-bold">Change Password</h3>
        <p class="mb-0">Update your account password</p>
    </div>

    <div class="card border-dark rounded-0">
        <div class="card-body p-4">

          

            <form action="{{ route('userpassword.update') }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">New Password</label>

                    <input type="password"
                           name="password"
                           class="form-control rounded-0"
                           placeholder="Enter new password"
                           required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold">Confirm Password</label>

                    <input type="password"
                           name="password_confirmation"
                           class="form-control rounded-0"
                           placeholder="Confirm new password"
                           required>
                </div>

                <button type="submit" class="btn btn-dark rounded-0 px-4">
                    Update Password
                </button>

            </form>

        </div>
    </div>

</div>

<div class="container pt-3 pb-5">

<div class="mb-4">
    <h3 class="fw-bold">Delete Account</h3>
    <p class="mb-0">Permanently delete your account</p>
</div>

<div class="card border-dark rounded-0">
    <div class="card-body p-4">

        <h5 class="fw-bold mb-3 text-danger">
            Delete Your Account
        </h5>

        <p class="mb-4">
            Once you delete your account, your account information
            will be permanently deleted. This action cannot be undone.
        </p>



        <form action="{{ route('useraccount.destroy') }}" method="POST">

            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label class="form-label fw-semibold">
                    Current Password
                </label>

                <input type="password"
                       name="password"
                       class="form-control rounded-0"
                       placeholder="Enter your current password"
                       required>
            </div>

            <button type="submit"
                    class="btn btn-danger rounded-0 px-4"
                    onclick="return confirm('Are you sure you want to permanently delete your account?')">

                <i class="bi bi-trash me-2"></i>
                Delete My Account

            </button>

        </form>

    </div>
</div>

</div>

@endsection