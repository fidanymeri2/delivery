<?php
namespace App\Http\Controllers;

use App\Models\ExtraCategory;
use App\Models\ExtraProduct;
use App\Models\ProductExtra;
use Illuminate\Http\Request;

class ExtraCategoryController extends Controller
{
    public function index()
{
    $extraCategories = ExtraCategory::withoutTrashed() // Exclude soft-deleted records
        ->orderBy('sort_extra_categories', 'asc')
        ->with('category')
        ->paginate(10);

    return view('extra-categories.index', compact('extraCategories'));
}


    public function create()
    {
        return view('extra-categories.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        ExtraCategory::create($validatedData);

        return redirect()->route('extra-categories.index')->with('success', 'Extra Category created successfully');
    }

    public function show(ExtraCategory $extraCategory)
    {
        return view('extra-categories.show', compact('extraCategory'));
    }

    public function edit(ExtraCategory $extraCategory)
    {
        return view('extra-categories.edit', compact('extraCategory'));
    }

    public function update(Request $request, ExtraCategory $extraCategory)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
        ]);

        $extraCategory->update($validatedData);

        return redirect()->route('extra-categories.index')->with('success', 'Extra Category updated successfully');
    }

    public function destroy(ExtraCategory $extraCategory)
{
    $extraCategory->delete(); // Soft delete the extra category

    $extra = ExtraProduct::where("category_id", $extraCategory->id)->get();
    foreach ($extra as $e) {
        ProductExtra::where("extra_product_id", $e->id)->delete();
        $e->delete(); // Soft delete the extra product
    }

    return redirect()->route('extra-categories.index')->with('success', 'Extra Category deleted successfully');
}


    public function sort(Request $request)
    {
        $order = $request->input('order');
        
        if (!$order || !is_array($order)) {
            \Log::error('Order not received or invalid: ', $order);
            return response()->json(['status' => 'error', 'message' => 'Invalid order data'], 400);
        }
    
        foreach ($order as $sortOrder => $id) {
            \Log::info("Updating category ID {$id} to sort order {$sortOrder}");
            ExtraCategory::where('id', $id)->update(['sort_extra_categories' => $sortOrder]);
        }
    
        return response()->json(['status' => 'success']);
    }
}
