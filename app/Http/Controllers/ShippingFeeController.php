<?php

namespace App\Http\Controllers;

use App\Models\ShippingFee;
use Illuminate\Http\Request;

class ShippingFeeController extends Controller
{
    public function index(Request $request)
    {
      
        $shippingFees = ShippingFee::orderBy("id", "DESC");
        if ($request->isJson()) {
            $shippingFees = $shippingFees->get(); 
            return response()->json($shippingFees);
        }
        $shippingFees = $shippingFees->paginate(10); 
        return view('shipping-fees.index', compact('shippingFees'));
    }
    

    public function create()
    {
        return view('shipping-fees.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'nullable|string',
            'postal_code' => 'required|string|max:10',
            'fee' => 'required|numeric|min:0',
            'minimal_fee' => 'nullable|numeric|min:0'
        ]);

        ShippingFee::create($request->all());

        return redirect()->route('shipping-fees.index')->with('success', 'Shipping Fee created successfully.');
    }

    public function edit($id)
    {
        $shippingFee = ShippingFee::findOrFail($id);

        return view('shipping-fees.edit', compact('shippingFee'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'nullable|string',
            'postal_code' => 'required|string|max:10',
            'fee' => 'required|numeric|min:0',
            'minimal_fee' => 'nullable|numeric|min:0'
        ]);

        $shippingFee = ShippingFee::findOrFail($id);
        $shippingFee->update($request->all());

        return redirect()->route('shipping-fees.index')->with('success', 'Shipping Fee updated successfully.');
    }

    public function destroy($id)
    {
        $shippingFee = ShippingFee::findOrFail($id);
        $shippingFee->delete();

        return redirect()->route('shipping-fees.index')->with('success', 'Shipping Fee deleted successfully.');
    }
}
