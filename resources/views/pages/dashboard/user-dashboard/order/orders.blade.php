
@extends('layout.user-dayout')

@section('content')

<main class="col">

    {{-- Page Header --}}
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">My Orders</h3>
            <p class="text-secondary mb-0 small">
                Manage and track your recent purchases.
            </p>
        </div>

        <a href="{{ route('user.orders') }}" class="btn btn-outline-dark rounded-0 btn-sm">
            <i class="bi bi-arrow-clockwise me-1"></i> Refresh Orders
        </a>

    </div>

    {{-- Overview Cards --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-4 col-sm-6">
            <div class="card border-dark rounded-0 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Total Orders</span>
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>

                    <h3 class="fw-bold mt-3 mb-0">
                        {{ \App\Models\Order::where('user_id', auth()->id())->count() }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card border-dark rounded-0 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Pending Orders</span>
                        <i class="bi bi-clock-history fs-4"></i>
                    </div>

                    <h3 class="fw-bold mt-3 mb-0">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('order_status', 'pending')->count() }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card border-dark rounded-0 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Processing Orders</span>
                        <i class="bi bi-arrow-repeat fs-4"></i>
                    </div>

                    <h3 class="fw-bold mt-3 mb-0">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('order_status', 'processing')->count() }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card border-dark rounded-0 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Shipped Orders</span>
                        <i class="bi bi-truck fs-4"></i>
                    </div>

                    <h3 class="fw-bold mt-3 mb-0">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('order_status', 'shipped')->count() }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card border-dark rounded-0 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Delivered Orders</span>
                        <i class="bi bi-check-circle fs-4"></i>
                    </div>

                    <h3 class="fw-bold mt-3 mb-0">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('order_status', 'delivered')->count() }}
                    </h3>

                </div>
            </div>
        </div>

        <div class="col-xl-4 col-sm-6">
            <div class="card border-dark rounded-0 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">
                        <span>Cancelled Orders</span>
                        <i class="bi bi-x-circle fs-4"></i>
                    </div>

                    <h3 class="fw-bold mt-3 mb-0">
                        {{ \App\Models\Order::where('user_id', auth()->id())->where('order_status', 'cancelled')->count() }}
                    </h3>

                </div>
            </div>
        </div>

    </div>

    {{-- Orders Table --}}
    <div class="card border-dark rounded-0 mb-4">

        <div class="card-header bg-white border-dark py-3">

            <div class="d-flex justify-content-between align-items-center">
                <h5 class="fw-bold mb-0">Order History</h5>

                <span class="text-secondary small">
                    {{ $orders->total() }} Orders
                </span>
            </div>

        </div>

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th class="ps-3">Order ID</th>
                        <th>Date</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse ($orders as $order)

                        <tr>

                            <td class="ps-3 fw-semibold">
                                #ORD{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}
                            </td>

                            <td>
                                {{ $order->created_at->format('d M Y') }}
                            </td>

                            <td>
                                {{ $order->items->sum('quantity') }}
                            </td>

                            <td class="fw-semibold">
                                ৳{{ number_format($order->total, 2) }}
                            </td>

                            <td class="text-uppercase small">
                                {{ $order->payment_method }}
                            </td>

                            <td>

                                @if ($order->order_status == 'delivered')

                                    <span class="badge bg-dark text-white rounded-0">
                                        Delivered
                                    </span>

                                @elseif ($order->order_status == 'pending')

                                    <span class="badge bg-white text-dark border border-dark rounded-0">
                                        Pending
                                    </span>

                                @elseif ($order->order_status == 'processing')

                                    <span class="badge bg-secondary text-white rounded-0">
                                        Processing
                                    </span>

                                @elseif ($order->order_status == 'shipped')

                                    <span class="badge bg-white text-dark border border-dark rounded-0">
                                        Shipped
                                    </span>

                                @elseif ($order->order_status == 'cancelled')

                                    <span class="badge bg-white text-danger border border-danger rounded-0">
                                        Cancelled
                                    </span>

                                @else

                                    <span class="badge bg-white text-dark border border-dark rounded-0">
                                        {{ ucfirst($order->order_status) }}
                                    </span>

                                @endif

                            </td>

                            <td>
                                <a href="{{ route('user.orders.show', $order->id) }}"
                                    class="btn btn-sm btn-outline-dark rounded-0">
                                    Details
                                </a>
                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-5">

                                <i class="bi bi-box-seam fs-1 text-secondary"></i>

                                <h5 class="fw-bold mt-3">No Orders Found</h5>

                                <p class="text-secondary small mb-3">
                                    You haven't placed any orders yet.
                                </p>

                                <a href="{{ route('shop.page') }}" class="btn btn-dark rounded-0">
                                    <i class="bi bi-shop me-2"></i>
                                    Start Shopping
                                </a>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

        {{-- Pagination --}}
        @if ($orders->hasPages())

            <div class="card-footer bg-white border-top border-dark py-3">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

    {{-- Quick Links --}}
    <div class="card border-dark rounded-0">

        <div class="card-body">

            <h5 class="fw-bold mb-3">Quick Links</h5>

            <div class="d-flex flex-wrap gap-2">

                <a href="{{ route('product') }}" class="btn btn-dark rounded-0">
                    <i class="bi bi-shop me-2"></i>
                    Continue Shopping
                </a>

                <a href="{{ route('user.orders') }}" class="btn btn-outline-dark rounded-0">
                    <i class="bi bi-box-seam me-2"></i>
                    My Orders
                </a>

            </div>

        </div>

    </div>

</main>

@endsection
