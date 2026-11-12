@extends('layout.admin-layout')

@section('content')

<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-people me-2"></i>
                Users
            </h2>

            <p class="text-secondary mb-0">
                View all registered users.
            </p>
        </div>

        <div class="border border-dark px-3 py-2 bg-white">
            <span class="fw-semibold">
                Total: {{ $users->count() }}
            </span>
        </div>

    </div>

    <!-- Users Table -->
    <div class="card border-dark rounded-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">
                        <tr>
                            <th class="px-3 py-3">#</th>
                            <th class="px-3 py-3">User</th>
                            <th class="px-3 py-3">Email</th>
                            <th class="px-3 py-3">User Type</th>
                            <th class="px-3 py-3">Joined</th>
                            <th class="px-3 py-3 text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($users as $user)

                            <tr>

                                <td class="px-3">
                                    {{ $loop->iteration }}
                                </td>

                                <!-- User -->
                                <td class="px-3">

                                    <div class="d-flex align-items-center gap-2">

                                        @if($user->avatar)
                                            <img src="{{ $user->avatar }}"
                                                alt="{{ $user->name }}"
                                                width="42"
                                                height="42"
                                                class="rounded-circle object-fit-cover">
                                        @else
                                            <div class="bg-dark text-white rounded-circle
                                                        d-flex align-items-center justify-content-center"
                                                style="width:42px; height:42px;">

                                                {{ strtoupper(substr($user->name, 0, 1)) }}

                                            </div>
                                        @endif

                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                    </div>

                                </td>

                                <!-- Email -->
                                <td class="px-3">
                                    {{ $user->email }}
                                </td>

                                <!-- User Type -->
                                <td class="px-3">

                                    <span class="badge bg-dark rounded-0 text-uppercase">
                                        {{ $user->user_type ?? 'User' }}
                                    </span>

                                </td>

                                <!-- Joined Date -->
                                <td class="px-3 text-nowrap">

                                    {{ $user->created_at->format('d M Y') }}

                                    <small class="d-block text-secondary">
                                        {{ $user->created_at->format('h:i A') }}
                                    </small>

                                </td>

                                <!-- Action -->
                                <td class="px-3 text-end">

                                    <a href="{{ route('admin.users.show', $user->id) }}"
                                        class="btn btn-sm btn-dark rounded-0">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="6"
                                    class="text-center py-5 text-secondary">

                                    <i class="bi bi-people fs-1 d-block mb-2"></i>

                                    No users found.

                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection