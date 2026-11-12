
@extends('layout.admin-layout')

@section('content')

    <div class="container-fluid p-3 p-lg-4">

        {{-- Page Header --}}
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-receipt me-2"></i>
                    Order Details
                </h4>

                <p class="text-secondary mb-0">
                    View complete customer order information
                </p>
            </div>

            <a href="{{ route('order.list') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Orders
            </a>

        </div>

        <div class="row g-4">

            {{-- Customer Information --}}
            <div class="col-12 col-lg-4">

                <div class="card border shadow-sm h-100">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-person me-2"></i>
                            Customer Information
                        </h6>

                    </div>

                    <div class="card-body">

                        <div class="mb-3">

                            <small class="text-secondary d-block mb-1">
                                Customer Name
                            </small>

                            <span class="fw-semibold">
                                {{ $order->first_name }} {{ $order->last_name }}
                            </span>

                        </div>

                        <div class="mb-3">

                            <small class="text-secondary d-block mb-1">
                                Email Address
                            </small>

                            <span class="fw-semibold">
                                {{ $order->email }}
                            </span>

                        </div>

                        <div class="mb-3">

                            <small class="text-secondary d-block mb-1">
                                Phone Number
                            </small>

                            <span class="fw-semibold">
                                {{ $order->phone }}
                            </span>

                        </div>

                        <div class="mb-3">

                            <small class="text-secondary d-block mb-1">
                                Delivery Address
                            </small>

                            <span class="fw-semibold">
                                {{ $order->address }}
                            </span>

                        </div>

                        {{-- Customer Message --}}
                        <div>

                            <small class="text-secondary d-block mb-2">
                                Customer Message
                            </small>

                            <div class="bg-light border rounded p-3">

                                <span class="text-dark">
                                    {{ $order->message ?: 'No message provided.' }}
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- Order Information --}}
            <div class="col-12 col-lg-8">

                <div class="card border shadow-sm">

                    <div class="card-header bg-white py-3">

                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">

                            <h6 class="fw-bold mb-0">

                                <i class="bi bi-bag-check me-2"></i>
                                Order #{{ $order->id }}

                            </h6>

                            <span class="badge text-bg-dark">
                                {{ ucfirst($order->order_status) }}
                            </span>

                        </div>

                    </div>

                    <div class="card-body">

                        <div class="row g-3">

                            <div class="col-12 col-md-6">

                                <small class="text-secondary d-block mb-1">
                                    Order Date
                                </small>

                                <span class="fw-semibold">
                                    {{ $order->created_at->format('d M, Y h:i A') }}
                                </span>

                            </div>

                            <div class="col-12 col-md-6">

                                <small class="text-secondary d-block mb-1">
                                    Payment Method
                                </small>

                                <span class="fw-semibold">
                                    {{ ucfirst($order->payment_method) }}
                                </span>

                            </div>

                        </div>

                        <hr class="my-4">

                        {{-- Update Order Status --}}
                        <form action="{{ route('admin.order.status.update', $order->id) }}" method="POST">

                            @csrf
                            @method('PATCH')

                            <div class="row align-items-end g-3">

                                <div class="col-md-8">

                                    <label class="form-label fw-semibold">
                                        Update Order Status
                                    </label>

                                    <select name="status" class="form-select" required>

                                        <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>
                                            Pending
                                        </option>

                                        <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>
                                            Processing
                                        </option>

                                        <option value="shipped" {{ $order->order_status == 'shipped' ? 'selected' : '' }}>
                                            Shipped
                                        </option>

                                        <option value="delivered" {{ $order->order_status == 'delivered' ? 'selected' : '' }}>
                                            Delivered
                                        </option>

                                        <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>
                                            Cancelled
                                        </option>

                                    </select>

                                </div>

                                <div class="col-md-4">

                                    <button type="submit" class="btn btn-dark w-100">
                                        <i class="bi bi-arrow-repeat me-2"></i>
                                        Update Status
                                    </button>

                                </div>

                            </div>

                        </form>

                    </div>

                </div>

                {{-- Ordered Products --}}
                <div class="card border shadow-sm mt-4">

                    <div class="card-header bg-white py-3">

                        <h6 class="fw-bold mb-0">
                            <i class="bi bi-box-seam me-2"></i>
                            Ordered Products
                        </h6>

                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th class="ps-3">
                                            Product
                                        </th>

                                        <th>
                                            Price
                                        </th>

                                        <th>
                                            Quantity
                                        </th>

                                        <th class="text-end pe-3">
                                            Subtotal
                                        </th>

                                    </tr>

                                </thead>

                                <tbody>

                                    @forelse ($order->items as $item)

                                        <tr>

                                            {{-- Product --}}
                                            <td class="ps-3">

                                                <div class="d-flex align-items-center gap-3">

                                                    @if ($item->product && $item->product->product_image)

                                                        <img src="{{ asset('storage/' . $item->product->product_image) }}"
                                                            alt="{{ $item->product->title }}" width="50" height="50"
                                                            class="rounded border" style="object-fit: cover;">

                                                    @else

                                                        <div class="border rounded d-flex align-items-center justify-content-center"
                                                            style="width: 50px; height: 50px;">

                                                            <i class="bi bi-image text-secondary"></i>

                                                        </div>

                                                    @endif

                                                    <div>

                                                        <div class="fw-semibold">

                                                            {{ $item->product->title ?? 'Product Not Found' }}

                                                        </div>

                                                    </div>

                                                </div>

                                            </td>

                                            {{-- Price --}}
                                            <td>

                                                ৳ {{ number_format($item->price, 2) }}

                                            </td>

                                            {{-- Quantity --}}
                                            <td>

                                                {{ $item->quantity }}

                                            </td>

                                            {{-- Subtotal --}}
                                            <td class="text-end pe-3 fw-semibold">

                                                ৳ {{ number_format($item->price * $item->quantity, 2) }}

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="4" class="text-center py-4 text-secondary">

                                                No products found for this order.

                                            </td>

                                        </tr>

                                    @endforelse

                                </tbody>

                            </table>

                        </div>

                        {{-- Total Amount --}}
                        <div class="border-top p-3">

                            <div class="d-flex justify-content-end">

                                <div style="min-width: 250px;">

                                    {{-- Subtotal --}}
                                    <div class="d-flex justify-content-between mb-2">

                                        <span class="text-secondary">
                                            Subtotal
                                        </span>

                                        <span class="fw-semibold">
                                            ৳ {{ number_format($order->subtotal, 2) }}
                                        </span>

                                    </div>

                                    {{-- Shipping Charge --}}
                                    <div class="d-flex justify-content-between mb-2">

                                        <span class="text-secondary">
                                            Shipping Charge
                                        </span>

                                        <span class="fw-semibold">
                                            ৳ {{ number_format($order->shipping, 2) }}
                                        </span>

                                    </div>

                                    <hr class="my-2">

                                    {{-- Total Amount --}}
                                    <div class="d-flex justify-content-between">

                                        <span class="text-secondary">
                                            Total Amount
                                        </span>

                                        <span class="fw-bold">
                                            ৳ {{ number_format($order->total, 2) }}
                                        </span>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
