@extends('layout.admin-layout')

@section('content')

<main class="col-lg-10 col-md-9 bg-white text-dark p-3 p-lg-4">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h3 class="fw-bold mb-1">Edit Profile</h3>
            <p class="mb-0">Update your account information.</p>
        </div>

        <a href="{{ route('admin.profile') }}"
           class="btn btn-outline-dark">

            <i class="bi bi-arrow-left me-2"></i>
            Back

        </a>

    </div>

    <div class="card border-dark rounded-0">

        <div class="card-header bg-white border-dark py-3">

            <h5 class="fw-bold mb-0">
                Profile Information
            </h5>

        </div>

        <div class="card-body p-4">

            <!-- Profile Image -->
            <div class="text-center mb-4">

                @if($user->google_avatar)

                    <img
                        src="{{ $user->google_avatar }}"
                        width="100"
                        height="100"
                        class="rounded-circle border border-dark"
                        alt="Profile Image"
                    >

                @else

                    <i class="bi bi-person-circle display-1"></i>

                @endif

                <p class="text-muted mt-2 mb-0">
                    Google Profile Image
                </p>

            </div>

           
        

            <!-- Form -->
            <form action="{{ route('admin.profile.update') }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Full Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        class="form-control rounded-0"
                        value="{{ old('name', $user->name) }}"
                        required
                    >

                </div>

                <!-- Email -->
                <div class="mb-3">

                    <label class="form-label fw-semibold">
                        Email Address
                    </label>

                    <input
                        type="email"
                        name="email"
                        class="form-control rounded-0"
                        value="{{ old('email', $user->email) }}"
                        required
                    >

                </div>

                <!-- Google Image -->
                <div class="mb-4">

                    <label class="form-label fw-semibold">
                        Account Created
                    </label>

                    <input
                        type="text"
                        class="form-control rounded-0"
                        value="{{ $user->created_at->format('d M Y') }}"
                        readonly
                    >

                </div>

                <!-- Buttons -->
                <div class="d-flex flex-wrap gap-2">

                    <button type="submit" class="btn btn-dark">

                        <i class="bi bi-check-lg me-2"></i>
                        Save Changes

                    </button>

                    <a href="{{ route('admin.profile') }}"
                       class="btn btn-outline-dark">

                        Cancel

                    </a>

                </div>

            </form>

        </div>

    </div>

</main>

@endsection