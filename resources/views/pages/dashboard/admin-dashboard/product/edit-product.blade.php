@extends('layout.admin-layout')

@section('content')

    <div class="container-fluid p-3 p-lg-4">

        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    <i class="bi bi-box-seam me-2"></i>
                    Product Management
                </h4>

                <p class="text-secondary mb-0">
                    Update your existing product
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Products
            </a>

        </div>

        <!-- Edit Product Form -->
        <div class="card border shadow-sm">

            <div class="card-header bg-white py-3">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-pencil-square me-2"></i>
                    Edit Product
                </h6>

            </div>

            <div class="card-body">

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Product Title -->
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Product Title
                            </label>

                            <input type="text" name="title" class="form-control" value="{{ old('title', $product->title) }}"
                                placeholder="Enter product title" required>

                        </div>

                        <!-- Category -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Category
                            </label>

                            <select name="category" class="form-select" required>

                                @foreach ($category as $data)

                                    <option value="{{ $data->Category }}" {{ $data->Category == $product->category ? 'selected' : '' }}>

                                        {{ $data->Category }}

                                    </option>

                                @endforeach

                            </select>

                        </div>

                        <!-- Status -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Product Status
                            </label>

                            <select name="status" class="form-select" required>

                                <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="inactive" {{ old('status', $product->status) == 'inactive' ? 'selected' : '' }}>
                                    Inactive
                                </option>

                                <option value="in_stock" {{ old('status', $product->status) == 'in_stock' ? 'selected' : '' }}>
                                    In Stock
                                </option>

                                <option value="out_of_stock" {{ old('status', $product->status) == 'out_of_stock' ? 'selected' : '' }}>
                                    Out of Stock
                                </option>

                            </select>

                        </div>

                        <!-- Regular Price -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Regular Price
                            </label>

                            <input type="number" name="price" class="form-control"
                                value="{{ old('price', $product->price) }}" placeholder="Enter regular price" min="0"
                                step="0.01" required>

                        </div>

                        <!-- Discount Price -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Discount Price
                            </label>

                            <input type="number" name="discount_price" class="form-control"
                                value="{{ old('discount_price', $product->discount_price) }}"
                                placeholder="Enter discount price" min="0" step="0.01">

                        </div>

                        <!-- Quantity -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Quantity
                            </label>

                            <input type="number" name="quantity" class="form-control"
                                value="{{ old('quantity', $product->quantity) }}" placeholder="Enter product quantity"
                                min="0" required>

                        </div>

                        <!-- Product Image -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Product Image
                            </label>

                            <div class="mb-2">

                                <img id="prevImage"
                                    src="{{ $product->product_image ? asset('storage/' . $product->product_image) : '' }}"
                                    alt="Product" width="100" height="100" class="rounded border" style="object-fit:cover;">

                            </div>

                            <input type="file" name="product_image" class="form-control" accept="image/*"
                                onchange="if(this.files[0]) prevImage.src=window.URL.createObjectURL(this.files[0])">

                            <small class="text-secondary">
                                Leave empty to keep the existing image.
                            </small>

                        </div>

                        <!-- Description -->
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Product Description
                            </label>

                            <textarea name="description" class="form-control" rows="5"
                                placeholder="Enter product description">{{ old('description', $product->description) }}</textarea>

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex flex-wrap gap-2 mt-4">

                        <button type="submit" class="btn btn-dark px-4">

                            <i class="bi bi-check-circle me-2"></i>
                            Update Product

                        </button>

                        <a href="{{ route('dashboard') }}" class="btn btn-outline-dark px-4">

                            <i class="bi bi-arrow-left me-2"></i>
                            Cancel

                        </a>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection