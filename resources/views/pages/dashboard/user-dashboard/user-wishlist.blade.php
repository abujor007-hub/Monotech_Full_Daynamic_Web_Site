@extends('layout.user-dayout')

@section('content')

<main class="col">

    <div class="container-fluid py-4">

        <h4 class="fw-bold mb-4">My Wishlist</h4>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-2 g-md-4">

            @forelse($wishlists as $wishlist)

                @if($wishlist->product)

                    @php
                        $item = $wishlist->product;
                    @endphp

                    <div class="col">

                        <div class="card h-100 rounded-0 border">

                            <div class="bg-light p-2 p-md-3">

                                <div class="ratio ratio-4x3">

                                    <img src="{{ asset('storage/' . $item->product_image) }}"
                                        class="w-100 h-100 object-fit-cover"
                                        alt="{{ $item->title }}">

                                </div>

                            </div>

                            <div class="card-body p-2 p-md-3 d-flex flex-column">

                                <div class="text-uppercase text-secondary fw-semibold small">
                                    {{ $item->title }}
                                </div>

                                <h6 class="fw-bold mb-3 mt-2">
                                    {{ $item->description }}
                                </h6>

                                <div class="fs-6 fw-bold mb-3 mt-auto">
                                    ৳{{ $item->price }}
                                </div>

                                <div class="row g-2">

                                    <div class="col-12 col-sm-6">

                                        <form action="{{ route('cart.add', $item->id) }}"
                                            method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-dark rounded-0 w-100 btn-sm py-2">

                                                <i class="bi bi-bag me-1"></i>
                                                Add

                                            </button>

                                        </form>

                                    </div>

                                    <div class="col-12 col-sm-6">

                                        <a href="{{ route('product.details', $item->id) }}"
                                            class="btn btn-outline-dark rounded-0 w-100 btn-sm py-2">

                                            Details

                                        </a>

                                    </div>

                                    <div class="col-12">

                                        <form action="{{ route('wishlist.toggle', $item->id) }}"
                                            method="POST">
                                            @csrf

                                            <button type="submit"
                                                class="btn btn-outline-dark rounded-0 w-100 btn-sm py-2">

                                                <i class="bi bi-heart-fill me-1"></i>
                                                Remove Wishlist

                                            </button>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                @endif

            @empty

                <div class="col-12">

                    <div class="text-center py-5">

                        <i class="bi bi-heart fs-1"></i>

                        <h5 class="fw-bold mt-3">
                            Your Wishlist is Empty
                        </h5>

                        <p class="text-secondary">
                            You haven't added any products yet.
                        </p>

                    </div>

                </div>

            @endforelse

        </div>

    </div>

</main>

@endsection