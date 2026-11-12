
@extends('layout.user-dayout')

@section('content')

<main class="col">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">Order Details</h3>
            <p class="text-secondary small mb-0">
                View your order information and purchased products.
            </p>
        </div>

        <a href="{{ route('user.orders') }}"
            class="btn btn-outline-dark btn-sm rounded-0">
            <i class="bi bi-arrow-left me-1"></i> Back to Orders
        </a>

    </div>

    {{-- Order Information --}}
    <div class="card border-dark rounded-0 mb-4">

        <div class="card-header bg-white border-dark py-3">

            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                <h5 class="fw-bold mb-0">
                    Order #ORD{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                </h5>

                @if ($order->order_status == 'delivered')

                    <span class="badge bg-dark rounded-0">Delivered</span>

                @elseif ($order->order_status == 'pending')

                    <span class="badge bg-white text-dark border border-dark rounded-0">Pending</span>

                @elseif ($order->order_status == 'processing')

                    <span class="badge bg-secondary rounded-0">Processing</span>

                @elseif ($order->order_status == 'cancelled')

                    <span class="badge bg-white text-danger border border-danger rounded-0">Cancelled</span>

                @else

                    <span class="badge bg-white text-dark border border-dark rounded-0">
                        {{ ucfirst($order->order_status) }}
                    </span>

                @endif

            </div>

        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-4">
                    <small class="text-secondary">Order Date</small>
                    <p class="fw-semibold mb-0">
                        {{ $order->created_at->format('d M Y, h:i A') }}
                    </p>
                </div>

                <div class="col-md-4">
                    <small class="text-secondary">Payment Method</small>
                    <p class="fw-semibold text-uppercase mb-0">
                        {{ $order->payment_method }}
                    </p>
                </div>

                <div class="col-md-4">
                    <small class="text-secondary">Total Amount</small>
                    <p class="fw-bold mb-0">
                        ৳{{ number_format($order->total, 2) }}
                    </p>
                </div>

            </div>

        </div>

    </div>

    {{-- Customer Information --}}
    <div class="card border-dark rounded-0 mb-4">

        <div class="card-header bg-white border-dark py-3">
            <h5 class="fw-bold mb-0">Customer Information</h5>
        </div>

        <div class="card-body">

            <div class="row g-3">

                <div class="col-md-6">
                    <small class="text-secondary">Customer Name</small>
                    <p class="fw-semibold mb-0">
                        {{ $order->first_name }} {{ $order->last_name }}
                    </p>
                </div>

                <div class="col-md-6">
                    <small class="text-secondary">Phone</small>
                    <p class="fw-semibold mb-0">{{ $order->phone }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-secondary">Email</small>
                    <p class="fw-semibold mb-0">{{ $order->email }}</p>
                </div>

                <div class="col-md-6">
                    <small class="text-secondary">City</small>
                    <p class="fw-semibold mb-0">{{ $order->city }}</p>
                </div>

                <div class="col-12">
                    <small class="text-secondary">Delivery Address</small>
                    <p class="fw-semibold mb-0">
                        {{ $order->address }}
                    </p>
                </div>

                <div class="col-12">
                    <small class="text-secondary">District</small>
                    <p class="fw-semibold mb-0">
                        {{ $order->distirct }}
                    </p>
                </div>

                @if ($order->message)
                    <div class="col-12">
                        <small class="text-secondary">Additional Message</small>
                        <p class="mb-0">{{ $order->message }}</p>
                    </div>
                @endif

            </div>

        </div>

    </div>

    {{-- Ordered Products --}}
    <div class="card border-dark rounded-0 mb-4">

        <div class="card-header bg-white border-dark py-3">
            <h5 class="fw-bold mb-0">Ordered Products</h5>
        </div>

        <div class="table-responsive">

            <table class="table align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($order->items as $item)

                        <tr>

                            <td class="ps-3">

                                <div class="d-flex align-items-center gap-2">

                                    @if ($item->product && $item->product->product_image)

                                        <img src="{{ asset('storage/' . $item->product->product_image) }}"
                                            alt="{{ $item->product->title }}"
                                            width="55"
                                            height="55"
                                            class="object-fit-cover border">

                                    @endif

                                    <span class="fw-semibold">
                                        {{ $item->product?->title ?? 'Product Unavailable' }}
                                    </span>

                                </div>

                            </td>

                            <td>
                                ৳{{ number_format($item->price, 2) }}
                            </td>

                            <td>
                                {{ $item->quantity }}
                            </td>

                            <td class="fw-semibold">
                                ৳{{ number_format($item->price * $item->quantity, 2) }}
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        {{-- Order Summary --}}
        <div class="card-body">

            <div class="row justify-content-end">

                <div class="col-md-5">

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Subtotal</span>
                        <span>৳{{ number_format($order->subtotal, 2) }}</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-secondary">Shipping</span>
                        <span>৳{{ number_format($order->shipping, 2) }}</span>
                    </div>

                    <hr class="border-dark">

                    <div class="d-flex justify-content-between">
                        <span class="fw-bold">Grand Total</span>
                        <h5 class="fw-bold mb-0">
                            ৳{{ number_format($order->total, 2) }}
                        </h5>
                    </div>

                </div>

            </div>

        </div>

    </div>

</main>

@endsection
