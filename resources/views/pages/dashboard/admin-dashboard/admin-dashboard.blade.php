
@extends('layout.admin-layout')

@section('content')

    <!-- Dashboard Content -->
    <main class="col-lg-10 col-md-9 bg-white text-dark p-3 p-lg-4 container-fluid mx-auto">

        <!-- Page Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1">Dashboard</h3>
                <p class="mb-0">Welcome back, Admin!</p>
            </div>

           

        </div>

        <!-- Statistics -->
        <div class="row g-3 mb-4">

            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white text-dark border-dark rounded-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Sales</span>
                            <i class="bi bi-currency-dollar fs-4"></i>
                        </div>
                        <h3 class="fw-bold mt-3">৳{{ number_format($totalSales, 2) }}</h3>
                        <p class="mb-0">Total sales amount</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white text-dark border-dark rounded-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Orders</span>
                            <i class="bi bi-cart3 fs-4"></i>
                        </div>
                        <h3 class="fw-bold mt-3">{{ $totalOrders }}</h3>
                        <p class="mb-0">Total orders received</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white text-dark border-dark rounded-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Products</span>
                            <i class="bi bi-box-seam fs-4"></i>
                        </div>
                        <h3 class="fw-bold mt-3">{{ $totalProducts }}</h3>
                        <p class="mb-0">Available products</p>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6">
                <div class="card bg-white text-dark border-dark rounded-0 h-100">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>Total Users</span>
                            <i class="bi bi-people fs-4"></i>
                        </div>
                        <h3 class="fw-bold mt-3">{{ $totalUsers }}</h3>
                        <p class="mb-0">Registered users</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Sales Overview and Order Summary -->
        <div class="row g-3 mb-4">

            <div class="col-lg-8">
                <div class="card bg-white text-dark border-dark rounded-0 h-100">

                    <div class="card-header bg-white border-dark py-3">
                        <h5 class="fw-bold mb-0">Sales Overview</h5>
                    </div>

                    <div class="card-body">

                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">

                            <div>
                                <p class="mb-1">Total Revenue</p>
                                <h3 class="fw-bold">৳{{ number_format($totalSales, 2) }}</h3>
                            </div>

                            <!-- Period Dropdown -->
                            <details class="position-relative">
                                <summary class="btn btn-outline-dark">
                                    This Month
                                </summary>

                                <div class="position-absolute end-0 bg-white border border-dark mt-2 p-2"
                                     style="min-width: 150px; z-index: 1000;">

                                    <a href="#" class="d-block text-dark text-decoration-none p-2">Today</a>
                                    <a href="#" class="d-block text-dark text-decoration-none p-2">This Week</a>
                                    <a href="#" class="d-block text-dark text-decoration-none p-2">This Month</a>
                                    <a href="#" class="d-block text-dark text-decoration-none p-2">This Year</a>

                                </div>
                            </details>

                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered text-dark align-middle mb-0">

                                <thead class="table-light">
                                    <tr>
                                        <th>Period</th>
                                        <th>Orders</th>
                                        <th>Sales</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>All Time</td>
                                        <td>{{ $totalOrders }}</td>
                                        <td>৳{{ number_format($totalSales, 2) }}</td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <div class="card bg-white text-dark border-dark rounded-0 h-100">

                    <div class="card-header bg-white border-dark py-3">
                        <h5 class="fw-bold mb-0">Order Summary</h5>
                    </div>

                    <div class="card-body">

                        <div class="d-flex justify-content-between border-bottom py-3">
                            <span>Pending Orders</span>
                            <strong>{{ $pendingOrders }}</strong>
                        </div>

                        <div class="d-flex justify-content-between border-bottom py-3">
                            <span>Processing</span>
                            <strong>{{ $processingOrders }}</strong>
                        </div>

                        <div class="d-flex justify-content-between border-bottom py-3">
                            <span>Completed</span>
                            <strong>{{ $completedOrders }}</strong>
                        </div>

                        <div class="d-flex justify-content-between border-bottom py-3">
                            <span>Cancelled</span>
                            <strong>{{ $cancelledOrders }}</strong>
                        </div>

                        <a href="{{ route('order.list', 'all') }}" class="btn btn-outline-dark w-100 mt-3">
                            View All Orders
                        </a>

                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Orders -->
        <div class="card bg-white text-dark border-dark rounded-0 mb-4">

            <div class="card-header bg-white border-dark py-3">
                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="fw-bold mb-0">Recent Orders</h5>

                    <a href="{{ route('order.list', 'all') }}" class="btn btn-sm btn-outline-dark">
                        View All
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover text-dark align-middle mb-0">

                    <thead class="table-light">
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($recentOrders as $item)

                            <tr>
                                <td>#{{ $item->id }}</td>

                                <td>
                                    {{ $item->first_name }} {{ $item->last_name }}
                                </td>

                                <td>
                                    {{ $item->created_at->format('d M Y') }}
                                </td>

                                <td>
                                    ৳{{ number_format($item->total, 2) }}
                                </td>

                                <td>
                                    @if ($item->order_status == 'pending')

                                        <span class="badge bg-white text-dark border border-dark">
                                            Pending
                                        </span>

                                    @elseif ($item->order_status == 'processing')

                                        <span class="badge bg-dark text-white">
                                            Processing
                                        </span>

                                    @elseif ($item->order_status == 'shipped')

                                        <span class="badge bg-white text-dark border border-dark">
                                            Shipped
                                        </span>

                                    @elseif ($item->order_status == 'delivered')

                                        <span class="badge bg-dark text-white">
                                            Delivered
                                        </span>

                                    @elseif ($item->order_status == 'cancelled')

                                        <span class="badge bg-white text-dark border border-dark">
                                            Cancelled
                                        </span>

                                    @else

                                        <span class="badge bg-white text-dark border border-dark">
                                            {{ ucfirst($item->order_status ?? 'Unknown') }}
                                        </span>

                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('order.details', $item->id) }}"
                                        class="btn btn-sm btn-outline-dark">
                                        View
                                    </a>
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    No Orders Found
                                </td>
                            </tr>

                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card bg-white text-dark border-dark rounded-0">

            <div class="card-body">

                <h5 class="fw-bold mb-3">Quick Actions</h5>

                <div class="d-flex flex-wrap gap-2">

                    <a href="#" class="btn btn-dark">
                        <i class="bi bi-plus-lg me-2"></i>
                        Add Product
                    </a>

                    <a href="#" class="btn btn-outline-dark">
                        <i class="bi bi-cart-plus me-2"></i>
                        Create Order
                    </a>

                    <a href="#" class="btn btn-outline-dark">
                        <i class="bi bi-person-plus me-2"></i>
                        Add Customer
                    </a>

                    <a href="#" class="btn btn-outline-dark">
                        <i class="bi bi-file-earmark-text me-2"></i>
                        Reports
                    </a>

                    <a href="#" class="btn btn-outline-dark">
                        <i class="bi bi-gear me-2"></i>
                        Settings
                    </a>

                </div>

            </div>
        </div>

        <!-- Footer -->
        <footer class="text-center text-dark py-4">
            <small>© 2026 Admin Panel. All rights reserved.</small>
        </footer>

    </main>

@endsection
