<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::query();

          // Search functionality (by name or description)
    if ($request->has('search') && !empty($request->search)) {
        $products->where(function ($query) use ($request) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
        });
    }

        // Filter by category
        if ($request->has('category') && !empty($request->category)) {
            $products->where('category_id', $request->category);
        }

        // Sorting functionality
        if ($request->has('sort_by')) {
            if ($request->sort_by == 'price_asc') {
                $products->orderBy('price', 'asc');
            } elseif ($request->sort_by == 'price_desc') {
                $products->orderBy('price', 'desc');
            } elseif ($request->sort_by == 'date_asc') {
                $products->orderBy('created_at', 'asc');
            } elseif ($request->sort_by == 'date_desc') {
                $products->orderBy('created_at', 'desc');
            }
        } else {
            // Default sorting: Newest first
            $products->orderBy('created_at', 'desc');
        }

        $products = $products->paginate(10);

        // Check if the user is an admin and return the correct view
        if (Auth::guard('admin')->check()) {
            return view('admin.products.index', compact('products', 'categories'));
        } else {
            return view('products.index', compact('products', 'categories'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:1000', // Increased limit for longer descriptions
        'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048', // Ensures only valid images are uploaded
        'stock' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0|max:999999.99', // Explicit min/max values
        'category_id' => 'required|exists:categories,id', // Ensures category exists

    ]);

    // Initialize $imagePath to NULL to prevent issues if no image is uploaded
    $imagePath = null;

    if ($request->hasFile('image')) {
        $file = $request->file('image');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/product';

        // Move file to public/uploads/product directory
        $file->move(public_path($path), $filename);

        // Store the correct image path
        $imagePath = $path . '/' . $filename;
    }

    // Save the product in the database
    Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'image' => $imagePath, // Store NULL if no image
        'price' => $request->price,
        'stock' => $request->stock,
        'category_id' => $request->category_id,
    ]);

    // Redirect to the product index page after successful creation
    return redirect()->route('admin.products.index')->with('status', 'Product created successfully');
}
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg',

            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|between:0,999999.99',

        ]);



        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/product';

            // Move new image to public path
            $file->move(public_path($path), $filename);

            // Delete the old image (optional)
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $product->image = $path . '/' . $filename; // Update image path
        }




        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $product->image, // Keep old image if not changed

            'price' => $request->price,
            'stock' => $request->stock,

        ]);

        return redirect()->route('admin.products.index')->with('status', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.products.index')->with('status', 'Product Deleted successfully');
    }
}
