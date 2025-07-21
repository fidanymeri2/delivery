<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withoutTrashed()->orderBy("id", "ASC")->get();
    
        if ($request->isJson()) {
            return response()->json($categories);
        }
    
        return view('categories.index', compact('categories'));
    }
    

    public function create(Request $request)
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        $category->delete(); 
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
    

    public function sort(Request $request)
{
    $order = $request->input('order');

    if (!$order || !is_array($order)) {
        \Log::error('Order not received or invalid', ['order' => $order]);
        return response()->json(['status' => 'error', 'message' => 'Invalid order data'], 400);
    }

    try {
        foreach ($order as $sortOrder => $id) {
            \Log::info("Updating category ID {$id} to sort order {$sortOrder}");
            Category::where('id', $id)->update(['sort_categories' => $sortOrder]);
        }
        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        \Log::error('Error updating sort order', ['error' => $e->getMessage()]);
        return response()->json(['status' => 'error', 'message' => 'Failed to update order'], 500);
    }
}

}
