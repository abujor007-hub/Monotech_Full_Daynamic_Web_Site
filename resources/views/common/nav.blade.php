<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <title>Home | MONOTECH</title>
    <meta name="description" content="MONOTECH computer components and electronics store." />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />

    <style>
        .account-dropdown {
            position: relative;
        }

        .account-dropdown summary {
            list-style: none;
            cursor: pointer;
        }

        .account-dropdown summary::-webkit-details-marker {
            display: none;
        }

        .account-dropdown .account-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            z-index: 1050;
            min-width: 230px;
            background: #fff;
        }

        .account-dropdown[open] .account-menu {
            display: block;
        }
    </style>
</head>

<body>
    {{-- Cart data ekdom uporey, jate header badge o ei value pay --}}
    @php
        $cart = session()->get('cart', []);

        $totalItems = collect($cart)->sum('quantity');

        $subtotal = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    @endphp

    @include('alart.message')
    <!-- Announcement -->
    <div class="bg-black text-white text-center small py-2 px-3">
        Free shipping on orders over ৳5,000 · Computer parts, made simple
    </div>

    <!-- Header -->
    <header class="bg-white border-bottom sticky-top">

        <div class="container">

            <div class="d-flex align-items-center gap-3 py-3">

                <!-- Mobile Menu Button -->
                <button class="btn btn-outline-dark rounded-0 d-lg-none flex-shrink-0" type="button"
                    data-bs-toggle="offcanvas" data-bs-target="#mobileDrawer" aria-controls="mobileDrawer">

                    <i class="bi bi-list fs-5"></i>

                </button>

                <!-- Brand -->
                <a href="/" class="text-decoration-none text-black flex-shrink-0 d-flex flex-column lh-1">

                    <span class="d-flex align-items-center gap-2 fw-bolder fs-5">

                        <span
                            class="bg-black text-white d-inline-flex align-items-center justify-content-center fw-bold"
                            style="width:32px;height:32px;">
                            M
                        </span>

                        MONOTECH

                    </span>

                    <small class="text-secondary d-none d-sm-block mt-1" style="font-size:.6rem;letter-spacing:.12em;">
                        COMPUTER PARTS &amp; ELECTRONICS
                    </small>

                </a>

                <form id="productSearchForm"
                    class="d-none d-md-flex flex-grow-1 mx-lg-4 border position-relative align-items-center"
                    action="/products" method="GET" role="search">

                    <i class="bi bi-search position-absolute ms-3 text-secondary"></i>

                    <input type="search" name="q" id="productSearch"
                        class="form-control border-0 rounded-0 shadow-none ps-5"
                        placeholder="Search RAM, monitor, CPU..." aria-label="Search products" autocomplete="off">

                    <button class="btn btn-dark rounded-0 px-3" type="submit">
                        Search
                    </button>

                    <div id="searchResults" class="position-absolute w-100 bg-white border shadow-sm"
                        style="top:100%; left:0; z-index:1050; max-height:350px; overflow-y:auto;"></div>
                </form>

                <!-- Actions -->
                <div class="d-flex gap-2 ms-auto">

                    <!-- Account Dropdown Without JavaScript -->
                    <details class="account-dropdown">

                        <summary class="btn btn-outline-dark rounded-0" title="Account">

                            <i class="bi bi-person"></i>

                        </summary>

                        <div class="account-menu border rounded-0 shadow-sm">

                            <div class="px-3 py-3 border-bottom bg-light d-flex flex-column">

                                <strong>
                                    @auth
                                        {{ auth()->user()->name }}
                                    @else
                                        My Account
                                    @endauth
                                </strong>

                                <small class="text-secondary">
                                    Welcome to MONOTECH
                                </small>

                            </div>

                            @guest

                                <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="/login">

                                    <i class="bi bi-box-arrow-in-right"></i>
                                    <span>Login</span>

                                </a>

                                <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="/register">

                                    <i class="bi bi-person-plus"></i>
                                    <span>Register</span>

                                </a>

                            @else

                                <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="/dashboard">

                                    <i class="bi bi-person-circle"></i>
                                    <span>My Dashboard</span>

                                </a>

                                <form method="POST" action="/logout">

                                    @csrf

                                    <button type="submit" class="dropdown-item py-2 d-flex align-items-center gap-2">

                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Logout</span>

                                    </button>

                                </form>

                            @endguest

                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="/wishlist">

                                <i class="bi bi-heart"></i>
                                <span>Wishlist</span>

                                <span class="badge bg-black rounded-pill ms-auto">0</span>

                            </a>

                        </div>

                    </details>

                    <!-- Cart Button -->
                    <button class="btn btn-outline-dark rounded-0 position-relative" type="button"
                        data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas" aria-controls="cartOffcanvas">

                        <i class="bi bi-bag"></i>

                        <span
                            class="js-cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-black">
                            {{ $totalItems }}
                        </span>

                    </button>

                </div>

            </div>

            <!-- Mobile Search -->
            <form class="d-md-none mb-3 border d-flex position-relative align-items-center" action="/products"
                method="GET" role="search">

                <i class="bi bi-search position-absolute ms-3 text-secondary"></i>

                <input type="search" name="q" class="form-control border-0 rounded-0 shadow-none ps-5"
                    placeholder="Search computer parts..." aria-label="Search products">

                <button class="btn btn-dark rounded-0 px-3" type="submit">
                    <i class="bi bi-arrow-right"></i>
                </button>

            </form>

        </div>

        <!-- Desktop Navbar -->
        <nav class="d-none d-lg-block border-top" aria-label="Main navigation">

            <div class="container">

                <ul class="nav justify-content-center">

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('index') }}">
                            Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('product') }}">
                            Products
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('about') }}">
                            About
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-dark fw-semibold" href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>

                </ul>

            </div>

        </nav>

    </header>

    <!-- Mobile Drawer -->
    <div class="offcanvas offcanvas-start bg-white text-black" tabindex="-1" id="mobileDrawer"
        aria-labelledby="mobileDrawerLabel" style="--bs-offcanvas-width:300px;">

        <!-- Drawer Header -->
        <div class="offcanvas-header align-items-start px-3 py-4 border-bottom">

            <div>

                <a href="/" id="mobileDrawerLabel"
                    class="text-decoration-none text-black d-flex align-items-center gap-2 fw-bolder fs-5">

                    <span class="bg-black text-white d-inline-flex align-items-center justify-content-center fw-bold"
                        style="width:32px;height:32px;">
                        M
                    </span>

                    MONOTECH

                </a>

                <p class="small text-secondary mt-3 mb-0">
                    Precision parts. Better performance.
                </p>

            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close menu">
            </button>

        </div>

        <!-- Drawer Body -->
        <div class="offcanvas-body p-0">

            <div class="small text-secondary px-3 pt-4 pb-2" style="letter-spacing:.12em;">
                MENU
            </div>

            <div class="list-group list-group-flush rounded-0">

                <a href="/" class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                    <i class="bi bi-house fs-5"></i>
                    <span>Home</span>

                </a>

                <a href="/products"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                    <i class="bi bi-grid fs-5"></i>
                    <span>Products</span>

                </a>

                <a href="/about"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                    <i class="bi bi-info-circle fs-5"></i>
                    <span>About</span>

                </a>

                <a href="/contact"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                    <i class="bi bi-envelope fs-5"></i>
                    <span>Contact</span>

                </a>

            </div>

            <div class="small text-secondary px-3 pt-4 pb-2" style="letter-spacing:.12em;">
                ACCOUNT
            </div>

            <div class="list-group list-group-flush rounded-0">

                @guest

                    <a href="/login"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                        <i class="bi bi-box-arrow-in-right fs-5"></i>
                        <span>Login</span>

                    </a>

                    <a href="/register"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                        <i class="bi bi-person-plus fs-5"></i>
                        <span>Register</span>

                    </a>

                @else

                    <a href="/dashboard"
                        class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                        <i class="bi bi-person-circle fs-5"></i>
                        <span>My Dashboard</span>

                    </a>

                    <form method="POST" action="/logout">

                        @csrf

                        <button type="submit"
                            class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3 w-100">

                            <i class="bi bi-box-arrow-right fs-5"></i>
                            <span>Logout</span>

                        </button>

                    </form>

                @endguest

                <a href="/wishlist"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                    <i class="bi bi-heart fs-5"></i>
                    <span>Wishlist</span>

                </a>

                <a href="/cart"
                    class="list-group-item list-group-item-action d-flex align-items-center gap-3 py-3 px-3">

                    <i class="bi bi-bag-check fs-5"></i>
                    <span>My Cart</span>

                </a>

            </div>

        </div>

    </div>


    <!-- Cart Offcanvas -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="cartOffcanvas" aria-labelledby="cartOffcanvasLabel">

        <div class="offcanvas-header border-bottom">

            <div>

                <h2 class="offcanvas-title h5 fw-bold mb-1" id="cartOffcanvasLabel">
                    Your cart
                </h2>

                <small class="text-secondary">
                    <span class="js-cart-count">{{ $totalItems }}</span> items
                </small>

            </div>

            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close cart">
            </button>

        </div>

        <div class="offcanvas-body d-flex flex-column">

            <div class="flex-grow-1" id="cart-items">

                @if(count($cart) > 0)

                    @foreach($cart as $item)

                        <div class="d-flex gap-3 border-bottom pb-3 mb-3" data-cart-item="{{ $item['id'] }}">

                            <div>

                                <img src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['title'] }}"
                                    style="width:85px; height:85px; object-fit:cover;">

                            </div>

                            <div class="flex-grow-1">

                                <strong class="d-block">
                                    {{ $item['title'] }}
                                </strong>

                                <small class="text-secondary">
                                    ৳{{ number_format($item['price']) }}
                                </small>

                                <div class="d-flex justify-content-between align-items-center mt-2">

                                    <!-- Quantity Buttons -->

                                    <div class="d-flex align-items-center border">

                                        <!-- Decrease -->
                                        <button type="button" class="btn btn-sm rounded-0 px-2 cart-quantity-btn"
                                            data-url="{{ route('cart.decrease', $item['id']) }}"
                                            data-token="{{ csrf_token() }}">

                                            <i class="bi bi-dash"></i>

                                        </button>

                                        <!-- Quantity -->
                                        <span class="px-2 small fw-semibold js-qty">{{ $item['quantity'] }}</span>

                                        <!-- Increase -->
                                        <button type="button" class="btn btn-sm rounded-0 px-2 cart-quantity-btn"
                                            data-url="{{ route('cart.increase', $item['id']) }}"
                                            data-token="{{ csrf_token() }}">

                                            <i class="bi bi-plus"></i>

                                        </button>

                                    </div>

                                    <!-- Remove -->
                                    <a href="{{ route('cart.remove', $item['id']) }}" type="button"
                                        class="btn btn-sm btn-outline-danger cart-remove-btn" ">

                                                <i class=" bi bi-trash"></i>

                                    </a>

                                    <!-- Product Total -->
                                    <strong class="js-line-total">
                                        ৳{{ number_format($item['price'] * $item['quantity']) }}
                                    </strong>

                                </div>

                            </div>

                        </div>

                    @endforeach

                @else

                    <!-- Empty Cart -->

                    <div class="text-center py-5" id="empty-cart">

                        <i class="bi bi-bag fs-1 d-block mb-3"></i>

                        <strong>Your cart is empty</strong>

                        <p class="text-secondary small mt-2">
                            Add a product and it will appear here.
                        </p>

                        <a href="/products" class="btn btn-dark rounded-0 mt-2">
                            Shop products
                        </a>

                    </div>

                @endif

            </div>

            <!-- Cart Footer -->

            <div class="border-top pt-3 mt-3">

                <div class="d-flex justify-content-between align-items-center mb-3">

                    <span class="text-secondary">
                        Subtotal
                    </span>

                    <strong class="js-cart-subtotal">
                        ৳{{ number_format($subtotal) }}
                    </strong>

                </div>

                <a href="/checkout" class="btn btn-dark rounded-0 d-block w-100 mb-2">
                    View cart &amp; checkout
                </a>

                <a href="{{ route('product') }}" class="btn btn-outline-dark rounded-0 w-100">
                    Continue shopping
                </a>

            </div>

        </div>

    </div>


    <!-- AJAX Cart Script -->
    <script src="{{ asset('js/script.js') }}"></script>


    <!-- Bootstrap JS: Only for Mobile Drawer and Cart Offcanvas -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('productSearch');
            const searchForm = document.getElementById('productSearchForm');
            const searchResults = document.getElementById('searchResults');

            if (!searchInput || !searchForm || !searchResults) return;

            const detailsUrl = "{{ url('product-details') }}";
            const searchUrl = "{{ route('product.live.search') }}";
            let timer;

            const esc = s => String(s).replace(/[&<>"']/g, c =>
                ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

            // Enter chaple search page-e jabe na
            searchForm.addEventListener('submit', function (e) {
                e.preventDefault();
            });

            searchInput.addEventListener('input', function () {
                clearTimeout(timer);
                const search = this.value.trim();

                if (search.length === 0) {
                    searchResults.innerHTML = '';
                    return;
                }

                timer = setTimeout(function () {
                    fetch(`${searchUrl}?search=${encodeURIComponent(search)}`, {
                        headers: { 'Accept': 'application/json' }
                    })
                        .then(res => res.json())
                        .then(function (products) {

                            if (products.length === 0) {
                                searchResults.innerHTML =
                                    '<div class="p-2 text-muted small">No product found</div>';
                                return;
                            }

                            searchResults.innerHTML = products.map(p => `
                    <a href="${detailsUrl}/${p.id}"
       class="d-flex align-items-center gap-3 text-decoration-none text-dark border-bottom p-2 w-20">

        <img src="{{ asset('storage') }}/${encodeURIComponent(p.product_image || '')}"
             alt="${esc(p.title)}"
             width="60"
             height="60"
             class="border rounded"
             style="object-fit:contain;">

        <div class="flex-grow-1">

            <div class="fw-semibold">
                ${esc(p.title)}
            </div>

            <small class="text-success fw-bold">
                ৳${esc(p.price)}
            </small>

        </div>

        <i class="bi bi-chevron-right text-secondary"></i>

    </a>
                `).join('');
                        })
                        .catch(err => console.error('Live Search Error:', err));
                }, 250);
            });

            document.addEventListener('click', function (e) {
                if (!searchForm.contains(e.target)) {
                    searchResults.innerHTML = '';
                }
            });
        });
    </script>

</body>

</html>