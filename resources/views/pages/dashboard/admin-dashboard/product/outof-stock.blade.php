
@extends('layout.admin-layout')

@section('content')

    <div class="container-fluid p-3 p-lg-4">

        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-box-seam me-2"></i>
                    Out of Stock Products
                </h4>

                <p class="text-secondary mb-0">
                    Manage all out of stock products
                </p>
            </div>

            <a href="{{ route('add.product') }}" class="btn btn-dark">
                <i class="bi bi-plus-lg me-2"></i>
                Add New Product
            </a>

        </div>

        <!-- Product Statistics -->
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary mb-1">Total Products</p>
                                <h4 class="fw-bold mb-0">
                                    {{ \App\Models\Products::count() }}
                                </h4>
                            </div>
                            <i class="bi bi-box-seam fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary mb-1">Out of Stock</p>
                                <h4 class="fw-bold mb-0">
                                    {{ \App\Models\Products::where('quantity', 0)->count() }}
                                </h4>
                            </div>
                            <i class="bi bi-x-circle fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary mb-1">Active Products</p>
                                <h4 class="fw-bold mb-0">
                                    {{ \App\Models\Products::where('quantity', 0)->where('status', 'active')->count() }}
                                </h4>
                            </div>
                            <i class="bi bi-check-circle fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card border shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="text-secondary mb-1">Inactive Products</p>
                                <h4 class="fw-bold mb-0">
                                    {{ \App\Models\Products::where('quantity', 0)->where('status', 'inactive')->count() }}
                                </h4>
                            </div>
                            <i class="bi bi-grid fs-2"></i>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Products Table -->
        <div class="card border shadow-sm">

            <div class="card-header bg-white py-3">

                <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">

                    <h6 class="fw-bold mb-0">
                        <i class="bi bi-list-ul me-2"></i>
                        Out of Stock Products
                    </h6>

                    <span class="badge bg-dark">
                        {{ $product->count() }} Products
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="ps-3">#</th>
                                <th>Product</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Quantity</th>
                                <th>Status</th>
                                <th class="text-end pe-3">Action</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($product as $key => $item)

                                <tr>

                                    <td class="ps-3">
                                        {{ $key + 1 }}
                                    </td>

                                    <!-- Product -->
                                    <td>

                                        <div class="d-flex align-items-center gap-2">

                                            <img src="{{ asset('storage/' . $item->product_image) }}"
                                                alt="{{ $item->title }}"
                                                width="50"
                                                height="50"
                                                class="rounded border">

                                            <span class="fw-semibold">
                                                {{ $item->title }}
                                            </span>

                                        </div>

                                    </td>

                                    <!-- Category -->
                                    <td>
                                        {{ $item->category }}
                                    </td>

                                    <!-- Price -->
                                    <td>
                                        <span class="fw-semibold">
                                            ৳{{ number_format($item->price, 2) }}
                                        </span>
                                    </td>

                                    <!-- Discount Price -->
                                    <td>
                                        @if($item->discount_price)
                                            ৳{{ number_format($item->discount_price, 2) }}
                                        @else
                                            <span class="text-secondary">N/A</span>
                                        @endif
                                    </td>

                                    <!-- Quantity -->
                                    <td>
                                        <span class="badge bg-danger">
                                            {{ $item->quantity }} - Out of Stock
                                        </span>
                                    </td>

                                    <!-- Status -->
                                    <td>

                                        @if($item->status == 'active')

                                            <span class="badge bg-dark">
                                                Active
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                Inactive
                                            </span>

                                        @endif

                                    </td>

                                    <!-- Action -->
                                    <td class="text-end pe-3">

                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('product.edit', $item->id) }}"
                                                class="btn btn-sm btn-outline-dark">

                                                <i class="bi bi-pencil-square"></i>

                                            </a>

                                            <form action="{{ route('product.destroy', $item->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('Are you sure you want to delete this product?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-dark">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center py-5">

                                        <i class="bi bi-box-seam fs-1 text-secondary"></i>

                                        <h6 class="fw-bold mt-2">No Out of Stock Products Found</h6>

                                        <p class="text-secondary mb-3">
                                            All products currently have available stock.
                                        </p>

                                        <a href="{{ route('product.list') }}" class="btn btn-dark btn-sm">
                                            <i class="bi bi-list-ul me-1"></i>
                                            All Products
                                        </a>

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
