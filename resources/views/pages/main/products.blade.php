
@include('common.nav')

@php
    use Illuminate\Support\Str;
@endphp

<main>
    <section class="page-hero">
        <div class="container">
            <div class="eyebrow mb-3">The collection</div>
            <h1>SHOP COMPONENTS.</h1>
            <p class="text-secondary mb-0">
                Find the right parts for your next build.
            </p>
        </div>
    </section>

    <div>
        <div class="container py-4 py-md-5 px-2 px-md-3" style="max-width:1220px">

            {{-- Header --}}
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3 mb-4 px-1 px-md-0">
                <div>
                    <h2 class="display-6 display-md-5 fw-bolder mb-1">All products.</h2>
                    <p class="text-secondary small mb-0">Search, filter and compare demo products.</p>
                </div>

                <div class="d-flex align-items-center gap-2 align-self-start align-self-md-auto">
                    <label class="text-secondary small" for="sort">Sort</label>
                    <select id="sort" class="form-select form-select-sm rounded-0 w-auto">
                        <option>Featured</option>
                        <option>Price: Low to High</option>
                        <option>Price: High to Low</option>
                    </select>
                </div>
            </div>

            {{-- Categories --}}
            <ul class="nav nav-pills flex-nowrap gap-2 mb-4 pb-2 overflow-auto px-1 px-md-0" role="tablist">
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link active rounded-pill bg-black text-white fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#all" type="button">All</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#ram" type="button">RAM</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#monitor" type="button">Monitor</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#cpu" type="button">CPU</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#gpu" type="button">GPU</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#storage" type="button">Storage</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#motherboard" type="button">Motherboard</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#psu" type="button">PSU</button>
                </li>
                <li class="nav-item flex-shrink-0">
                    <button class="nav-link rounded-pill border text-dark fw-semibold text-nowrap" data-bs-toggle="pill" data-bs-target="#accessories" type="button">Accessories</button>
                </li>
            </ul>

            <div class="tab-content">

                {{-- ALL PRODUCTS --}}
                <div class="tab-pane fade show active" id="all" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($product) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($product as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">
                                            {{ $item->title }}
                                        </div>

                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                            {{ $item->description }}
                                        </h6>

                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>

                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                    Details
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- RAM --}}
                <div class="tab-pane fade" id="ram" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['ram']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['ram'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- MONITOR --}}
                <div class="tab-pane fade" id="monitor" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['monitor']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['monitor'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- CPU --}}
                <div class="tab-pane fade" id="cpu" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['cpu']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['cpu'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- GPU --}}
                <div class="tab-pane fade" id="gpu" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['gpu']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['gpu'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- STORAGE --}}
                <div class="tab-pane fade" id="storage" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['storage']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['storage'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- MOTHERBOARD --}}
                <div class="tab-pane fade" id="motherboard" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['motherboard']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['motherboard'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- PSU --}}
                <div class="tab-pane fade" id="psu" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['psu']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['psu'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- ACCESSORIES --}}
                <div class="tab-pane fade" id="accessories" role="tabpanel" tabindex="0">
                    <div class="d-flex justify-content-between text-secondary small mb-3 px-1 px-md-0">
                        <span>{{ count($data['accessories']) }} products</span>
                        <a href="#" class="link-dark">Clear filters</a>
                    </div>

                    <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">
                        @foreach ($data['accessories'] as $item)
                            <div class="col" style="min-width:0;">
                                <div class="card h-100 rounded-0 border">
                                    <div class="bg-light p-2 p-md-3 position-relative">
                                        <div class="ratio ratio-1x1">
                                            <img src="{{ asset('storage/' . $item->product_image) }}" class="w-100 h-100 object-fit-cover" loading="lazy" alt="{{ $item->title }}">
                                        </div>

                                        <form action="{{ route('wishlist.toggle', $item->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-sm btn-light border rounded-circle position-absolute top-0 end-0 m-2" type="submit">
                                                <i class="bi {{ auth()->check() && \App\Models\Wishlist::where('user_id', auth()->id())->where('product_id', $item->id)->exists() ? 'bi-heart-fill text-danger' : 'bi-heart text-dark' }}"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <div class="card-body p-2 p-md-3 d-flex flex-column">
                                        <div class="text-uppercase text-secondary fw-semibold text-truncate" style="font-size:.7rem;">{{ $item->title }}</div>
                                        <h6 class="fw-bold mb-2 mt-1" style="font-size:.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $item->description }}</h6>
                                        <div class="fs-6 fw-bold mb-2 mt-auto">৳{{ $item->price }}</div>

                                        <div class="row g-1 g-md-2">
                                            <div class="col-6">
                                                <form action="{{ route('cart.add', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">
                                                        <i class="bi bi-bag me-1"></i>Add
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="col-6">
                                                <a href="{{ route('product.details', ['slug' => Str::slug($item->title)]) }}" class="btn btn-outline-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm px-1 py-2" style="font-size:.7rem;">Details</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

{{-- Product Modal --}}
<div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="productModalTitle">
                    Product details
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="productModalBody"></div>
        </div>
    </div>
</div>

@include('common.footer')
