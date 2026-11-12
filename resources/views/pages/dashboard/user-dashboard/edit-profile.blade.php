
@extends('layout.user-dayout')

@section('content')

<div class="containe top-0">

    <div class="row justify-content-center">

        <div class="col-lg-7 col-md-9">

            <div class="mb-4">

                <a href="/" class="text-dark text-decoration-none">
                    &larr; Back to Home
                </a>

                <h3 class="fw-bold mt-4">Edit Profile</h3>

                <p class="text-secondary">
                    Update your personal account information.
                </p>

            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Error Message --}}
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card border rounded-3 shadow-sm">

                <div class="card-body p-4">

                    <form action="{{ route('profile.update') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')

                        {{-- Profile Picture --}}
                        <div class="text-center mb-4">

                            @php
                                $user = Auth::user();
                            @endphp

                            @if($user && $user->avatar)

                                <img
                                    src="{{ filter_var($user->avatar, FILTER_VALIDATE_URL) ? $user->avatar : asset('storage/'.$user->avatar) }}"
                                    alt="Profile Picture"
                                    width="110"
                                    height="110"
                                    class="rounded-circle border object-fit-cover mb-3">

                            @else

                                <div class="rounded-circle border d-flex align-items-center justify-content-center mx-auto mb-3"
                                     style="width:110px;height:110px;">

                                    <span class="fs-1 fw-bold">
                                        {{ strtoupper(substr($user->name ?? 'U', 0, 1)) }}
                                    </span>

                                </div>

                            @endif

                            <h5 class="fw-bold mb-1">
                                {{ $user->name ?? 'User' }}
                            </h5>

                            <label for="avatar"
                                   class="btn btn-outline-dark btn-sm mt-2">
                                Change Picture
                            </label>

                            <input
                                type="file"
                                name="avatar"
                                id="avatar"
                                class="d-none"
                                accept="image/png,image/jpeg,image/webp">

                            <div class="small text-secondary mt-2">
                                JPG, PNG or WEBP. Maximum 2MB.
                            </div>

                        </div>

                        <hr>

                        {{-- Full Name --}}
                        <div class="mb-3">

                            <label class="form-label fw-semibold">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name', $user->name ?? '') }}"
                                placeholder="Enter your full name"
                                required>

                        </div>

                        {{-- Email --}}
                        <div class="mb-4">

                            <label class="form-label fw-semibold">
                                Email Address
                            </label>

                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                value="{{ old('email', $user->email ?? '') }}"
                                placeholder="Enter your email"
                                required>

                            <small class="text-secondary">
                                Make sure you use an email address you can access.
                            </small>

                        </div>

                        {{-- Buttons --}}
                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-dark px-4">
                                Save Changes
                            </button>

                            <a href="/"
                               class="btn btn-outline-dark px-4">
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
