document.addEventListener("DOMContentLoaded", () => {
    if (window.jQuery && jQuery.fn.slick) {
        jQuery(".hero-slider").slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: true,
            dots: true,
            autoplay: true,
            autoplaySpeed: 4500,
            speed: 600,
            fade: false,
            infinite: true,
            adaptiveHeight: false,
            pauseOnHover: true,
            accessibility: true,
        });
    }
});

$(window).on("load", function () {
    $(".category-slider").slick({
        slidesToShow: 8,
        slidesToScroll: 1,

        autoplay: true,
        autoplaySpeed: 0,
        speed: 5000,

        infinite: true,
        arrows: false,
        dots: false,

        pauseOnHover: false,
        pauseOnFocus: false,
        focusOnSelect: false,

        cssEase: "linear",
        waitForAnimate: false,

        responsive: [
            {
                breakpoint: 992,
                settings: {
                    slidesToShow: 4,
                },
            },
            {
                breakpoint: 576,
                settings: {
                    slidesToShow: 3,
                },
            },
        ],
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const formatPrice = (price) => "৳" + Number(price).toLocaleString("en-US");

    // Element er type onujayi value boshano (input hole value, nahole text)
    function setValue(el, value) {
        if ("value" in el) el.value = value;
        else el.textContent = value;
    }

    // Drawer er empty UI
    function showEmptyCart() {
        const box = document.getElementById("cart-items");
        if (!box) return;

        box.innerHTML = `
            <div class="text-center py-5" id="empty-cart">
                <i class="bi bi-bag fs-1 d-block mb-3"></i>
                <strong>Your cart is empty</strong>
                <p class="text-secondary small mt-2">
                    Add a product and it will appear here.
                </p>
                <a href="/products" class="btn btn-dark rounded-0 mt-2">Shop products</a>
            </div>
        `;
    }

    // Subtotal ar total item shob jaygay update (drawer, header badge, checkout)
    function updateCartSummary(data) {
        document.querySelectorAll(".js-cart-count").forEach((el) => {
            el.textContent = data.totalItems;
        });

        document.querySelectorAll(".js-cart-subtotal").forEach((el) => {
            el.textContent = formatPrice(data.subtotal);
        });
    }

    // + / - / remove, duto jaygay-i kaj korbe
    document.addEventListener("click", async function (event) {
        const button = event.target.closest(
            ".cart-quantity-btn, .cart-remove-btn",
        );

        if (!button || button.disabled) return;

        const row = button.closest("[data-cart-item]");
        if (!row) return;

        const itemId = row.dataset.cartItem;
        const isRemoveBtn = button.classList.contains("cart-remove-btn");

        button.disabled = true;

        try {
            const response = await fetch(button.dataset.url, {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": button.dataset.token,
                    Accept: "application/json",
                    "Content-Type": "application/json",
                },
            });

            const data = await response.json();

            if (!response.ok || !data.success) {
                throw new Error(data.message || "Cart update failed!");
            }

            // Same item drawer + checkout, duto jaygay-i ache
            const rows = document.querySelectorAll(
                `[data-cart-item="${itemId}"]`,
            );

            if (data.removed || isRemoveBtn) {
                rows.forEach((r) => r.remove());

                if (Number(data.totalItems) === 0) showEmptyCart();
            } else {
                rows.forEach((r) => {
                    r.querySelectorAll(".js-qty").forEach((el) =>
                        setValue(el, data.quantity),
                    );
                    r.querySelectorAll(".js-line-total").forEach((el) => {
                        el.textContent = formatPrice(data.itemTotal);
                    });
                });
            }

            updateCartSummary(data);

            // Checkout page eta sune shipping/total recalc korbe
            document.dispatchEvent(
                new CustomEvent("cart:updated", { detail: data }),
            );
        } catch (error) {
            alert(error.message);
        } finally {
            // Row muche gele ei button ar page e nai, tai kono somossha nai
            button.disabled = false;
        }
    });
});