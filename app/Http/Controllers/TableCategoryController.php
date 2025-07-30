<?php

namespace App\Http\Controllers;

use App\Models\TableCategory;
use Illuminate\Http\Request;

class TableCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = TableCategory::with('tables')->orderBy('sort_order')->get();
        return view('table-categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('table-categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        TableCategory::create($request->all());

        return redirect()->route('table-categories.index')
            ->with('success', 'Table category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TableCategory $tableCategory)
    {
        return view('table-categories.show', compact('tableCategory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TableCategory $tableCategory)
    {
        return view('table-categories.edit', compact('tableCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TableCategory $tableCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $tableCategory->update($request->all());

        return redirect()->route('table-categories.index')
            ->with('success', 'Table category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TableCategory $tableCategory)
    {
        $tableCategory->delete();

        return redirect()->route('table-categories.index')
            ->with('success', 'Table category deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $categories = TableCategory::with('tables')->orderBy('sort_order')->get();
        return response()->json([
            'success' => true,
            'data' => $categories
        ]);
    }

    public function apiShow(TableCategory $category)
    {
        return response()->json([
            'success' => true,
            'data' => $category->load('tables')
        ]);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category = TableCategory::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Table category created successfully',
            'data' => $category
        ], 201);
    }

    public function apiUpdate(Request $request, TableCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $category->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Table category updated successfully',
            'data' => $category
        ]);
    }

    public function apiDestroy(TableCategory $category)
    {
        $category->delete();

        return response()->json([
            'success' => true,
            'message' => 'Table category deleted successfully'
        ]);
    }
}
