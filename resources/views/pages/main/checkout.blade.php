@include('common.nav')
<style>
    /* Compact inputs: smaller height and padding */
    .form-floating>.form-control,
    .form-floating>.form-select {
        height: calc(2.6rem + 2px);
        min-height: calc(2.6rem + 2px);
        padding: 1.05rem .75rem .25rem;
        font-size: .9rem;
    }

    .form-floating>label {
        padding: .6rem .75rem;
        font-size: .85rem;
    }

    .form-floating>.form-control:focus~label,
    .form-floating>.form-control:not(:placeholder-shown)~label,
    .form-floating>.form-select~label {
        transform: scale(.8) translateY(-.5rem) translateX(.15rem);
    }
</style>
</head>

<body class="bg-white text-dark">

    @php
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);
        $totalItems = collect($cart)->sum('quantity');

        $districts = ['Bagerhat','Bandarban','Barguna','Barishal','Bhola','Bogura','Brahmanbaria','Chandpur','Chattogram','Chuadanga','Cumilla',"Cox's Bazar",'Dhaka','Dinajpur','Faridpur','Feni','Gaibandha','Gazipur','Gopalganj','Habiganj','Jamalpur','Jashore','Jhalokathi','Jhenaidah','Joypurhat','Khagrachhari','Khulna','Kishoreganj','Kurigram','Kushtia','Lakshmipur','Lalmonirhat','Madaripur','Magura','Manikganj','Meherpur','Moulvibazar','Munshiganj','Mymensingh','Naogaon','Narail','Narayanganj','Narsingdi','Natore','Netrokona','Nilphamari','Noakhali','Pabna','Panchagarh','Patuakhali','Pirojpur','Rajbari','Rajshahi','Rangamati','Rangpur','Satkhira','Shariatpur','Sherpur','Sirajganj','Sunamganj','Sylhet','Tangail','Thakurgaon'];
    @endphp

    <div class="container py-5">

        <h1 class="text-center display-4 my-5 py-3">Checkout</h1>

        {{-- Change the action to your order-store route (POST) --}}
       <form method="POST" action="{{ route('order') }}" id="checkoutForm">
            @csrf

            <div class="row g-5">

                <!-- LEFT: FORM -->
                <div class="col-lg-8">

                    <!-- Billing -->
                    <h2 class="h5 mb-1">Billing and shipping address</h2>

                    <p class="small text-secondary mb-3">
                        Enter the billing and shipping address that matches your payment method.
                    </p>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text"
                                    name="first_name"
                                    class="form-control border-dark"
                                    id="fname"
                                    placeholder="First name"
                                    value="{{ old('first_name') }}"
                                    required>

                                <label for="fname">First name</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text"
                                    name="last_name"
                                    class="form-control border-dark"
                                    id="lname"
                                    placeholder="Last name"
                                    value="{{ old('last_name') }}"
                                    required>

                                <label for="lname">Last name</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text"
                                    name="message"
                                    class="form-control border-dark"
                                    id="message"
                                    placeholder="Message (optional)"
                                    value="{{ old('message') }}">

                                <label for="message">Message (optional)</label>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text"
                                    name="address"
                                    class="form-control border-dark"
                                    id="address"
                                    placeholder="Address"
                                    value="{{ old('address') }}"
                                    required>

                                <label for="address">Address</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text"
                                    name="city"
                                    class="form-control border-dark"
                                    id="city"
                                    placeholder="City"
                                    value="{{ old('city') }}"
                                    required>

                                <label for="city">City</label>
                            </div>
                        </div>

                        <div class="col-md-6 form-floating">
                            <select class="form-select border-dark"
                                name="distirct"
                                id="state"
                                required>

                                @foreach ($districts as $district)
                                    <option value="{{ $district }}"
                                        {{ old('district', 'Dhaka') === $district ? 'selected' : '' }}>
                                        {{ $district }}
                                    </option>
                                @endforeach

                            </select>

                            <label for="state" class="ms-2">District</label>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email"
                                    name="email"
                                    class="form-control border-dark"
                                    id="email"
                                    placeholder="Email"
                                    value="{{ old('email') }}"
                                    required>

                                <label for="email">Email</label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="tel"
                                    name="phone"
                                    class="form-control border-dark"
                                    id="phone"
                                    placeholder="Phone"
                                    value="{{ old('phone') }}"
                                    required>

                                <label for="phone">Phone</label>
                            </div>
                        </div>

                    </div>


                    <!-- Shipping -->
                    <h2 class="h5 mt-5 mb-3">Shipping options</h2>

                    <div class="border border-dark rounded px-3 py-2 d-flex justify-content-between align-items-center">

                        <div class="form-check mb-0">

                            <input class="form-check-input border-dark"
                                type="radio"
                                name="shipping_option"
                                id="ship1"
                                value="standard"
                                checked>

                            <label class="form-check-label small"
                                for="ship1"
                                id="shipLabel">
                                Inside Dhaka
                            </label>

                        </div>

                        <span class="small text-secondary" id="shipPrice">
                            ৳50.00
                        </span>

                    </div>


                    <!-- Payment -->
                    <h2 class="h5 mt-5 mb-3">Payment options</h2>

                    <div class="border border-dark rounded px-3 mb-2">

                        <div class="form-check mb-1">

                            <input class="form-check-input border-dark"
                                type="radio"
                                name="payment_method"
                                value="cod"
                                id="pay1"
                                {{ old('payment_method', 'cod') == 'cod' ? 'checked' : '' }}>

                            <label class="form-check-label small" for="pay1">
                                Cash on delivery
                            </label>

                        </div>

                        <p class="small text-secondary mb-0">
                            Pay with cash upon delivery.
                        </p>

                    </div>


                    <div class="border border-dark rounded px-3 mb-2">

                        <div class="form-check mb-1">

                            <input class="form-check-input border-dark"
                                type="radio"
                                name="payment_method"
                                value="bkash"
                                id="pay2"
                                {{ old('payment_method') == 'bkash' ? 'checked' : '' }}>

                            <label class="form-check-label small" for="pay2">
                                bKash
                            </label>

                        </div>

                        <p class="small text-secondary mb-0">
                            Pay securely with your bKash account.
                        </p>

                    </div>


                    <div class="border border-dark rounded px-3">

                        <div class="form-check mb-1">

                            <input class="form-check-input border-dark"
                                type="radio"
                                name="payment_method"
                                value="sslcommerz"
                                id="pay3"
                                {{ old('payment_method') == 'sslcommerz' ? 'checked' : '' }}>

                            <label class="form-check-label small" for="pay3">
                                SSLCommerz
                            </label>

                        </div>

                        <p class="small text-secondary mb-0">
                            Pay with card, mobile banking or internet banking.
                        </p>

                    </div>


                    <!-- Terms -->
                    <hr class="my-4">

                    <p class="small text-secondary mb-3">
                        By proceeding with your purchase you agree to our
                        <a href="#" class="text-dark">Terms and Conditions</a>
                        and
                        <a href="#" class="text-dark">Privacy Policy</a>
                    </p>


                    <!-- Place Order -->
                    <button type="submit"
                        id="placeOrderBtn"
                        class="btn btn-dark w-100"
                        {{ count($cart) === 0 ? 'disabled' : '' }}>

                        Place Order

                    </button>

                </div>


                <!-- RIGHT: ORDER SUMMARY -->
                <div class="col-lg-4">

                    <div class="border rounded">

                        <div class="p-3">

                            <h2 class="h5 text-secondary mb-3">
                                Order summary
                            </h2>

                            <div id="checkoutItems">

                                @foreach ($cart as $item)

                                    <div class="d-flex align-items-center gap-3 mb-3"
                                        data-cart-item="{{ $item['id'] }}">

                                        <img src="{{ asset('storage/' . $item['image']) }}"
                                            alt="{{ $item['title'] }}"
                                            class="border rounded flex-shrink-0"
                                            style="width:64px;height:64px;object-fit:cover;">

                                        <div class="flex-grow-1">

                                            <div class="small fw-semibold mb-2">
                                                {{ $item['title'] }}
                                            </div>

                                            <div class="d-flex align-items-center gap-2">

                                                <div class="input-group input-group-sm"
                                                    style="width:96px;">

                                                    <button type="button"
                                                        class="btn btn-outline-dark cart-quantity-btn"
                                                        data-url="{{ route('cart.decrease', $item['id']) }}"
                                                        data-token="{{ csrf_token() }}"
                                                        aria-label="Decrease quantity">
                                                        &minus;
                                                    </button>

                                                    <input type="text"
                                                        class="form-control text-center border-dark px-0 js-qty"
                                                        value="{{ $item['quantity'] }}"
                                                        readonly
                                                        aria-label="Quantity">

                                                    <button type="button"
                                                        class="btn btn-outline-dark cart-quantity-btn"
                                                        data-url="{{ route('cart.increase', $item['id']) }}"
                                                        data-token="{{ csrf_token() }}"
                                                        aria-label="Increase quantity">
                                                        +
                                                    </button>

                                                </div>

                                                <a href="{{ route('cart.remove', $item['id']) }}"
                                                    class="btn btn-sm btn-outline-danger cart-remove-btn">

                                                    <i class="bi bi-trash"></i>

                                                </a>

                                            </div>

                                        </div>

                                        <div class="small fw-semibold js-line-total">

                                            ৳{{ number_format($item['price'] * $item['quantity']) }}

                                        </div>

                                    </div>

                                @endforeach

                            </div>


                            <!-- Empty Cart -->
                            <div id="checkoutEmpty"
                                class="text-center py-3 {{ count($cart) ? 'd-none' : '' }}">

                                <strong class="d-block">
                                    Your cart is empty
                                </strong>

                                <a href="/products"
                                    class="btn btn-dark rounded-0 mt-3">
                                    Shop products
                                </a>

                            </div>

                        </div>


                        <!-- Subtotal and Shipping -->
                        <div class="border-top p-3 small text-secondary">

                            <div class="d-flex justify-content-between mb-3">

                                <span>Subtotal</span>

                                <span class="js-cart-subtotal">
                                    ৳{{ number_format($subtotal) }}
                                </span>

                            </div>

                            <div class="d-flex justify-content-between">

                                <span id="sumShipLabel">
                                    Inside Dhaka
                                </span>

                                <span id="sumShipPrice">
                                    ৳50.00
                                </span>

                            </div>

                        </div>


                        <!-- Total -->
                        <div class="border-top p-3 d-flex justify-content-between align-items-center">

                            <span class="fs-5 fw-semibold">
                                Total
                            </span>

                            <span class="fs-4" id="total">
                                ৳{{ number_format($subtotal + 50, 2) }}
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </form>
    </div>

    <!-- Shipping + total only. Cart +/-/remove is handled by public/js/script.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stateSelect = document.getElementById('state');
            const money = n => '৳' + Number(n).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            let subtotal = {{ $subtotal }};
            let count = {{ $totalItems }};

            function render() {
                const inDhaka = stateSelect.value === 'Dhaka';
                const ship = count === 0 ? 0 : (inDhaka ? 50 : 120);
                const label = inDhaka ? 'Inside Dhaka' : 'Outside Dhaka';

                document.getElementById('shipLabel').textContent = label;
                document.getElementById('shipPrice').textContent = money(ship);
                document.getElementById('sumShipLabel').textContent = label;
                document.getElementById('sumShipPrice').textContent = money(ship);
                document.getElementById('total').textContent = money(subtotal + ship);

                document.getElementById('checkoutEmpty').classList.toggle('d-none', count !== 0);
                document.getElementById('placeOrderBtn').disabled = count === 0;
            }

            stateSelect.addEventListener('change', render);

            // script.js fires this after every successful cart update
            document.addEventListener('cart:updated', function (e) {
                subtotal = Number(e.detail.subtotal);
                count = Number(e.detail.totalItems);
                render();
            });

            render();
        });
    </script>

    @include('common.footer')