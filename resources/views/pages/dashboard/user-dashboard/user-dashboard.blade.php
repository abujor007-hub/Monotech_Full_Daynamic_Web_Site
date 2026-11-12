
@extends('layout.user-dayout')

@section('content')

    <!-- Dashboard -->
    <main class="col">

        <!-- Overview Cards -->
        <div class="row g-3 mb-4">

            <div class="col-xl-4 col-sm-6">
                <div class="card border-dark rounded-0 h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <span>Total Orders</span>
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>

                        <h3 class="fw-bold mt-3">{{ $totalOrders }}</h3>

                        <a href="{{ route('user.orders') }}" class="text-dark">
                            View Orders
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="card border-dark rounded-0 h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <span>Pending Orders</span>
                            <i class="bi bi-clock-history fs-4"></i>
                        </div>

                        <h3 class="fw-bold mt-3">{{ $pendingOrders }}</h3>

                        <a href="{{ route('user.orders') }}" class="text-dark">
                            Track Orders
                        </a>

                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
                <div class="card border-dark rounded-0 h-100">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <span>Wishlist Items</span>
                            <i class="bi bi-heart fs-4"></i>
                        </div>

                        <h3 class="fw-bold mt-3">{{ $wishlistItems }}</h3>

                        <a href="wishlist.html" class="text-dark">
                            View Wishlist
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Orders -->
        <div class="card border-dark rounded-0 mb-4">

            <div class="card-header bg-white border-dark py-3">
                <div class="d-flex justify-content-between align-items-center gap-2">

                    <h5 class="fw-bold mb-0">Recent Orders</h5>

                    <a href="{{ route('user.orders') }}" class="btn btn-sm btn-outline-dark">
                        View All
                    </a>

                </div>
            </div>

            <div class="table-responsive">

                <table class="table table-hover align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($recentOrders as $order)

                            <tr>

                                <td>
                                    #ORD{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                                </td>

                                <td>
                                    {{ $order->created_at->format('d M Y') }}
                                </td>

                                <td>
                                    ৳{{ number_format($order->total, 2) }}
                                </td>

                                <td>

                                    @if($order->order_status == 'delivered')

                                        <span class="badge bg-dark text-white">
                                            Delivered
                                        </span>

                                    @elseif($order->order_status == 'processing')

                                        <span class="badge bg-white text-dark border border-dark">
                                            Processing
                                        </span>

                                    @elseif($order->order_status == 'pending')

                                        <span class="badge bg-white text-dark border border-dark">
                                            Pending
                                        </span>

                                    @elseif($order->order_status == 'cancelled')

                                        <span class="badge bg-white text-dark border border-dark">
                                            Cancelled
                                        </span>

                                    @else

                                        <span class="badge bg-white text-dark border border-dark">
                                            {{ ucfirst($order->order_status) }}
                                        </span>

                                    @endif

                                </td>

                                <td>
                                    <a href="{{ route('user.orders.show', $order->id) }}"
                                       class="btn btn-sm btn-outline-dark">
                                        Details
                                    </a>
                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    No orders found!
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>
        </div>

        <!-- Account Information -->


        <!-- Quick Links -->
        <div class="card border-dark rounded-0">

            <div class="card-body">

                <h5 class="fw-bold mb-3">Quick Links</h5>

                <div class="d-flex flex-wrap gap-2">

                    <a href="{{ route('product') }}" class="btn btn-dark">
                        <i class="bi bi-shop me-2"></i>
                        Continue Shopping
                    </a>

                    <a href="{{ route('user.orders') }}" class="btn btn-outline-dark">
                        <i class="bi bi-box-seam me-2"></i>
                        My Orders
                    </a>

                    <a href="wishlist.html" class="btn btn-outline-dark">
                        <i class="bi bi-heart me-2"></i>
                        Wishlist
                    </a>

                    <a href="settings.html" class="btn btn-outline-dark">
                        <i class="bi bi-gear me-2"></i>
                        Settings
                    </a>

                </div>

            </div>
        </div>

    </main>

@endsection
