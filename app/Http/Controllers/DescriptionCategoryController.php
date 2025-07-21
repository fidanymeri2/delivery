<?php

namespace App\Http\Controllers;

use App\Models\DescriptionCategory;
use App\Models\ExtraProductPrice;
use App\Models\ExtraProduct;
use Illuminate\Http\Request;

class DescriptionCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = DescriptionCategory::where("isActive",0)->get();
        return view('description_categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('description_categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = $request->validate([
            'name' => 'required|string|max:255',
        ]);
 
        $getExtra = ExtraProduct::get();
        $create = DescriptionCategory::create($val);
        foreach($getExtra as $ex)
        {
            ExtraProductPrice::create(['extra_product_id' => $ex->id,'desc_id'=>$create->id,'price'=>0]);
        }

        return redirect()->route('description_categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(DescriptionCategory $descriptionCategory)
    {
        return view('description_categories.show', compact('descriptionCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DescriptionCategory $descriptionCategory)
    {
        return view('description_categories.edit', compact('descriptionCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DescriptionCategory $descriptionCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $descriptionCategory->update($request->all());

        return redirect()->route('description_categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DescriptionCategory $descriptionCategory)
    {
        $descriptionCategory->delete();
            
        ExtraProductPrice::where("desc_id",$descriptionCategory->id)->delete();
 
        return redirect()->route('description_categories.index')->with('success', 'Category deleted successfully.');
    }
}
