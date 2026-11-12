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
                    Add a new product to your store
                </p>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-outline-dark">
                <i class="bi bi-arrow-left me-2"></i>
                Back to Products
            </a>

        </div>

        <!-- Add Product Form -->
        <div class="card border shadow-sm">

            <div class="card-header bg-white py-3">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add New Product
                </h6>

            </div>

            <div class="card-body">

                <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row g-3">

                        <!-- Product Title -->
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Product Title
                            </label>

                            <input type="text" name="title" class="form-control" placeholder="Enter product title" required>

                        </div>

                        <!-- Category -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Category
                            </label>

                            <select name="category" class="form-select" required>

                                @foreach ($category as $item)

                                    <option value="{{ $item->Category }}" {{ old('category') == $item->Category ? 'selected' : '' }}>

                                        {{ $item->Category }}

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

                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                                <option value="inactive">In Stock</option>
                                <option value="inactive">Out of Stock</option>

                            </select>

                        </div>

                        <!-- Price -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Regular Price
                            </label>

                            <input type="number" name="price" class="form-control" placeholder="Enter regular price" min="0"
                                step="0.01" required>

                        </div>

                        <!-- Discount Price -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Discount Price
                            </label>

                            <input type="number" name="discount_price" class="form-control"
                                placeholder="Enter discount price" min="0" step="0.01">

                        </div>

                        <!-- Quantity -->
                        <div class="col-12 col-md-6">

                            <label class="form-label fw-semibold">
                                Quantity
                            </label>

                            <input type="number" name="quantity" class="form-control" placeholder="Enter product quantity"
                                min="0" required>

                        </div>

                        <!-- Product Image -->
                        <div class="col-12 col-md-6">


                            <img id="prevImage" src="" alt="Product" width="100" height="100" class="rounded border mb-2"
                                style="object-fit:cover;">

                            <label class="form-label fw-semibold">
                                Product Image
                            </label>

                            <input type="file" name="product_image" class="form-control" accept="image/*" required
                                oninput="prevImage.src=window.URL.createObjectURL(this.files[0])">

                        </div>

                        <!-- Description -->
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Product Description
                            </label>

                            <textarea name="description" class="form-control" rows="5"
                                placeholder="Enter product description"></textarea>

                        </div>

                    </div>

                    <!-- Buttons -->
                    <div class="d-flex flex-wrap gap-2 mt-4">

                        <button type="submit" class="btn btn-dark px-4">

                            <i class="bi bi-plus-circle me-2"></i>
                            Add Product

                        </button>

                        <button type="reset" class="btn btn-outline-dark px-4">

                            <i class="bi bi-arrow-counterclockwise me-2"></i>
                            Reset

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection