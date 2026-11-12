<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Dashboard</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
</head>

@php
    $messageCount = \App\Models\ContactMessage::count();
@endphp

<body class="bg-white text-dark">

    <!-- Navbar -->
    <nav class="navbar bg-white border-bottom sticky-top">
        <div class="container-fluid px-3 px-lg-4">

            <a href="{{ route('dashboard') }}" class="navbar-brand fw-bold text-dark">
                <i class="bi bi-grid-1x2-fill me-2"></i>
                ADMIN PANEL
            </a>

            <div class="d-flex align-items-center gap-3">

                <a href="#" class="text-dark fs-5">
                    <i class="bi bi-bell"></i>
                </a>

                <!-- Account Dropdown -->
                <details class="position-relative">

                    <summary class="btn btn-outline-dark list-unstyled">
                        <i class="bi bi-person-circle me-1"></i>
                        Account
                    </summary>

                    <div class="position-absolute end-0 bg-white border mt-2 p-2"
                        style="min-width: 180px; z-index: 1050;">

                        <a href="{{ route('admin.profile') }}" class="d-block text-dark text-decoration-none p-2">
                            <i class="bi bi-person me-2"></i>
                            My Profile
                        </a>

                        <a href="#" class="d-block text-dark text-decoration-none p-2">
                            <i class="bi bi-gear me-2"></i>
                            Settings
                        </a>

                        <hr class="my-1">

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="d-block w-100 text-start text-dark p-2 border-0 bg-white">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </button>
                        </form>

                    </div>

                </details>

            </div>
        </div>
    </nav>


    <!-- Main Layout -->
    <div class="container-fluid mx-auto">
        <div class="row">

            <!-- Sidebar -->
            <aside class="col-12 col-md-3 col-lg-2 bg-white text-dark border-end min-vh-100 p-3">

                <p class="small fw-bold mt-2 mb-3">MAIN MENU</p>

                <a href="{{ route('dashboard') }}" class="d-block text-dark rounded p-2 mb-2 text-decoration-none">

                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard

                </a>

                <a href="{{ route('category') }}" class="d-block text-dark rounded p-2 mb-2 text-decoration-none">

                    <i class="bi bi-grid me-2"></i>
                    Category

                </a>

                <a href="{{ route('admin.category-slider') }}"
                    class="d-flex align-items-center text-dark rounded p-2 mb-2 text-decoration-none">

                    <i class="bi bi-images me-2"></i>
                    Category Slider

                </a>


                <!-- Products -->
                <details class="mb-2">

                    <summary class="p-2">
                        <i class="bi bi-box-seam me-2"></i>
                        Products
                    </summary>

                    <div class="ps-4 mt-2">

                        <a href="{{ route('add.product') }}" class="d-block text-dark text-decoration-none p-2">
                            Add Product
                        </a>


                        <a href="{{ route('product.list') }}" class="d-block text-dark text-decoration-none p-2">
                            All Products
                        </a>


                        <a href="{{ route('category') }}"
                            class="d-block text-dark rounded p-2 mb-2 text-decoration-none">

                     
                            Category

                        </a>

                        <a href="{{ route('product.outofstock') }}" class="d-block text-dark text-decoration-none p-2">
                            Stock Management
                        </a>

                    </div>
                </details>


                <!-- Orders -->
                <details class="mb-2">

                    <summary class="p-2">
                        <i class="bi bi-cart3 me-2"></i>
                        Orders
                    </summary>

                    <div class="ps-4 mt-2">

                        <a href="{{ route('order.list') }}" class="d-block text-dark text-decoration-none p-2">
                            All Orders
                        </a>

                        <a href="{{ route('order.pending') }}" class="d-block text-dark text-decoration-none p-2">
                            Pending Orders
                        </a>

                        <a href="{{ route('order.processing') }}" class="d-block text-dark text-decoration-none p-2">
                            Processing
                        </a>

                        <a href="{{ route('order.shipped') }}" class="d-block text-dark text-decoration-none p-2">
                            Shipping
                        </a>

                        <a href="{{ route('order.delivered') }}" class="d-block text-dark text-decoration-none p-2">
                            Delivered
                        </a>

                        <a href="{{ route('order.cancelled') }}" class="d-block text-dark text-decoration-none p-2">
                            Cancelled
                        </a>

                    </div>
                </details>

                <a href="{{ route('admin.messages') }}"
                    class="d-flex align-items-center gap-2 text-dark rounded p-2 mb-2 text-decoration-none">

                    <span>
                        <i class="bi bi-chat-dots me-1"></i>
                        Message
                    </span>

                    @if($messageCount > 0)
                        <span class="badge bg-dark rounded-pill">
                            {{ $messageCount }}
                        </span>
                    @endif

                </a>

                <a href="{{ route('admin.users') }}"
                    class="d-flex align-items-center gap-2 text-dark rounded p-2 mb-2 text-decoration-none">

                    <i class="bi bi-people"></i>
                    Users

                </a>



                <!-- Settings -->
                <details class="mb-2">

                    <summary class="p-2">
                        <i class="bi bi-gear me-2"></i>
                        Settings
                    </summary>

                    <div class="ps-4 mt-2">

                        <a href="{{ route('admin.profile') }}" class="d-block text-dark text-decoration-none p-2">
                            Profile Settings
                        </a>

                        <a href="{{ route('admin.account.security') }}"
                            class="d-block text-dark text-decoration-none p-2">

                            <i class="bi bi-shield-lock me-2"></i>
                            Account Security

                        </a>

                    </div>
                </details>


                <hr>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf

                    <button type="submit" class="d-block w-100 text-start text-dark p-2 border-0 bg-white">

                        <i class="bi bi-box-arrow-right me-2"></i>
                        Logout

                    </button>
                </form>

            </aside>


            <!-- Right Side Content -->
            <main class="col-12 col-md-9 col-lg-10 p-0">

                @include('alart.message')

                @yield('content')

            </main>

        </div>
    </div>

</body>

</html>