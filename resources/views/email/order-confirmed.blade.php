
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed - MONOTECH</title>
</head>

<body style="margin:0; padding:20px; background:#f5f5f5; font-family:Arial,sans-serif;">

    <div style="max-width:600px; margin:auto; background:#fff; border:1px solid #ddd;">

        <!-- Header -->
        <div style="background:#000; color:#fff; padding:25px; text-align:center;">

            <h1 style="margin:0;">MONOTECH</h1>

            <p style="margin-bottom:0;">
                Your Trusted Technology Store
            </p>

        </div>

        <!-- Email Content -->
        <div style="padding:25px;">

            <h2 style="color:#198754;">
                Order Confirmed!
            </h2>

            <p>
                Hello {{ $order->first_name }} {{ $order->last_name }},
            </p>

            <p>
                Thank you for shopping with MONOTECH.
                Your order has been confirmed successfully.
            </p>

            <!-- Order Information -->
            <p>
                <strong>Order ID:</strong> #{{ $order->id }}<br>

                <strong>Order Date:</strong>
                {{ $order->created_at->format('d M Y') }}<br>

                <strong>Payment Method:</strong>
                {{ $order->payment_method }}
            </p>

            <h3>Order Summary</h3>

            <!-- Product Table -->
            <table width="100%" cellpadding="8" cellspacing="0"
                style="border-collapse:collapse;">

                <thead>

                    <tr style="background:#eee;">

                        <th align="left">Product</th>

                        <th align="center">Price</th>

                        <th align="center">Qty</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($order->items as $item)

                        <tr>

                            <!-- Product Image + Name -->
                            <td style="border-bottom:1px solid #ddd;">

                                <table cellpadding="0" cellspacing="0">
                                    <tr>

                                        <td style="padding-right:10px;">

                                           @if ($item->product && $item->product->product_image)

                                                        <img src="{{ asset('storage/' . $item->product->product_image) }}"
                                                            alt="{{ $item->product->title }}" width="50" height="50"
                                                            class="rounded border" style="object-fit: cover;">

                                                    @else

                                                <span>No Image</span>

                                            @endif

                                        </td>

                                        <td>
                                            <strong>
                                                {{ $item->product?->title ?? 'Product' }}
                                            </strong>
                                        </td>

                                    </tr>
                                </table>

                            </td>

                            <!-- Price -->
                            <td align="center" style="border-bottom:1px solid #ddd;">

                                ৳{{ number_format($item->price, 2) }}

                            </td>

                            <!-- Quantity -->
                            <td align="center" style="border-bottom:1px solid #ddd;">

                                {{ $item->quantity }}

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            <!-- Order Total -->
            <div style="margin-top:20px; text-align:right;">

                <p>
                    Subtotal:
                    ৳{{ number_format($order->subtotal, 2) }}
                </p>

                <p>
                    Shipping:
                    ৳{{ number_format($order->shipping, 2) }}
                </p>

                <h3>
                    Total:
                    ৳{{ number_format($order->total, 2) }}
                </h3>

            </div>

            <hr>

            <!-- Delivery Address -->
            <p>

                <strong>Delivery Address:</strong><br>

                {{ $order->address }}<br>

                {{ $order->city }},
                {{ $order->distirct }}

            </p>

            <p>
                We will keep you updated about your order.
            </p>

            <p>
                Thank you for choosing MONOTECH!
            </p>

        </div>

        <!-- Footer -->
        <div style="background:#000; color:#fff; padding:15px; text-align:center;">

            <p style="margin:0;">
                MONOTECH - Computer & Technology Store
            </p>

        </div>

    </div>

</body>

</html>
