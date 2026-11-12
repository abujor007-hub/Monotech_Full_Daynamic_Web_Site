@include('common.nav')

<body class="bg-white">

    <div class="container py-4 py-lg-5">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb small">
                <li class="breadcrumb-item">
                    <a href="{{ route('index') }}" class="text-secondary">Home</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('product') }}" class="text-secondary">Products</a>
                </li>
                <li class="breadcrumb-item active text-dark">
                    Product Details
                </li>
            </ol>
        </nav>

        <div class="row g-4 g-lg-5 mt-1">

            <!-- Product Images -->
            <div class="col-12 col-lg-6">

                <!-- Main Image: Medium Size -->
                <div class="text-center bg-light rounded-3 p-2">
                    <img id="mainImage" src="{{ asset('storage/' . $product->product_image) }}"
                        alt="{{ $product->title }}" class="img-fluid w-100 rounded-3" role="button"
                        data-bs-toggle="modal" data-bs-target="#imageModal">
                </div>

                <!-- Multiple Images -->
                <div class="row row-cols-4 g-2 mt-2">

                    <div class="col">
                        <button type="button"
                            class="btn p-0 border border-dark rounded-3 overflow-hidden w-100 thumbnail-btn"
                            data-image="https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=1000&q=85">
                            <img src="https://images.unsplash.com/photo-1503602642458-232111445657?auto=format&fit=crop&w=300&q=80"
                                alt="Product image 1" class="img-fluid w-100">
                        </button>
                    </div>

                    <div class="col">
                        <button type="button" class="btn p-0 border rounded-3 overflow-hidden w-100 thumbnail-btn"
                            data-image="https://images.unsplash.com/photo-1598300053653-1e3a6a3c1f5a?auto=format&fit=crop&w=1000&q=85">
                            <img src="https://images.unsplash.com/photo-1598300053653-1e3a6a3c1f5a?auto=format&fit=crop&w=300&q=80"
                                alt="Product image 2" class="img-fluid w-100">
                        </button>
                    </div>

                    <div class="col">
                        <button type="button" class="btn p-0 border rounded-3 overflow-hidden w-100 thumbnail-btn"
                            data-image="https://images.unsplash.com/photo-1592078615290-033ee584e267?auto=format&fit=crop&w=1000&q=85">
                            <img src="https://images.unsplash.com/photo-1592078615290-033ee584e267?auto=format&fit=crop&w=300&q=80"
                                alt="Product image 3" class="img-fluid w-100">
                        </button>
                    </div>

                    <div class="col">
                        <button type="button" class="btn p-0 border rounded-3 overflow-hidden w-100 thumbnail-btn"
                            data-image="https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=1000&q=85">
                            <img src="https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?auto=format&fit=crop&w=300&q=80"
                                alt="Product image 4" class="img-fluid w-100">
                        </button>
                    </div>

                </div>

                <p class="text-secondary text-center small mt-3">
                    <i class="bi bi-zoom-in"></i>
                    Click image to zoom
                </p>

            </div>

            <!-- Product Information -->
            <div class="col-12 col-lg-6">

                <p class="small text-secondary text-uppercase fw-semibold">
                    NexXoom Collection
                </p>

                <h1 id="productName" class="fw-bold">
                    {{ $product->title }}
                </h1>

                <!-- Price -->
                <div class="d-flex flex-wrap align-items-center gap-3 my-4">

                    <h2 class="fw-bold mb-0">
                        ৳<span id="productPrice">{{ $product->price }}</span>
                    </h2>

                    <span class="text-secondary text-decoration-line-through">
                        ৳{{ $product->discount_price }}
                    </span>

                    <span class="badge text-bg-light border">
                        Save ৳2,500
                    </span>

                </div>

                <!-- Description -->
                <p class="text-secondary lh-lg">
                    {{ $product->description }}
                </p>

<p id="stockText"
    class="{{ $availableStock > 0 ? 'text-success fw-semibold' : 'text-danger fw-bold' }}">

    @if ($availableStock > 0)
        Available Stock:
        <span id="availableStock">{{ $availableStock }}</span>
    @else
        Out of Stock
    @endif

</p>
                <hr class="my-4">



                <!-- Quantity -->

                <!-- Subtotal -->
                <div class="mb-4">



                </div>

                <!-- Action Buttons -->

                <!-- Action Buttons -->

                <div class="row g-3">

                    <!-- Add Button -->
                    <div class="col-12 col-sm-6">

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf

                            <button type="submit"
                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                <i class="bi bi-bag me-1"></i>Add
                            </button>
                        </form>

                    </div>


                    <!-- Checkout Button -->
                    <div class="col-12 col-sm-6">

                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf

                            <input type="hidden" name="action" value="checkout">

                            <button type="submit"
                                class="btn btn-dark rounded-0 w-100 text-uppercase fw-semibold btn-sm py-2">
                                <i class="bi bi-cart me-1"></i>Checkout
                            </button>
                        </form>

                    </div>

                </div>

                <!-- Message -->





            </div>

        </div>
    </div>

    <!-- Image Zoom Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">

                <div class="modal-header">

                    <h5 class="modal-title">Product Preview</h5>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>

                <div class="modal-body text-center">

                    <img id="zoomImage" src="" alt="Zoomed product" class="img-fluid">

                </div>

            </div>

        </div>
    </div>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const form = document.getElementById('addToCartForm');
    const stockText = document.getElementById('stockText');
    const addButton = document.getElementById('addToCartBtn');
    const message = document.getElementById('cartMessage');

    form.addEventListener('submit', function (e) {

        e.preventDefault();

        addButton.disabled = true;

        fetch(form.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                'Accept': 'application/json'
            }
        })

        .then(async response => {
            const data = await response.json();

            if (!response.ok) {
                throw data;
            }

            return data;
        })

        .then(data => {

            const stock = data.availableStock;

            if (stock <= 0) {
                stockText.textContent = 'Out of Stock';
                stockText.className = 'text-danger fw-bold';

                addButton.textContent = 'Out of Stock';
                addButton.disabled = true;

            } else {
                stockText.innerHTML =
                    'Available Stock: <span id="availableStock">' + stock + '</span>';

                stockText.className = 'text-success fw-semibold';

                addButton.disabled = false;
            }

            message.textContent = data.message;
            message.className = 'text-success mt-2 small';

        })

        .catch(error => {

            message.textContent = error.message || 'Something went wrong!';
            message.className = 'text-danger mt-2 small';

            if (error.availableStock !== undefined && error.availableStock <= 0) {
                stockText.textContent = 'Out of Stock';
                stockText.className = 'text-danger fw-bold';
                addButton.textContent = 'Out of Stock';
            }

        })

        .finally(() => {
            if (addButton.textContent !== 'Out of Stock') {
                addButton.disabled = false;
            }
        });

    });

});
</script>
    <script></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const product = {
            id: 1,
            name: "Premium Black Chair",
            price: 12500,
            color: "Black"
        };

        const mainImage = document.getElementById("mainImage");
        const quantityInput = document.getElementById("quantity");
        const subtotal = document.getElementById("subtotal");
        const message = document.getElementById("message");

        // Change main image
        document.querySelectorAll(".thumbnail-btn").forEach(function (button) {
            button.addEventListener("click", function () {
                mainImage.src = button.dataset.image;

                document.querySelectorAll(".thumbnail-btn").forEach(function (item) {
                    item.classList.remove("border-dark");
                    item.classList.add("border");
                });

                button.classList.remove("border");
                button.classList.add("border-dark");
            });
        });

        // Zoom image
        mainImage.addEventListener("click", function () {
            document.getElementById("zoomImage").src = mainImage.src;
        });

        // Update subtotal
        function updateSubtotal() {
            const quantity = Number(quantityInput.value);

            subtotal.textContent = (
                product.price * quantity
            ).toLocaleString("en-US");
        }

        // Decrease quantity
        document.getElementById("minusBtn").addEventListener("click", function () {
            let quantity = Number(quantityInput.value);

            if (quantity > 1) {
                quantityInput.value = quantity - 1;
                updateSubtotal();
            }
        });

        // Increase quantity
        document.getElementById("plusBtn").addEventListener("click", function () {
            let quantity = Number(quantityInput.value);

            if (quantity < 99) {
                quantityInput.value = quantity + 1;
                updateSubtotal();
            }
        });

        // Add to cart
        function addToCart() {
            let cart = [];

            try {
                cart = JSON.parse(localStorage.getItem("cart") || "[]");

                if (!Array.isArray(cart)) {
                    cart = [];
                }
            } catch (error) {
                cart = [];
            }

            const quantity = Number(quantityInput.value);

            const existing = cart.find(function (item) {
                return Number(item.id) === product.id &&
                    item.color === product.color;
            });

            if (existing) {
                existing.quantity =
                    Number(existing.quantity || 0) + quantity;
            } else {
                cart.push({
                    id: product.id,
                    name: product.name,
                    price: product.price,
                    color: product.color,
                    quantity: quantity,
                    image: mainImage.src
                });
            }

            localStorage.setItem("cart", JSON.stringify(cart));

            window.dispatchEvent(new Event("cartUpdated"));

            message.textContent = "Product added to cart successfully!";
            message.classList.remove("d-none", "alert-danger");
            message.classList.add("alert-success");

            return true;
        }

        document.getElementById("addToCartBtn").addEventListener("click", function () {
            addToCart();
        });

        // Buy Now
        document.getElementById("buyNowBtn").addEventListener("click", function () {
            addToCart();
            window.location.href = "checkout.html";
        });
    </script>


    @include('common.footer')