
@extends('layout.admin-layout')

@section('content')

<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center
                gap-3 mb-4">

        <div>
            <div class="small text-secondary fw-semibold mb-2">
                <i class="bi bi-people me-1"></i>
                USER MANAGEMENT
            </div>

            <h2 class="fw-bold mb-1">
                User Details
            </h2>

            <p class="text-secondary mb-0">
                View registered user information.
            </p>
        </div>

        <a href="{{ route('admin.users') }}"
            class="btn btn-outline-dark rounded-0">

            <i class="bi bi-arrow-left me-2"></i>
            Back to Users

        </a>

    </div>


    <div class="row g-4">

        <!-- Profile Card -->
        <div class="col-12 col-lg-4">

            <div class="card border-dark rounded-0 h-100">

                <div class="card-body text-center p-4 p-md-5">

                    <!-- Profile Image -->
                    @if($user->avatar)

                        <img src="{{ $user->avatar }}"
                            alt="{{ $user->name }}"
                            class="rounded-circle border border-dark border-2 mb-3 object-fit-cover"
                            width="110"
                            height="110">

                    @else

                        <div class="rounded-circle bg-dark text-white
                                    d-flex align-items-center justify-content-center
                                    mx-auto mb-3 fw-bold"
                            style="width:110px; height:110px; font-size:40px;">

                            {{ strtoupper(substr($user->name, 0, 1)) }}

                        </div>

                    @endif


                    <h4 class="fw-bold mb-1">
                        {{ $user->name }}
                    </h4>

                    <p class="text-secondary mb-3">
                        {{ $user->email }}
                    </p>


                    <span class="badge bg-dark rounded-0 px-3 py-2 text-uppercase">

                        {{ $user->user_type ?? 'User' }}

                    </span>


                    <hr class="border-dark my-4">


                    <div class="d-flex justify-content-between">

                        <span class="text-secondary">
                            User ID
                        </span>

                        <strong>
                            #{{ $user->id }}
                        </strong>

                    </div>

                </div>

            </div>

        </div>


        <!-- User Information -->
        <div class="col-12 col-lg-8">

            <div class="card border-dark rounded-0 h-100">

                <div class="card-header bg-dark text-white rounded-0 py-3">

                    <h5 class="fw-bold mb-0">

                        <i class="bi bi-person-vcard me-2"></i>

                        Personal Information

                    </h5>

                </div>


                <div class="card-body p-4">

                    <div class="row g-4">

                        <!-- Full Name -->
                        <div class="col-12 col-md-6">

                            <label class="small text-secondary fw-semibold mb-2">
                                Full Name
                            </label>

                            <div class="fw-bold">
                                {{ $user->name }}
                            </div>

                        </div>


                        <!-- Email -->
                        <div class="col-12 col-md-6">

                            <label class="small text-secondary fw-semibold mb-2">
                                Email Address
                            </label>

                            <div class="fw-bold text-break">
                                {{ $user->email }}
                            </div>

                        </div>


                        <!-- User Type -->
                        <div class="col-12 col-md-6">

                            <label class="small text-secondary fw-semibold mb-2">
                                Account Type
                            </label>

                            <div class="fw-bold text-uppercase">
                                {{ $user->user_type ?? 'User' }}
                            </div>

                        </div>


                        <!-- Registration Date -->
                        <div class="col-12 col-md-6">

                            <label class="small text-secondary fw-semibold mb-2">
                                Registration Date
                            </label>

                            <div class="fw-bold">
                                {{ $user->created_at->format('d F Y') }}
                            </div>

                            <small class="text-secondary">
                                {{ $user->created_at->format('h:i A') }}
                            </small>

                        </div>


                        <!-- Last Updated -->
                        <div class="col-12 col-md-6">

                            <label class="small text-secondary fw-semibold mb-2">
                                Last Updated
                            </label>

                            <div class="fw-bold">
                                {{ $user->updated_at->format('d F Y') }}
                            </div>

                            <small class="text-secondary">
                                {{ $user->updated_at->format('h:i A') }}
                            </small>

                        </div>


                        <!-- Email Verification -->
                        <div class="col-12 col-md-6">

                            <label class="small text-secondary fw-semibold mb-2">
                                Email Verification
                            </label>

                            @if($user->email_verified_at)

                                <div class="text-success fw-semibold">
                                    <i class="bi bi-check-circle me-1"></i>
                                    Verified
                                </div>

                            @else

                                <div class="text-danger fw-semibold">
                                    <i class="bi bi-x-circle me-1"></i>
                                    Not Verified
                                </div>

                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
