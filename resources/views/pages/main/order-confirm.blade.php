@include('common.nav')
<div class="container py-5" style="max-width:1220px">

    @php
        $district = $order->district ?? $order->distirct ?? '';
    @endphp

    {{-- SUCCESS MESSAGE --}}
    <div class="text-center mb-5 pb-2">

        <div class="d-inline-flex align-items-center justify-content-center bg-black text-white rounded-circle mb-4"
             style="width:84px; height:84px;">
            <i class="bi bi-check-lg" style="font-size: 46px;"></i>
        </div>

        <div class="text-uppercase text-secondary fw-semibold mb-2" style="font-size:.75rem; letter-spacing:.2em;">
            Order confirmed
        </div>

        <h1 class="fw-bolder text-uppercase mb-3" style="letter-spacing:-.02em;">
            Thank you for your order.
        </h1>

        <p class="text-secondary mb-4">
            Your order has been placed successfully. We'll get your parts ready.
        </p>

        <span class="d-inline-block border border-dark px-4 py-2 fw-bold text-uppercase" style="font-size:.85rem; letter-spacing:.08em;">
            Order ID: #{{ $order->id }}
        </span>

    </div>


    <div class="row g-4">

        {{-- LEFT SIDE --}}
        <div class="col-lg-8">

            {{-- ORDER INFORMATION --}}
            <div class="card rounded-0 border mb-4">

                <div class="card-header bg-black text-white py-3 rounded-0 d-flex align-items-center gap-3">
                    <span class="text-secondary fw-bold" style="font-size:.8rem;">01</span>
                    <h5 class="mb-0 text-uppercase fw-bold" style="font-size:.9rem; letter-spacing:.1em;">Order Information</h5>
                </div>

                <div class="card-body p-4">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Order ID</small>
                            <h6 class="fw-bold mt-1 mb-0">#{{ $order->id }}</h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Order Date</small>
                            <h6 class="fw-bold mt-1 mb-0">{{ $order->created_at->format('d M Y, h:i A') }}</h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Order Status</small>
                            <h6 class="mt-2 mb-0">
                                <span class="badge bg-warning text-dark rounded-0 px-3 py-2 text-uppercase">
                                    {{ ucfirst($order->order_status) }}
                                </span>
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Payment Method</small>
                            <h6 class="mt-2 mb-0">
                                <span class="badge bg-black text-white rounded-0 px-3 py-2">
                                    {{ strtoupper($order->payment_method) }}
                                </span>
                            </h6>
                        </div>

                    </div>

                </div>
            </div>


            {{-- CUSTOMER INFORMATION --}}
            <div class="card rounded-0 border mb-4">

                <div class="card-header bg-black text-white py-3 rounded-0 d-flex align-items-center gap-3">
                    <span class="text-secondary fw-bold" style="font-size:.8rem;">02</span>
                    <h5 class="mb-0 text-uppercase fw-bold" style="font-size:.9rem; letter-spacing:.1em;">Customer Information</h5>
                </div>

                <div class="card-body p-4">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Full Name</small>
                            <h6 class="fw-bold mt-1 mb-0">
                                {{ $order->first_name }}
                                {{ $order->last_name }}
                            </h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Phone Number</small>
                            <h6 class="fw-bold mt-1 mb-0">{{ $order->phone }}</h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Email Address</small>
                            <h6 class="fw-bold mt-1 mb-0 text-break">{{ $order->email }}</h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">City</small>
                            <h6 class="fw-bold mt-1 mb-0">{{ $order->city }}</h6>
                        </div>

                        <div class="col-md-6">
                            <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">District</small>
                            <h6 class="fw-bold mt-1 mb-0">{{ $district }}</h6>
                        </div>

                        <div class="col-md-12">
                            <div class="bg-light border-start border-4 border-dark p-3">
                                <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">
                                    <i class="bi bi-geo-alt me-1"></i>Delivery Address
                                </small>
                                <h6 class="fw-bold mt-1 mb-0">{{ $order->address }}</h6>
                            </div>
                        </div>

                        @if($order->message)
                            <div class="col-md-12">
                                <small class="text-uppercase text-secondary fw-semibold" style="font-size:.7rem; letter-spacing:.1em;">Additional Message</small>
                                <h6 class="mt-1 mb-0">{{ $order->message }}</h6>
                            </div>
                        @endif

                    </div>

                </div>
            </div>


            {{-- ORDERED PRODUCTS --}}
            <div class="card rounded-0 border">

                <div class="card-header bg-black text-white py-3 rounded-0 d-flex align-items-center gap-3">
                    <span class="text-secondary fw-bold" style="font-size:.8rem;">03</span>
                    <h5 class="mb-0 text-uppercase fw-bold" style="font-size:.9rem; letter-spacing:.1em;">Ordered Products</h5>
                </div>

                <div class="card-body p-4 pt-2 pb-2">

                    @foreach($order->items as $item)

                        <div class="row align-items-center py-3 {{ !$loop->last ? 'border-bottom' : '' }}">

                            <div class="col-3 col-md-2">

                                @if($item->product && $item->product->product_image)
                                    <div class="bg-light p-2 border">
                                        <img
                                            src="{{ asset('storage/' . $item->product->product_image) }}"
                                            class="img-fluid"
                                            alt="{{ $item->product->title }}"
                                            style="max-height: 90px; width:100%; object-fit: contain;"
                                        >
                                    </div>
                                @else
                                    <div class="bg-light border text-center py-4">
                                        <i class="bi bi-image text-muted fs-3"></i>
                                    </div>
                                @endif

                            </div>

                            <div class="col-9 col-md-6">

                                <h6 class="fw-bold mb-2">
                                    {{ $item->product->title ?? 'Product unavailable' }}
                                </h6>

                                <p class="text-secondary small mb-1">
                                    Price: ৳{{ number_format($item->price, 2) }}
                                </p>

                                <span class="badge bg-light text-dark border rounded-0">
                                    Qty: {{ $item->quantity }}
                                </span>

                            </div>

                            <div class="col-12 col-md-4 text-md-end mt-3 mt-md-0">

                                <h6 class="fw-bolder fs-5 mb-0">
                                    ৳{{ number_format($item->price * $item->quantity, 2) }}
                                </h6>

                            </div>

                        </div>

                    @endforeach

                </div>
            </div>

        </div>


        {{-- RIGHT SIDE: ORDER SUMMARY --}}
        <div class="col-lg-4">

            <div class="position-sticky" style="top:20px;">

                <div class="card rounded-0 border">

                    <div class="card-header bg-black text-white py-3 rounded-0">
                        <h5 class="mb-0 text-uppercase fw-bold" style="font-size:.9rem; letter-spacing:.1em;">Order Summary</h5>
                    </div>

                    <div class="card-body p-4">

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Subtotal</span>
                            <strong>
                                ৳{{ number_format($order->subtotal, 2) }}
                            </strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span class="text-secondary">Shipping</span>
                            <strong>
                                ৳{{ number_format($order->shipping, 2) }}
                            </strong>
                        </div>

                        <hr class="border-dark opacity-100">

                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="fw-bolder text-uppercase mb-0" style="font-size:.95rem;">Grand Total</h5>

                            <h4 class="fw-bolder mb-0">
                                ৳{{ number_format($order->total, 2) }}
                            </h4>
                        </div>

                        <div class="bg-light border-start border-4 border-warning p-3 mt-4 mb-0 small">

                            <i class="bi bi-info-circle me-2"></i>

                            Your order is currently
                            <strong>{{ ucfirst($order->order_status) }}</strong>.

                        </div>

                    </div>
                </div>


                {{-- BUTTONS --}}
                <div class="d-grid gap-2 mt-4">

                    <a href="{{ route('index') }}"
                       class="btn btn-dark rounded-0 py-3 text-uppercase fw-semibold"
                       style="letter-spacing:.1em; font-size:.85rem;">
                        <i class="bi bi-house me-2"></i>
                        Continue Shopping
                    </a>

                </div>

            </div>

        </div>

    </div>

</div>


@include('common.footer')