<!-- Mobile Bottom Navigation -->
<!-- Spacer: nav-er niche content dhuke na jaay (sudhu mobile) -->
<div class="d-md-none" style="height:72px;"></div>

<!-- Mobile Bottom Navigation -->
<nav class="fixed-bottom d-md-none bg-dark border-top border-secondary"
    style="padding-bottom: env(safe-area-inset-bottom);">

    <div class="d-flex w-100 text-center">

        <!-- Home -->
        <a href="{{ route('index') }}"
            class="flex-fill d-flex flex-column align-items-center justify-content-center py-2 text-decoration-none {{ request()->routeIs('index') ? 'text-warning' : 'text-white' }}"
            style="min-width:0;">
            <i class="bi bi-house-door-fill fs-5 lh-1"></i>
            <span class="text-truncate w-100 mt-1" style="font-size:.7rem;">Home</span>
        </a>

        <!-- Cart -->
        <button type="button"
            class="flex-fill d-flex flex-column align-items-center justify-content-center py-2 text-white bg-transparent border-0"
            style="min-width:0;"
            data-bs-toggle="offcanvas"
            data-bs-target="#cartOffcanvas"
            aria-controls="cartOffcanvas">
            <i class="bi bi-cart3 fs-5 lh-1"></i>
            <span class="text-truncate w-100 mt-1" style="font-size:.7rem;">Cart</span>
        </button>

        <!-- Product -->
        <a href="{{ route('product') }}"
            class="flex-fill d-flex flex-column align-items-center justify-content-center py-2 text-decoration-none {{ request()->routeIs('product') ? 'text-warning' : 'text-white' }}"
            style="min-width:0;">
            <i class="bi bi-grid-fill fs-5 lh-1"></i>
            <span class="text-truncate w-100 mt-1" style="font-size:.7rem;">Product</span>
        </a>

        <!-- Account -->
        <a href="{{ route('dashboard') }}"
            class="flex-fill d-flex flex-column align-items-center justify-content-center py-2 text-decoration-none {{ request()->routeIs('dashboard') ? 'text-warning' : 'text-white' }}"
            style="min-width:0;">
            <i class="bi bi-person-fill fs-5 lh-1"></i>
            <span class="text-truncate w-100 mt-1" style="font-size:.7rem;">Account</span>
        </a>

    </div>

</nav>
  <footer class="bg-black text-white-50 pt-5 mt-5">
  <div class="container">
    <div class="row g-4 pb-5">
      <div class="col-lg-4">
        <a href="index.html" class="text-decoration-none text-white d-flex align-items-center gap-2 fw-bolder fs-5">
          <span class="bg-white text-black d-inline-flex align-items-center justify-content-center fw-bold" style="width:32px;height:32px;">M</span>MONOTECH
        </a>
        <p class="mt-3 small lh-lg">Computer components and electronics for work, play and everything in between.</p>
      </div>

      <div class="col-6 col-lg-2">
        <h3 class="h6 text-white text-uppercase mb-3">Explore</h3>
        <div class="d-flex flex-column gap-2 small">
          <a href="{{ route('index') }}" class="link-light link-opacity-75 text-decoration-none">Home</a>
          <a href="{{ route('product') }}" class="link-light link-opacity-75 text-decoration-none">Products</a>
          <a href="{{ route('about') }}" class="link-light link-opacity-75 text-decoration-none">About us</a>
          <a href="{{ route('contact') }}" class="link-light link-opacity-75 text-decoration-none">Contact</a>
        </div>
      </div>

      <div class="col-6 col-lg-3">
    <h3 class="h6 text-white text-uppercase mb-3">Categories</h3>

    <div class="d-flex flex-column gap-2 small">

        <a href="#ram" class="link-light link-opacity-75 text-decoration-none">RAM &amp; Memory</a>

        <a href="#monitor" class="link-light link-opacity-75 text-decoration-none">Monitors</a>

        <a href="#cpu" class="link-light link-opacity-75 text-decoration-none">Processors</a>

        <a href="#gpu" class="link-light link-opacity-75 text-decoration-none">Graphics Cards</a>

    </div>
</div>
      <div class="col-lg-3">
        <h3 class="h6 text-white text-uppercase mb-3">Stay connected</h3>
        <p class="small">Follow our latest product arrivals and updates.</p>
        <a class="btn btn-outline-light rounded-0" href="contact.html" aria-label="Email us"><i class="bi bi-envelope"></i></a>
      </div>
    </div>

    <div class="border-top border-secondary py-3 d-flex flex-wrap justify-content-between gap-2">
      <small>© 2026 MONOTECH. All rights reserved.</small>
      <small>Designed in black &amp; white.</small>
    </div>
  </div>
</footer>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('js/script.js') }}"></script>
   


    

</body>

</html>