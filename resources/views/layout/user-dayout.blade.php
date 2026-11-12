
@include('common.nav')

<!-- Main Content -->
<div class="container mx-auto ">

    <!-- Welcome Section -->
    <div class="mb-4">
        <h3 class="fw-bold">My Account</h3>
        <p class="mb-0">Welcome back, {{ auth()->user()->name }}</p>
    </div>

    <!-- Dashboard Layout -->
    <div class="d-flex align-items-start gap-4">

        <!-- User Sidebar -->
        <aside style="width: 280px; flex-shrink: 0; position: sticky; top: 20px;">

            <!-- User Profile Card -->
            <div class="card border-dark rounded-0 mb-3">

                <div class="card-body text-center p-4">

                    <div class="border border-dark rounded-circle d-inline-flex align-items-center justify-content-center mb-3"
                         style="width: 85px; height: 85px;">

                        <img src="{{ Auth::user()->avatar }}" alt="" style="clip-path: circle();">

                    </div>

                    <h5 class="fw-bold mb-1">{{ auth()->user()->name }}</h5>

                    <p class="mb-1">{{ auth()->user()->email }}</p>

                    <p class="mb-3">Customer since {{ auth()->user()->created_at->format('D M d Y') }}</p>

                    <a href="{{ route('userprofile.edit') }}" class="btn btn-outline-dark w-100">
                        <i class="bi bi-pencil me-2"></i>
                        Edit Profile
                    </a>

                </div>
            </div>

            <!-- Account Navigation -->
            <div class="list-group rounded-0">

                <a href="{{ route('dashboard') }}"
                   class="list-group-item list-group-item-action active bg-dark border-dark text-white">
                    <i class="bi bi-speedometer2 me-2"></i>
                    Dashboard
                </a>

                <a href="{{ route('user.orders') }}"
                   class="list-group-item list-group-item-action text-dark">
                    <i class="bi bi-box-seam me-2"></i>
                    My Orders
                </a>

                <a href="{{ route('user.wishlist') }}"
                   class="list-group-item list-group-item-action text-dark">
                    <i class="bi bi-heart me-2"></i>
                    My Wishlist
                </a>

                <a href="{{ route('user.cart') }}"
                   class="list-group-item list-group-item-action text-dark">
                    <i class="bi bi-cart3 me-2"></i>
                    My Cart
                </a>

            

                <a href="{{ route('userprofile.info') }}"
                   class="list-group-item list-group-item-action text-dark">
                    <i class="bi bi-person me-2"></i>
                    Profile Information
                </a>

                <a href="{{ route('userpassword.update') }}"
                   class="list-group-item list-group-item-action text-dark">
                    <i class="bi bi-gear me-2"></i>
                    Account Settings
                </a>

                <a href="{{ route('logout') }}"
                   class="list-group-item list-group-item-action text-dark">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>

            </div>

        </aside>

        <!-- Main Content -->
        <div class="flex-grow-1" style="min-width: 0;">
            @include('alart.message')

            @yield('content')

        </div>

    </div>

</div>

@include('common.footer')
