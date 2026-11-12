@extends('layout.user-dayout')

@section('content')

    <main class="col">

        <div class="container-fluid py-4">

            {{-- Page Header --}}
            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>
                    <h4 class="fw-bold mb-1">My Cart</h4>

                    <p class="text-secondary mb-0 small">
                        Review your selected products.
                    </p>
                </div>

                <span class="badge bg-dark rounded-0">
                    {{ $totalItems }} Items
                </span>

            </div>

            @if(count($cart) > 0)

                <div class="row g-4">

                    {{-- Cart Items --}}
                    <div class="col-lg-8">

                        <div class="card border-dark rounded-0">

                            <div class="card-header bg-white border-dark py-3">
                                <h5 class="fw-bold mb-0">Cart Items</h5>
                            </div>

                            <div class="table-responsive">

                                <table class="table align-middle mb-0">

                                    <thead class="table-light">

                                        <tr>
                                            <th class="ps-3">Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>

                                    <tbody>

                                        @foreach($cart as $id => $item)

                                            <tr>

                                                <td class="ps-3">

                                                    <div class="d-flex align-items-center gap-3">

                                                        <img src="{{ asset('storage/' . $item['image']) }}" width="60" height="60"
                                                            class="object-fit-cover border" alt="{{ $item['title'] }}">

                                                        <div>

                                                            <h6 class="fw-bold mb-0">
                                                                {{ $item['title'] }}
                                                            </h6>

                                                        </div>

                                                    </div>

                                                </td>

                                                <td>
                                                    ৳{{ number_format($item['price'], 2) }}
                                                </td>

                                                <td>
                                                    {{ $item['quantity'] }}
                                                </td>

                                                <td class="fw-bold">
                                                    ৳{{ number_format($item['price'] * $item['quantity'], 2) }}
                                                </td>

                                                <td>

                                                    {{-- Existing Cart Remove Route --}}
                                                    <a href="{{ route('cart.remove', $id) }}"
                                                        class="btn btn-sm btn-outline-dark rounded-0">

                                                        <i class="bi bi-trash"></i>

                                                    </a>
                                                </td>

                                            </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>

                        </div>

                    </div>

                    {{-- Cart Summary --}}
                    <div class="col-lg-4">

                        <div class="card border-dark rounded-0">

                            <div class="card-header bg-white border-dark py-3">
                                <h5 class="fw-bold mb-0">Order Summary</h5>
                            </div>

                            <div class="card-body">

                                <div class="d-flex justify-content-between mb-3">

                                    <span>Subtotal</span>

                                    <strong>
                                        ৳{{ number_format($subtotal, 2) }}
                                    </strong>

                                </div>

                                <hr>

                                <div class="d-flex justify-content-between mb-4">

                                    <h5 class="fw-bold">Total</h5>

                                    <h5 class="fw-bold">
                                        ৳{{ number_format($subtotal, 2) }}
                                    </h5>

                                </div>

                                <a href="{{ route('checkout') }}" class="btn btn-dark rounded-0 w-100 py-2">

                                    Proceed to Checkout

                                </a>

                            </div>

                        </div>

                    </div>

                </div>

            @else

                {{-- Empty Cart --}}
                <div class="card border-dark rounded-0">

                    <div class="card-body text-center py-5">

                        <i class="bi bi-cart-x fs-1"></i>

                        <h5 class="fw-bold mt-3">
                            Your Cart is Empty
                        </h5>

                        <p class="text-secondary">
                            Add some products to your cart to continue shopping.
                        </p>

                    </div>

                </div>

            @endif

        </div>

    </main>

@endsection