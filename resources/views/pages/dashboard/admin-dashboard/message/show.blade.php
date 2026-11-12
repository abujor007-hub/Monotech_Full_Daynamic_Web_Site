@extends('layout.admin-layout')

@section('content')

<div class="container-fluid py-4">

    <!-- Header -->
    <div class="d-flex flex-column flex-md-row
                justify-content-between align-items-md-center
                gap-3 mb-4">

        <div>

            <div class="d-flex align-items-center gap-2 mb-2">

                <i class="bi bi-chat-dots fs-4"></i>

                <span class="text-uppercase small text-secondary fw-semibold">
                    Customer Message
                </span>

            </div>

            <h2 class="fw-bold mb-1">
                Message Details
            </h2>

            <p class="text-secondary mb-0">
                View the complete message sent by the customer.
            </p>

        </div>

        <!-- Back Button -->
        <a href="{{ route('admin.messages') }}"
            class="btn btn-outline-dark rounded-0">

            <i class="bi bi-arrow-left me-2"></i>
            Back to Messages

        </a>

    </div>


    <div class="row g-4">

        <!-- Customer Information -->
        <div class="col-12 col-lg-4">

            <div class="card border-dark rounded-0 h-100">

                <div class="card-header bg-dark text-white rounded-0">

                    <i class="bi bi-person me-2"></i>
                    Customer Information

                </div>

                <div class="card-body">

                    <!-- Name -->
                    <div class="mb-4">

                        <small class="text-secondary d-block mb-1">
                            Customer Name
                        </small>

                        <div class="fw-bold fs-5">
                            {{ $message->name }}
                        </div>

                    </div>


                    <!-- Email -->
                    <div class="mb-4">

                        <small class="text-secondary d-block mb-1">
                            Email Address
                        </small>

                        <a href="mailto:{{ $message->email }}"
                            class="text-dark text-decoration-none">

                            <i class="bi bi-envelope me-1"></i>
                            {{ $message->email }}

                        </a>

                    </div>


                    <!-- Date -->
                    <div>

                        <small class="text-secondary d-block mb-1">
                            Received On
                        </small>

                        <div class="fw-semibold">

                            <i class="bi bi-calendar3 me-1"></i>

                            {{ $message->created_at->format('d F Y') }}

                            <br>

                            <small class="text-secondary">

                                <i class="bi bi-clock me-1"></i>

                                {{ $message->created_at->format('h:i A') }}

                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        <!-- Message Content -->
        <div class="col-12 col-lg-8">

            <div class="card border-dark rounded-0">

                <div class="card-header bg-white border-dark">

                    <div class="d-flex justify-content-between
                                align-items-center gap-3">

                        <div>

                            <small class="text-secondary d-block mb-1">
                                Subject
                            </small>

                            <h5 class="fw-bold mb-0">
                                {{ $message->subject }}
                            </h5>

                        </div>

                        <i class="bi bi-chat-square-text fs-3"></i>

                    </div>

                </div>


                <div class="card-body p-4 p-md-5">

                    <small class="text-secondary text-uppercase
                                 fw-semibold d-block mb-3">

                        Message

                    </small>

                    <div class="lh-lg text-dark"
                        style="white-space: pre-line;">

                        {{ $message->message }}

                    </div>

                </div>


                <!-- Footer -->
                <div class="card-footer bg-white border-dark p-3">

                    <div class="d-flex flex-column flex-sm-row
                                justify-content-between align-items-sm-center
                                gap-3">

                        <span class="small text-secondary">

                            <i class="bi bi-chat-dots me-1"></i>
                            Customer Contact Message

                        </span>

                        <div class="d-flex gap-2">

                            <!-- Reply Email -->
                            <a href="mailto:{{ $message->email }}"
                                class="btn btn-dark rounded-0">

                                <i class="bi bi-reply me-1"></i>
                                Reply

                            </a>


                            <!-- Delete -->
                            <form
                                action="{{ route('user.messages.delete', $message->id) }}"
                                method="POST">

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-outline-dark rounded-0"
                                    onclick="return confirm('Are you sure you want to delete this message?')">

                                    <i class="bi bi-trash"></i>

                                </button>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection