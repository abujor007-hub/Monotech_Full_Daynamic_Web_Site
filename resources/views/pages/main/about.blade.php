
@include('common.nav')

<main class="overflow-hidden bg-white">

    <!-- Hero Section -->
    <section class="bg-black text-white py-5">
        <div class="container py-5">
            <div class="row align-items-end g-4">

                <div class="col-lg-8">
                    <span class="text-uppercase text-white-50 small fw-semibold"
                        style="letter-spacing:4px;">
                        About MONOTECH / 01
                    </span>

                    <h1 class="display-1 fw-bolder text-uppercase mt-4 mb-0"
                        style="line-height:.9; letter-spacing:-4px;">
                        Built for<br>
                        <span class="text-white-50">Better</span><br>
                        Technology.
                    </h1>
                </div>

                <div class="col-lg-4">
                    <p class="text-white-50 fs-5 lh-lg mb-4">
                        Technology should make life easier.
                        We bring essential computer components
                        together in one simple shopping experience.
                    </p>

                    <a href="{{ route('product') }}"
                        class="btn btn-light rounded-0 px-4 py-3 fw-bold text-uppercase">
                        Discover Products
                        <i class="bi bi-arrow-up-right ms-2"></i>
                    </a>
                </div>

            </div>

            <div class="border-top border-secondary mt-5 pt-3 d-flex justify-content-between">
                <span class="small text-white-50 text-uppercase">Technology / Components</span>
                <span class="small text-white-50">MONOTECH © 2026</span>
            </div>
        </div>
    </section>


    <!-- Image Showcase -->
    <section class="container py-5">
        <div class="position-relative overflow-hidden bg-dark">

            <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&w=1800&q=85"
                alt="Modern computer setup"
                class="w-100"
                style="height:clamp(260px, 55vw, 600px); object-fit:cover; filter:grayscale(100%);">

            <div class="position-absolute bottom-0 start-0 p-3 p-md-5 text-white">
                <span class="small text-uppercase fw-semibold"
                    style="letter-spacing:3px;">
                    More than just components
                </span>

                <h2 class="display-4 fw-bolder text-uppercase mt-2 mb-0">
                    Build Your<br>Own World.
                </h2>
            </div>

        </div>
    </section>


    <!-- Brand Introduction -->
    <section class="py-5">
        <div class="container py-md-5">

            <div class="row g-4 g-lg-5">

                <div class="col-lg-4">
                    <span class="small text-uppercase fw-bold text-secondary"
                        style="letter-spacing:3px;">
                        01 / Our Philosophy
                    </span>

                    <h2 class="display-5 fw-bolder text-uppercase mt-3">
                        Technology<br>
                        Made Simple.
                    </h2>
                </div>

                <div class="col-lg-8">
                    <p class="fs-4 fw-semibold lh-base text-dark">
                        MONOTECH is a computer components storefront
                        designed to make technology shopping easier,
                        clearer and more accessible.
                    </p>

                    <p class="text-secondary lh-lg">
                        Whether you are upgrading your existing PC
                        or building a completely new setup, finding
                        the right components should never feel complicated.
                    </p>

                    <p class="text-secondary lh-lg">
                        From processors and RAM to graphics cards,
                        monitors, storage and accessories, we bring
                        essential PC components into one organized
                        shopping experience.
                    </p>

                    <div class="row border-top border-dark mt-5 pt-4 g-3">

                        <div class="col-6">
                            <h3 class="fw-bolder display-5 mb-1">100+</h3>
                            <span class="small text-uppercase text-secondary fw-semibold">
                                Product Listings
                            </span>
                        </div>

                        <div class="col-6">
                            <h3 class="fw-bolder display-5 mb-1">08</h3>
                            <span class="small text-uppercase text-secondary fw-semibold">
                                Product Categories
                            </span>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- Categories Section -->
    <section class="bg-black text-white py-5">
        <div class="container py-md-5">

            <div class="row align-items-end mb-5">
                <div class="col-md-8">
                    <span class="small text-white-50 text-uppercase fw-semibold"
                        style="letter-spacing:3px;">
                        02 / What We Offer
                    </span>

                    <h2 class="display-4 fw-bolder text-uppercase mt-3 mb-0">
                        Everything<br>For Your Setup.
                    </h2>
                </div>

                <div class="col-md-4 mt-3 mt-md-0">
                    <p class="text-white-50 lh-lg mb-0">
                        Explore essential hardware and accessories
                        for your everyday computing needs.
                    </p>
                </div>
            </div>

            <div class="row g-0 border-top border-secondary">

                @php
                    $categories = [
                        ['01', 'Processors', 'bi-cpu'],
                        ['02', 'Graphics Cards', 'bi-gpu-card'],
                        ['03', 'Memory & RAM', 'bi-memory'],
                        ['04', 'Monitors', 'bi-display'],
                        ['05', 'Storage', 'bi-device-ssd'],
                        ['06', 'Motherboards', 'bi-motherboard'],
                        ['07', 'Power Supply', 'bi-lightning-charge'],
                        ['08', 'Accessories', 'bi-headphones']
                    ];
                @endphp

                @foreach($categories as $category)
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="border-bottom border-end border-secondary p-4 h-100"
                            style="min-height:175px;">

                            <div class="d-flex justify-content-between align-items-start mb-4">
                                <span class="small text-white-50">
                                    {{ $category[0] }}
                                </span>

                                <i class="bi {{ $category[2] }} fs-3"></i>
                            </div>

                            <h5 class="fw-bold text-uppercase mb-0">
                                {{ $category[1] }}
                            </h5>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </section>


    <!-- Why MONOTECH -->
    <section class="py-5">
        <div class="container py-md-5">

            <div class="text-center mb-5">
                <span class="small text-secondary fw-bold text-uppercase"
                    style="letter-spacing:3px;">
                    03 / Our Commitment
                </span>

                <h2 class="display-5 fw-bolder text-uppercase mt-3">
                    Why MONOTECH?
                </h2>
            </div>

            <div class="row g-3">

                <div class="col-md-6 col-lg-4">
                    <div class="border border-dark p-4 p-lg-5 h-100">
                        <i class="bi bi-grid-1x2 fs-1"></i>

                        <h4 class="fw-bold text-uppercase mt-4">
                            Organized Shopping
                        </h4>

                        <p class="text-secondary lh-lg mb-0">
                            Find computer components through
                            clearly organized product categories.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="border border-dark p-4 p-lg-5 h-100">
                        <i class="bi bi-cpu fs-1"></i>

                        <h4 class="fw-bold text-uppercase mt-4">
                            Tech Essentials
                        </h4>

                        <p class="text-secondary lh-lg mb-0">
                            Discover hardware and accessories
                            for upgrades and custom PC builds.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mx-md-auto">
                    <div class="bg-black text-white p-4 p-lg-5 h-100">
                        <i class="bi bi-chat-square-text fs-1"></i>

                        <h4 class="fw-bold text-uppercase mt-4">
                            Helpful Support
                        </h4>

                        <p class="text-white-50 lh-lg mb-0">
                            Get in touch with us for product
                            information and compatibility questions.
                        </p>
                    </div>
                </div>

            </div>

        </div>
    </section>


    <!-- Final CTA -->
    <section class="bg-black text-white py-5">
        <div class="container py-5">

            <div class="row align-items-center">

                <div class="col-lg-8">
                    <span class="small text-white-50 text-uppercase fw-semibold"
                        style="letter-spacing:3px;">
                        Your Next Build Starts Here
                    </span>

                    <h2 class="display-2 fw-bolder text-uppercase mt-3 mb-3"
                        style="line-height:.95; letter-spacing:-3px;">
                        Ready To<br>Upgrade?
                    </h2>

                    <p class="text-white-50 fs-5">
                        Find the components that bring your ideas to life.
                    </p>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <a href="{{ route('product') }}"
                        class="btn btn-light rounded-0 w-100 py-3 fw-bold text-uppercase mb-3">
                        Shop Products
                        <i class="bi bi-arrow-up-right ms-2"></i>
                    </a>

                    <a href="{{ url('/contact') }}"
                        class="btn btn-outline-light rounded-0 w-100 py-3 fw-bold text-uppercase">
                        Contact Us
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                </div>

            </div>

        </div>
    </section>

</main>

@include('common.footer')