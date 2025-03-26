<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(2);
        return view('admin.category.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'nullable',

        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;

            $path = 'uploads/category'; // Directory inside public/
            $file->move(public_path($path), $filename); // Move to public/uploads/category

            $imagePath = $path . '/' . $filename; // Correct path format
        }

        // Category::create($request->all());    OR
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
           'image' => $imagePath,
            'status' => $request->status == true ? 1 : 0,

        ]);

        return redirect()->route('admin.category.index')->with('status', 'Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg',
            'status' => 'nullable',
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $path = 'uploads/category';

            // Move new image to public path
            $file->move(public_path($path), $filename);

            // Delete the old image (optional)
            if ($category->image && file_exists(public_path($category->image))) {
                unlink(public_path($category->image));
            }

            $category->image = $path . '/' . $filename; // Update image path
        }

        // Update other fields
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status == true ? 1 : 0,
            'image' => $category->image, // Keep old image if not changed
        ]);

        return redirect()->route('admin.category.index')->with('status', 'Category updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.category.index')->with('status', 'Category Deleted successfully');
    }
}
