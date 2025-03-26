<?php

namespace App\Http\Controllers\Normal_User;
use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all categories
        $categories = Category::all();

        // Get the selected category ID from the request
        $categoryId = $request->input('category');

        // If a category is selected, filter products by category
        if ($categoryId) {
            $products = Product::where('category_id', $categoryId)->paginate(10);
        } else {
            // Otherwise, show all products
            $products = Product::paginate(10);
        }

        // Return the view with categories and products
        return view('products.index', compact('products', 'categories'));
    }

    // Other methods (create, store, edit, update, destroy) can stay the same as they are not relevant to the filtering



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $categories = Category::all();
        // return view('admin.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name'=>'required|string|max:255',
        //     'description'=>'required|string|max:255',
        //     'stock' => 'required|integer|min:0',
        //     'price' => 'required|numeric|between:0,999999.99',
        //    'category_id' => 'required|exists:categories,id',


        // ]);

        // // Category::create($request->all());    OR
        // Product::create([
        //     'name'=>$request->name,
        //     'description'=>$request->description,
        //     'price'=>$request->price,
        //     'stock'=>$request->stock,
        //     'category_id' => $request->input('category_id'),

        // ]);

        // return redirect()->route('admin.products.index')->with('status','Product created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // return view('admin.products.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        // return view('admin.products.edit', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        // $request->validate([
        //     'name'=>'required|string|max:255',
        //     'description'=>'required|string|max:255',
        //     'stock' => 'required|integer|min:0',
        //     'price' => 'required|numeric|between:0,999999.99',

        // ]);

        // $product->update([
        //    'name'=>$request->name,
        //     'description'=>$request->description,
        //     'price'=>$request->price,
        //     'stock'=>$request->stock,

        // ]);

        // return redirect()->route('admin.products.index')->with('status', 'Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // $product->delete();
        // return redirect()->route('admin.products.index')->with('status', 'Product Deleted successfully');

    }
}
