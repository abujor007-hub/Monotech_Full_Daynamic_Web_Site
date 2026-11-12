@extends('layout.admin-layout')

@section('content')

<div class="container-fluid py-4">

    <!-- Page Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between
                align-items-md-center gap-3 mb-4">

        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-chat-dots me-2"></i>
                Messages
            </h2>

            <p class="text-secondary mb-0">
                View messages sent by customers.
            </p>
        </div>

        <div class="border border-dark px-3 py-2 bg-white">
            <span class="fw-semibold">
                Total: {{ $messages->count() }}
            </span>
        </div>

    </div>



    <!-- Messages Table -->
    <div class="card border-dark rounded-0">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-dark">

                        <tr>
                            <th class="px-3 py-3">#</th>
                            <th class="px-3 py-3">Customer</th>
                            <th class="px-3 py-3">Email</th>
                            <th class="px-3 py-3">Subject</th>
                            <th class="px-3 py-3">Message</th>
                            <th class="px-3 py-3">Date</th>
                            <th class="px-3 py-3 text-end">Action</th>
                        </tr>

                    </thead>

                    <tbody>

                        @forelse($messages as $message)

                            <tr>

                                <td class="px-3">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="px-3">
                                    <strong>{{ $message->name }}</strong>
                                </td>

                                <td class="px-3">
                                    {{ $message->email }}
                                </td>

                                <td class="px-3">
                                    <span class="badge text-bg-light border border-dark rounded-0">
                                        {{ $message->subject }}
                                    </span>
                                </td>

                                <td class="px-3" style="max-width: 250px;">
                                    {{ \Illuminate\Support\Str::limit($message->message, 60) }}
                                </td>

                                <td class="px-3 text-nowrap">
                                    {{ $message->created_at->format('d M Y') }}

                                    <small class="d-block text-secondary">
                                        {{ $message->created_at->format('h:i A') }}
                                    </small>
                                </td>

                                <td class="px-3 text-end">

                                    <!-- View Button -->
                                    <a href="{{ route('user.messages.show',$message->id) }}"
                                        type="button"
                                        class="btn btn-sm btn-dark rounded-0"
                                        data-bs-toggle="modal"
                                        data-bs-target="#messageModal{{ $message->id }}">

                                        <i class="bi bi-eye"></i>

                                    </a>

                                    <!-- Delete Button -->
                                    <form
                                        action="{{ route('user.messages.delete',$message->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-dark rounded-0"
                                            onclick="return confirm('Are you sure you want to delete this message?')">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>


                            <!-- Message Modal -->
                            <div
                                class="modal fade"
                                id="messageModal{{ $message->id }}"
                                tabindex="-1">

                                <div class="modal-dialog modal-dialog-centered">

                                    <div class="modal-content rounded-0 border-dark">

                                        <div class="modal-header">

                                            <h5 class="modal-title fw-bold">
                                                <i class="bi bi-chat-dots me-2"></i>
                                                Customer Message
                                            </h5>

                                            <button
                                                type="button"
                                                class="btn-close"
                                                data-bs-dismiss="modal">
                                            </button>

                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">

                                                <small class="text-secondary d-block">
                                                    Customer
                                                </small>

                                                <strong>
                                                    {{ $message->name }}
                                                </strong>

                                            </div>

                                            <div class="mb-3">

                                                <small class="text-secondary d-block">
                                                    Email
                                                </small>

                                                <span>
                                                    {{ $message->email }}
                                                </span>

                                            </div>

                                            <div class="mb-3">

                                                <small class="text-secondary d-block">
                                                    Subject
                                                </small>

                                                <strong>
                                                    {{ $message->subject }}
                                                </strong>

                                            </div>

                                            <div>

                                                <small class="text-secondary d-block mb-2">
                                                    Message
                                                </small>

                                                <div class="border border-dark p-3 bg-light">
                                                    {{ $message->message }}
                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">

                                            <button
                                                type="button"
                                                class="btn btn-dark rounded-0"
                                                data-bs-dismiss="modal">

                                                Close

                                            </button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        @empty

                            <tr>

                                <td colspan="7" class="text-center py-5 text-secondary">

                                    <i class="bi bi-chat-dots fs-1 d-block mb-2"></i>

                                    No messages found.

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