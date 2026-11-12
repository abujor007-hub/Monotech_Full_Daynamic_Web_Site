@extends('layout.user-dayout')

@section('content')

    <div class="container pt-3 pb-5">

        <div class="mb-4">
            <h3 class="fw-bold">Profile Information</h3>
            <p class="mb-0">Your account information</p>
        </div>

        <div class="card border-dark rounded-0">

            <div class="card-body p-4">

                <!-- Profile Image -->
                <div class="text-center mb-4">

                    @if(auth()->user()->avatar)

                        <img src="{{ auth()->user()->avatar }}" alt="Profile Image" class="rounded-circle border" width="110"
                            height="110" style="object-fit: cover;" onerror="this.style.display='none';">

                    @else

                        <i class="bi bi-person-circle display-1"></i>

                    @endif

                </div>

                <!-- Name -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Name</label>
                    <input type="text" class="form-control rounded-0" value="{{ auth()->user()->name }}" readonly>
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Email</label>
                    <input type="text" class="form-control rounded-0" value="{{ auth()->user()->email }}" readonly>
                </div>

                <!-- Created At -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Created At</label>
                    <input type="text" class="form-control rounded-0"
                        value="{{ auth()->user()->created_at?->format('d M Y') }}" readonly>
                </div>

            </div>
        </div>

    </div>

@endsection