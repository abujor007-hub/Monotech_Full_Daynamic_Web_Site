@extends('layout.admin-layout')

@section('content')

    <div class="container-fluid p-3 p-lg-4">

        <!-- Page Header -->
        <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    <i class="bi bi-grid me-2"></i>
                    Category Management
                </h4>

                <p class="text-secondary mb-0">
                    Manage your product categories
                </p>

            </div>

            <div>

                <span class="badge bg-dark fs-6">
                    <i class="bi bi-boxes me-1"></i>
                    Total Categories: {{ \App\Models\Category::count() }}
                </span>

            </div>

        </div>


        <!-- Add Category Form -->
        <div class="card border shadow-sm mb-4">

            <div class="card-header bg-white py-3">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add New Category
                </h6>

            </div>

            <div class="card-body">

                <form action="{{ route('category.store') }}" method="POST">

                    @csrf
                    @method("PUT")

                    <div class="row g-3 align-items-end">

                        <div class="col-12 col-md-9">

                            <label for="categoryName" class="form-label fw-semibold">
                                Category Name
                            </label>

                            <input type="text" name="Category" id="categoryName" class="form-control"
                                placeholder="Enter category name" required>

                        </div>

                        <div class="col-12 col-md-3">

                            <button type="submit" class="btn btn-dark w-100">

                                <i class="bi bi-plus-lg me-2"></i>
                                Add Category

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        <!-- Category Table -->
        <div class="card border shadow-sm">

            <div class="card-header bg-white py-3">

                <h6 class="fw-bold mb-0">
                    <i class="bi bi-list-ul me-2"></i>
                    All Categories
                </h6>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>

                                <th class="ps-3" width="80">#</th>

                                <th>Category Name</th>

                                <th class="text-end pe-3" width="150">
                                    Action
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach($category as $item)

                                <tr>

                                    <td class="ps-3"> {{ $loop->iteration }}</td>

                                    <td class="fw-semibold">{{ $item->Category }}</td>

                                    <td class="text-end pe-3">

                                        <form action="{{ route('category.destroy', $item->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this category?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-dark">
                                                <i class="bi bi-trash me-1"></i>
                                                Delete
                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach




                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection