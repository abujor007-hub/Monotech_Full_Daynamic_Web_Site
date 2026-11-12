@include('common.nav')
@php
    use Illuminate\Support\Str;
@endphp
<section>

  
<div class="hero-slider container">

    @forelse ($data['slider'] as $item)

        <div>
            <div class="row g-0" style="height:480px;">

                {{-- Left Content --}}
                <div class="col-12 col-md-6 bg-body-secondary d-flex align-items-center">

                    <div class="px-4 px-lg-5 py-4 w-100">

                        <span class="badge bg-black text-white rounded-0 mb-3">
                            FEATURED PRODUCT
                        </span>

                        <h2 class="display-5 fw-bolder text-black">
                            {{ $item->title }}
                        </h2>

                        <p class="text-secondary">
                            {{ Str::limit(strip_tags($item->description), 120) }}
                        </p>

                        <h4 class="fw-bold text-black mb-4">
                            ৳{{ number_format($item->price, 2) }}
                        </h4>

                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                           class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                            Details
                        </a>

                    </div>

                </div>

                {{-- Right Product Image --}}
                <div class="col-md-6 d-none d-md-block h-100">

                    <img src="{{ asset('storage/' . $item->product_image) }}"
                         class="w-100 h-100 object-fit-cover"
                         loading="lazy"
                         alt="{{ $item->title }}">

                </div>

            </div>
        </div>

    @empty

        <div class="row g-0 align-items-center bg-body-secondary" style="height:480px;">

            <div class="col-12 text-center">
                <h3 class="fw-bold text-dark">No Slider Products Found</h3>

                <p class="text-secondary mb-0">
                    Please add products to the Hero Slider.
                </p>
            </div>

        </div>

    @endforelse

</div>

    <!-- Related Products Sections -->

    <div class="container py-4 py-md-5">

        <!-- CPU Section -->
        <section class="mb-4 mb-md-5">

            <div class="text-center mb-3 mb-md-4">
                <h3 class="fw-bold text-uppercase">CPU</h3>
                <div class="border-bottom border-dark border-2 mx-auto" style="max-width: 100px;"></div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                @foreach ($data['cpu'] as $item)

                    <div class="col">
                        <div class="card h-100 rounded-0 border">
                            <div class="bg-light p-2 p-md-3 position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                </div>

                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2"
                                        type="submit">

                                        <i
                                            class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>

                                    </button>
                                </form>

                            </div>
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <div class="text-uppercase text-secondary fw-semibold small">{{ $item->title }}</div>
                                <h6 class="fw-bold mb-3 mt-2" style="font-size: .85rem;">{{ $item->description }}</h6>
                                <div class="fs-6 fw-bold mb-3 mt-auto">৳{{ $item->price }}</div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                                <i class="bi bi-bag me-1"></i>Add
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        <!-- GPU Section -->
        <section class="mb-4 mb-md-5">

            <div class="text-center mb-3 mb-md-4">
                <h3 class="fw-bold text-uppercase">Graphics Card</h3>
                <div class="border-bottom border-dark border-2 mx-auto" style="max-width: 100px;"></div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">

                @foreach ($data['gpu'] as $item)

                    <div class="col">
                        <div class="card h-100 rounded-0 border">
                            <div class="bg-light p-2 p-md-3 position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                </div>
                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2"
                                        type="submit">

                                        <i
                                            class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>

                                    </button>
                                </form>
                            </div>
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <div class="text-uppercase text-secondary fw-semibold small">{{ $item->title }}</div>
                                <h6 class="fw-bold mb-3 mt-2" style="font-size: .85rem;">{{ $item->description }}</h6>
                                <div class="fs-6 fw-bold mb-3 mt-auto">৳{{ $item->price }}</div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                                <i class="bi bi-bag me-1"></i>Add
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        <!-- RAM Section -->
        <section class="mb-4 mb-md-5">

            <div class="text-center mb-3 mb-md-4">
                <h3 class="fw-bold text-uppercase">RAM</h3>
                <div class="border-bottom border-dark border-2 mx-auto" style="max-width: 100px;"></div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">

                @foreach ($data['ram'] as $item)

                    <div class="col">
                        <div class="card h-100 rounded-0 border">
                            <div class="bg-light p-2 p-md-3 position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                </div>
                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2"
                                        type="submit">

                                        <i
                                            class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>

                                    </button>
                                </form>
                            </div>
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <div class="text-uppercase text-secondary fw-semibold small">{{ $item->title }}</div>
                                <h6 class="fw-bold mb-3 mt-2" style="font-size: .85rem;">{{ $item->description }}</h6>
                                <div class="fs-6 fw-bold mb-3 mt-auto">৳{{ $item->price }}</div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                                <i class="bi bi-bag me-1"></i>Add
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        <!-- Motherboard Section -->
        <section class="mb-4 mb-md-5">

            <div class="text-center mb-3 mb-md-4">
                <h3 class="fw-bold text-uppercase">Motherboard</h3>
                <div class="border-bottom border-dark border-2 mx-auto" style="max-width: 100px;"></div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">

                @foreach ($data['storage'] as $item)

                    <div class="col">
                        <div class="card h-100 rounded-0 border">
                            <div class="bg-light p-2 p-md-3 position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                </div>
                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2"
                                        type="submit">

                                        <i
                                            class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>

                                    </button>
                                </form>
                            </div>
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <div class="text-uppercase text-secondary fw-semibold small">{{ $item->title }}</div>
                                <h6 class="fw-bold mb-3 mt-2" style="font-size: .85rem;">{{ $item->description }}</h6>
                                <div class="fs-6 fw-bold mb-3 mt-auto">৳{{ $item->price }}</div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                                <i class="bi bi-bag me-1"></i>Add
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                            Details
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        <!-- Monitor Section -->
        <section class="mb-4 mb-md-5">

            <div class="text-center mb-3 mb-md-4">
                <h3 class="fw-bold text-uppercase">Monitor</h3>
                <div class="border-bottom border-dark border-2 mx-auto" style="max-width: 100px;"></div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">

                @foreach ($data['motherboard'] as $item)

                    <div class="col">
                        <div class="card h-100 rounded-0 border">
                            <div class="bg-light p-2 p-md-3 position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                </div>
                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2"
                                        type="submit">

                                        <i
                                            class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>

                                    </button>
                                </form>
                            </div>
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <div class="text-uppercase text-secondary fw-semibold small">{{ $item->title }}</div>
                                <h6 class="fw-bold mb-3 mt-2" style="font-size: .85rem;">{{ $item->description }}</h6>
                                <div class="fs-6 fw-bold mb-3 mt-auto">৳{{ $item->price }}</div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                                <i class="bi bi-bag me-1"></i>Add
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>


        <!-- Storage Section -->
        <section class="mb-4 mb-md-5">

            <div class="text-center mb-3 mb-md-4">
                <h3 class="fw-bold text-uppercase">Storage</h3>
                <div class="border-bottom border-dark border-2 mx-auto" style="max-width: 100px;"></div>
            </div>

            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                @foreach ($data['psu'] as $item)

                    <div class="col">
                        <div class="card h-100 rounded-0 border">
                            <div class="bg-light p-2 p-md-3 position-relative">
                                <div class="ratio ratio-4x3">
                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                </div>
                                <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                    @csrf

                                    <button
                                        class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2"
                                        type="submit">

                                        <i
                                            class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>

                                    </button>
                                </form>
                            </div>
                            <div class="card-body p-2 p-md-3 d-flex flex-column">
                                <div class="text-uppercase text-secondary fw-semibold small">{{ $item->title }}</div>
                                <h6 class="fw-bold mb-3 mt-2" style="font-size: .85rem;">{{ $item->description }}</h6>
                                <div class="fs-6 fw-bold mb-3 mt-auto">৳{{ $item->price }}</div>
                                <div class="row g-2">
                                    <div class="col-12 col-sm-6">
                                        <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                                <i class="bi bi-bag me-1"></i>Add
                                            </button>
                                        </form>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>

    </div>
    <section class="container py-4">

        <div class="category-slider">

            <!-- RAM -->
            <div class="px-2">
                <a href="" class="text-decoration-none text-dark" title="RAM">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-memory fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- Processor -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="Processor">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-cpu fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- Motherboard -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="Motherboard">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-motherboard fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- CPU -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="CPU">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-cpu-fill fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- GPU -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="GPU">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-gpu-card fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- PSU -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="PSU">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-lightning-charge fs-1"></i>
                    </div>
                </a>
            </div>
            <!-- Processor -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="Processor">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-cpu fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- Motherboard -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="Motherboard">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-motherboard fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- CPU -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="CPU">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-cpu-fill fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- GPU -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="GPU">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-gpu-card fs-1"></i>
                    </div>
                </a>
            </div>

            <!-- PSU -->
            <div class="px-2">
                <a href="#" class="text-decoration-none text-dark" title="PSU">
                    <div class="border rounded-3 d-flex align-items-center justify-content-center mx-auto"
                        style="width: 75px; height: 75px;">
                        <i class="bi bi-lightning-charge fs-1"></i>
                    </div>
                </a>
            </div>

        </div>

    </section>
</section>
<div id="siteFooter"></div>
<div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div id="siteToast" class="toast text-bg-dark border-0" role="status">
        <div class="d-flex">
            <div class="toast-body" id="toastMessage">Added</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

@include('common.footer')