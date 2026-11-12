<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function product()
    {
        $category = Category::all();
        return view('pages.dashboard.admin-dashboard.product.add-product', compact('category'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'description' => 'nullable',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'quantity' => 'required|integer',
            'status' => 'required',

            // Main image
            'product_image' => 'required',

        ]);
        $data = new Products();

        $data->title = $request->title;
        $data->category = $request->category;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->quantity = $request->quantity;
        $data->status = $request->status;
        $data->description = $request->description;

        $data->product_image = $request->product_image->store('products_images', 'public');




        $data->save();
        return redirect()->back()->with('success', 'Product added successfully');
    }
    public function list()
    {
        $product = Products::all();
        $category = Category::all();
        return view('pages.dashboard.admin-dashboard.product.product-list', compact('product', 'category'));
    }


    // Edit Product Page
    public function edit($id)
    {
        $product = Products::findOrFail($id);

        $category = Category::all();

        return view('pages.dashboard.admin-dashboard.product.edit-product', compact('product', 'category'));
    }


    // Update Product
    public function update(Request $request, $id)
    {


        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required',
            'status' => 'required|in:active,inactive,in_stock,out_of_stock',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'quantity' => 'required|integer|min:0',
            'product_image' => 'nullable',
            'description' => 'nullable|string',
        ]);
        $data = Products::findOrFail($id);

        // Product Data
        $data->title = $request->title;
        $data->category = $request->category;
        $data->status = $request->status;
        $data->price = $request->price;
        $data->discount_price = $request->discount_price;
        $data->quantity = $request->quantity;
        $data->description = $request->description;

        // Image Upload
        if ($request->hasFile('product_image')) {

            // Delete Old Image
            if ($data->product_image && Storage::disk('public')->exists($data->product_image)) {
                Storage::disk('public')->delete($data->product_image);
            }

            // Upload New Image
            $imagePath = $request->file('product_image')->store('products', 'public');

            $data->product_image = $imagePath;
        }

        // Save Product
        $data->save();

        return redirect()->route('product.list')->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        $product = Products::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('success', 'Product deleted successfully.');
    }

public function productDetails($slug)
{
    $title = str_replace('-', ' ', $slug);

    $product = Products::whereRaw(
        'LOWER(title) = ?',
        [strtolower($title)]
    )->firstOrFail();

    $cart = session()->get('cart', []);

    $cartQuantity = $cart[$product->id]['quantity'] ?? 0;

    $availableStock = max(0, $product->quantity - $cartQuantity);

    return view('pages.main.product-details', compact('product', 'availableStock'));
}

    public function liveSearch(Request $request)
    {
        $search = trim($request->query('search', ''));

        if ($search === '') {
            return response()->json([]);
        }

        $products = Products::where('title', 'like', '%' . $search . '%')
            ->limit(6)
            ->get(['id', 'title', 'price', 'product_image']);

        return response()->json($products);
    }

    public function addToCart($id)
    {
        $product = Products::findOrFail($id);

        $cart = session()->get('cart', []);

        $cartQuantity = $cart[$id]['quantity'] ?? 0;

        $availableStock = $product->quantity - $cartQuantity;

        if ($availableStock <= 0) {

            if (request()->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Out of Stock!',
                    'availableStock' => 0
                ], 422);
            }

            return back()->with('error', 'Out of Stock!');
        }

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'id' => $product->id,
                'title' => $product->title,
                'price' => $product->price,
                'image' => $product->product_image,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        $availableStock = $product->quantity - $cart[$id]['quantity'];

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added successfully!',
                'availableStock' => $availableStock
            ]);
        }

        if (request()->input('action') === 'checkout') {
            return redirect()->route('checkout');
        }

        return back()->with('success', 'Product added to cart successfully!');
    }



    // Increase Cart Quantity
    public function increaseCart($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found!'
            ], 404);
        }

        $product = Products::find($id);

        if (!$product || $product->quantity <= $cart[$id]['quantity']) {
            return response()->json([
                'success' => false,
                'message' => 'Out of Stock! Available Quantity: ' . ($product->quantity ?? 0)
            ], 422);
        }

        $cart[$id]['quantity']++;

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'quantity' => $cart[$id]['quantity'],
            'itemTotal' => $cart[$id]['price'] * $cart[$id]['quantity'],
            'totalItems' => collect($cart)->sum('quantity'),
            'subtotal' => collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            })
        ]);
    }


    // Decrease Cart Quantity
    public function decreaseCart($id)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return response()->json([
                'success' => false,
                'message' => 'Product not found!'
            ], 404);
        }

        if ($cart[$id]['quantity'] > 1) {
            $cart[$id]['quantity']--;
        } else {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'removed' => !isset($cart[$id]),
            'totalItems' => collect($cart)->sum('quantity'),
            'subtotal' => collect($cart)->sum(function ($item) {
                return $item['price'] * $item['quantity'];
            }),
            'quantity' => $cart[$id]['quantity'] ?? 0,
            'itemTotal' => isset($cart[$id])
                ? $cart[$id]['price'] * $cart[$id]['quantity']
                : 0
        ]);
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->back()->with('success', 'product removed from cart successfully');
    }

    public function outOfStockProducts()
    {
        $product = Products::where('quantity', 0)->get();

        $category = Category::all();

        return view(
            'pages.dashboard.admin-dashboard.product.outof-stock',
            compact('product', 'category')
        );
    }

    public function index()
    {
        $products = Products::where('category', 'Slider')
            ->latest()
            ->get();

        return view('pages.dashboard.admin-dashboard.product.slider-product', compact('products'));
    }
}
