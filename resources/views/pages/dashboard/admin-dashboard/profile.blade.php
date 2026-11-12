@extends('layout.admin-layout')

@section('content')

    <main class="col-lg-10 col-md-9 bg-white text-dark p-3 p-lg-4">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h3 class="fw-bold mb-1">Admin Profile</h3>
                <p class="mb-0">Manage your account information.</p>
            </div>

            <a href="{{ route('admin.profile.edit') }}" class="btn btn-dark">
                <i class="bi bi-pencil-square me-2"></i>
                Edit Profile
            </a>

        </div>



        <!-- Profile Card -->
        <div class="card border-dark rounded-0">

            <div class="card-body p-4">

                <div class="text-center border-bottom pb-4 mb-4">

                    @if($user->avatar)



                        <img src="{{ $user->avatar }}" alt="Admin Profile" class="rounded-circle border border-dark" width="120"
                            height="120">

                    @else

                        <div class="rounded-circle border border-dark d-inline-flex align-items-center justify-content-center"
                            style="width:120px;height:120px;">

                            <i class="bi bi-person fs-1"></i>

                        </div>

                    @endif

                    <h4 class="fw-bold mt-3 mb-1">
                        {{ $user->name }}
                    </h4>

                    <p class="text-muted mb-2">
                        {{ $user->email }}
                    </p>

                    <span class="badge bg-dark rounded-0 px-3 py-2">
                        Administrator
                    </span>

                </div>

                <!-- Profile Information -->
                <h5 class="fw-bold mb-3">Personal Information</h5>

                <div class="row g-3">

                    <div class="col-md-6">

                        <div class="border p-3 h-100">

                            <small class="text-muted">Full Name</small>

                            <h6 class="fw-bold mt-2 mb-0">
                                {{ $user->name }}
                            </h6>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="border p-3 h-100">

                            <small class="text-muted">Email Address</small>

                            <h6 class="fw-bold mt-2 mb-0">
                                {{ $user->email }}
                            </h6>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="border p-3 h-100">

                            <small class="text-muted">Account Type</small>

                            <h6 class="fw-bold mt-2 mb-0">
                                {{ ucfirst($user->user_type) }}
                            </h6>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="border p-3 h-100">

                            <small class="text-muted">Account Created</small>

                            <h6 class="fw-bold mt-2 mb-0">

                                {{ $user->created_at->format('d M Y') }}

                            </h6>

                        </div>

                    </div>

                </div>

                <!-- Edit Button -->
                <div class="mt-4">

                    <a href="{{ route('admin.profile.edit') }}" class="btn btn-dark">

                        <i class="bi bi-pencil-square me-2"></i>
                        Edit Profile

                    </a>

                </div>

            </div>

        </div>

    </main>

@endsection