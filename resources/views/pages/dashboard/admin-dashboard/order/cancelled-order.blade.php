
@extends('layout.admin-layout')

@section('content')

    <div class="container-fluid p-3 p-lg-4">

        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-bag-check me-2"></i>
                    Order Management
                </h4>

                <p class="text-secondary mb-0">
                    Manage and view all customer orders
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Dashboard
            </a>

        </div>

        <!-- Order Statistics Cards -->
        <div class="row g-3 mb-4">

            <!-- Pending Orders -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-secondary mb-1">
                                    Pending Orders
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ \App\Models\Order::where('order_status', 'pending')->count() }}
                                </h3>
                            </div>

                            <div class="bg-warning-subtle text-warning rounded p-3">
                                <i class="bi bi-clock-history fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Processing Orders -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-secondary mb-1">
                                    Processing Orders
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ \App\Models\Order::where('order_status', 'processing')->count() }}
                                </h3>
                            </div>

                            <div class="bg-primary-subtle text-primary rounded p-3">
                                <i class="bi bi-gear fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Shipped Orders -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-secondary mb-1">
                                    Shipped Orders
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ \App\Models\Order::where('order_status', 'shipped')->count() }}
                                </h3>
                            </div>

                            <div class="bg-info-subtle text-info rounded p-3">
                                <i class="bi bi-truck fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Delivered Orders -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-secondary mb-1">
                                    Delivered Orders
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ \App\Models\Order::where('order_status', 'delivered')->count() }}
                                </h3>
                            </div>

                            <div class="bg-success-subtle text-success rounded p-3">
                                <i class="bi bi-check-circle fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- Cancelled Orders -->
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card border shadow-sm h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between align-items-center">

                            <div>
                                <p class="text-secondary mb-1">
                                    Cancelled Orders
                                </p>

                                <h3 class="fw-bold mb-0">
                                    {{ \App\Models\Order::where('order_status', 'cancelled')->count() }}
                                </h3>
                            </div>

                            <div class="bg-danger-subtle text-danger rounded p-3">
                                <i class="bi bi-x-circle fs-3"></i>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

        </div>

        <!-- Orders Card -->
        <div class="card border shadow-sm">

            <div class="card-header bg-white py-3">

                <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">

                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-list-check me-2"></i>
                        All Orders
                    </h6>

                    <span class="text-secondary small">
                        Total Orders: {{ $order->count() }}
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="ps-3">Order ID</th>
                                <th>Customer</th>
                                <th>Phone</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Order Status</th>
                                <th>Date</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($order as $item)

                                <tr>

                                    <!-- Order ID -->
                                    <td class="ps-3">
                                        <span class="fw-semibold">
                                            #{{ $item->id }}
                                        </span>
                                    </td>

                                    <!-- Customer -->
                                    <td>
                                        <div class="fw-semibold">
                                            {{ $item->first_name }} {{ $item->last_name }}
                                        </div>

                                        <small class="text-secondary">
                                            {{ $item->email }}
                                        </small>
                                    </td>

                                    <!-- Phone -->
                                    <td>
                                        {{ $item->phone }}
                                    </td>

                                    <!-- Total -->
                                    <td>
                                        <span class="fw-semibold">
                                            ৳ {{ number_format($item->total, 2) }}
                                        </span>
                                    </td>

                                    <!-- Payment -->
                                    <td>

                                        @if ($item->payment_method == 'cash')
                                            <span class="badge text-bg-dark">
                                                Cash on Delivery
                                            </span>
                                        @else
                                            <span class="badge text-bg-secondary">
                                                {{ ucfirst($item->payment_method) }}
                                            </span>
                                        @endif

                                    </td>

                                    <!-- Order Status -->
                                    <td>

                                        @if ($item->order_status == 'pending')

                                            <span class="badge text-bg-warning">
                                                Pending
                                            </span>

                                        @elseif ($item->order_status == 'processing')

                                            <span class="badge text-bg-primary">
                                                Processing
                                            </span>

                                        @elseif ($item->order_status == 'shipped')

                                            <span class="badge text-bg-info">
                                                Shipped
                                            </span>

                                        @elseif ($item->order_status == 'delivered')

                                            <span class="badge text-bg-success">
                                                Delivered
                                            </span>

                                        @elseif ($item->order_status == 'cancelled')

                                            <span class="badge text-bg-danger">
                                                Cancelled
                                            </span>

                                        @else

                                            <span class="badge text-bg-secondary">
                                                {{ ucfirst($item->order_status ?? 'Unknown') }}
                                            </span>

                                        @endif

                                    </td>

                                    <!-- Date -->
                                    <td>
                                        <small>
                                            {{ $item->created_at->format('d M, Y') }}
                                        </small>
                                    </td>

                                    <!-- Action -->
                                    <td class="text-end pe-3">

                                        <a href="{{ route('order.details', $item->id) }}"
                                            class="btn btn-sm btn-outline-dark">

                                            <i class="bi bi-eye me-1"></i>
                                            View

                                        </a>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">

                                        <i class="bi bi-bag-x fs-1 text-secondary"></i>

                                        <h6 class="fw-bold mt-3">
                                            No Orders Found
                                        </h6>

                                        <p class="text-secondary mb-0">
                                            Customer orders will appear here.
                                        </p>

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
