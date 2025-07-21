<?php
// app/Http/Controllers/ExtraProductController.php
namespace App\Http\Controllers;

use App\Models\ExtraProduct;
use App\Models\ExtraProductPrice;
use App\Models\ExtraCategory;
use App\Models\ProductExtra;
use App\Models\DescriptionCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ExtraProductController extends Controller
{
    public function index(Request $request)
{
    $perPage = 10;
    $extraCategoryId = $request->input('extra_category_id');

    $query = ExtraProduct::withoutTrashed()->orderBy('sort_extra_products', 'asc')->with('category'); // Exclude soft-deleted records

    if ($extraCategoryId) {
        $query->where('category_id', $extraCategoryId);
    }

    $extraProducts = $query->paginate($perPage);
    $extraCategories = ExtraCategory::all(); // Fetch all extra categories

    return view('extra-products.index', compact('extraProducts', 'extraCategories', 'extraCategoryId'));
}

    

    public function create()
    {
        $categories = ExtraCategory::all();
        $descriptions = DescriptionCategory::where("isActive",0)->get();
        return view('extra-products.create', compact('categories','descriptions'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price.*' => 'required|numeric',
            'category_id' => 'required|exists:extra_categories,id',
        ]);
            $defaultPrice =  Arr::first($request->price);

$data = ["name"=> $request->name,"description"=>$request->description,"price"=>$defaultPrice,"category_id"=>$request->category_id];

$save=  ExtraProduct::create($data);
        foreach($request->price as $key => $price){
ExtraProductPrice::create(['extra_product_id'=>$save->id,'desc_id'=>$key,'price'=>$price]);
        }
        
        return redirect()->route('extra-products.index')->with('success', 'Extra Product created successfully');
    }

    public function show(ExtraProduct $extraProduct)
    {
        return view('extra-products.show', compact('extraProduct'));
    }

    public function edit(ExtraProduct $extraProduct)
    {
        
        $categories = ExtraCategory::all();
        $descriptions = DescriptionCategory::where("isActive",0)->get();
        return view('extra-products.edit', compact('extraProduct', 'categories','descriptions'));
    }

    public function update(Request $request, ExtraProduct $extraProduct)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price.*' => 'required|numeric',
            'category_id' => 'required|exists:extra_categories,id',
        ]);
 
             $defaultPrice =  Arr::first($request->price);

$data = ["name"=> $request->name,"description"=>$request->description,"price"=>$defaultPrice,"category_id"=>$request->category_id];




$extraProduct->update($data);


  foreach($request->price as $key => $price){
ExtraProductPrice::where("id",$key)->update(['price'=>$price]);
    }
        
        

        return redirect()->route('extra-products.index')->with('success', 'Extra Product updated successfully');
    }

    public function destroy(ExtraProduct $extraProduct)
{
    $extraProduct->delete();

    ExtraProductPrice::where("extra_product_id", $extraProduct->id)->delete();
    ProductExtra::where("extra_product_id", $extraProduct->id)->delete();

    return redirect()->route('extra-products.index')->with('success', 'Extra Product deleted successfully');
}


    public function sort(Request $request)
    {
        $order = $request->input('order');
        
        if (!$order || !is_array($order)) {
            \Log::error('Order not received or invalid: ', $order);
            return response()->json(['status' => 'error', 'message' => 'Invalid order data'], 400);
        }
    
        foreach ($order as $sortOrder => $id) {
            \Log::info("Updating extra category ID {$id} to sort order {$sortOrder}");
            ExtraProduct::where('id', $id)->update(['sort_extra_products' => $sortOrder]);
        }
    
        return response()->json(['status' => 'success']);
    }
    

}
