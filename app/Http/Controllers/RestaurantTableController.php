<?php

namespace App\Http\Controllers;

use App\Models\RestaurantTable;
use App\Models\TableCategory;
use App\Models\TablePosition;
use Illuminate\Http\Request;

class RestaurantTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = RestaurantTable::with('category');
        
        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('table_category_id', $request->category);
        }
        
        $tables = $query->orderBy('sort_order')->get();
        
        // Get categories for the filter dropdown
        $categories = TableCategory::where('status', 'active')->get();
        
        return view('restaurant-tables.index', compact('tables', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $categories = TableCategory::where('status', 'active')->get();
        $selectedCategory = $request->get('category');
        return view('restaurant-tables.create', compact('categories', 'selectedCategory'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_category_id' => 'required|exists:table_categories,id',
            'table_number' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'capacity' => 'required|integer|min:1|max:20',
            'notes' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        RestaurantTable::create($request->all());

        return redirect()->route('restaurant-tables.index')
            ->with('success', 'Restaurant table created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTable $restaurantTable)
    {
        return view('restaurant-tables.show', compact('restaurantTable'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantTable $restaurantTable)
    {
        $categories = TableCategory::where('status', 'active')->get();
        return view('restaurant-tables.edit', compact('restaurantTable', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantTable $restaurantTable)
    {
        $request->validate([
            'table_category_id' => 'required|exists:table_categories,id',
            'table_number' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'capacity' => 'required|integer|min:1|max:20',
            'notes' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $restaurantTable->update($request->all());

        return redirect()->route('restaurant-tables.index')
            ->with('success', 'Restaurant table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantTable $restaurantTable)
    {
        $restaurantTable->delete();

        return redirect()->route('restaurant-tables.index')
            ->with('success', 'Restaurant table deleted successfully.');
    }

    // API Methods
    public function apiIndex()
    {
        $tables = RestaurantTable::with('category')->orderBy('sort_order')->get();
        return response()->json([
            'success' => true,
            'data' => $tables
        ]);
    }

    public function apiShow(RestaurantTable $table)
    {
        return response()->json([
            'success' => true,
            'data' => $table->load(['category', 'orders', 'activeOrder'])
        ]);
    }

    public function apiStore(Request $request)
    {
        $request->validate([
            'table_category_id' => 'required|exists:table_categories,id',
            'table_number' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'capacity' => 'required|integer|min:1|max:20',
            'notes' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $table = RestaurantTable::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Restaurant table created successfully',
            'data' => $table->load('category')
        ], 201);
    }

    public function apiUpdate(Request $request, RestaurantTable $table)
    {
        $request->validate([
            'table_category_id' => 'required|exists:table_categories,id',
            'table_number' => 'required|string|max:255',
            'status' => 'required|in:available,occupied,reserved,maintenance',
            'capacity' => 'required|integer|min:1|max:20',
            'notes' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        $table->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Restaurant table updated successfully',
            'data' => $table->load('category')
        ]);
    }

    public function apiDestroy(RestaurantTable $table)
    {
        $table->delete();

        return response()->json([
            'success' => true,
            'message' => 'Restaurant table deleted successfully'
        ]);
    }

    public function getTablesByCategory($categoryId)
    {
        $tables = RestaurantTable::where('table_category_id', $categoryId)
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tables
        ]);
    }

    public function updateTableStatus(Request $request, RestaurantTable $table)
    {
        $request->validate([
            'status' => 'required|in:available,occupied,reserved,maintenance',
        ]);

        $table->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'Table status updated successfully',
            'data' => $table->load('category')
        ]);
    }

    public function getAvailableTables()
    {
        $tables = RestaurantTable::where('status', 'available')
            ->with('category')
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tables
        ]);
    }

    public function getOccupiedTables()
    {
        $tables = RestaurantTable::where('status', 'occupied')
            ->with(['category', 'activeOrder'])
            ->orderBy('sort_order')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $tables
        ]);
    }

    public function showCategory($categoryId)
    {
        $category = TableCategory::findOrFail($categoryId);
        $tables = RestaurantTable::where('table_category_id', $categoryId)
                                ->with('category')
                                ->orderBy('sort_order')
                                ->get();
        
        return view('restaurant-tables.show-category', compact('category', 'tables'));
    }

    public function reposition($categoryId)
    {
        $category = TableCategory::findOrFail($categoryId);
        $tables = RestaurantTable::where('table_category_id', $categoryId)
                                ->with(['category', 'positions' => function($query) use ($categoryId) {
                                    $query->where('table_category_id', $categoryId);
                                }])
                                ->orderBy('sort_order')
                                ->get();
        
        return view('restaurant-tables.reposition', compact('category', 'tables'));
    }

    public function savePositions(Request $request)
    {
        try {
            // Log the incoming request for debugging
            \Log::info('Save positions request method:', ['method' => $request->method()]);
            \Log::info('Save positions request headers:', $request->headers->all());
            \Log::info('Save positions request body:', $request->all());
            \Log::info('Save positions request JSON:', $request->json()->all());
            
            // Check if request is JSON
            if ($request->isJson()) {
                $data = $request->json()->all();
            } else {
                $data = $request->all();
            }
            
            \Log::info('Processed data:', $data);
            
            $request->validate([
                'category_id' => 'required|exists:table_categories,id',
                'positions' => 'required|array',
                'positions.*.table_id' => 'required|exists:restaurant_tables,id',
                'positions.*.x' => 'required|integer|min:0',
                'positions.*.y' => 'required|integer|min:0',
                'positions.*.width' => 'required|integer|min:50|max:300',
                'positions.*.height' => 'required|integer|min:50|max:300',
                'positions.*.z_index' => 'required|integer|min:0',
            ]);

            $categoryId = $request->category_id;
            
            foreach ($request->positions as $positionData) {
                TablePosition::updateOrCreate(
                    [
                        'restaurant_table_id' => $positionData['table_id'],
                        'table_category_id' => $categoryId,
                    ],
                    [
                        'x_position' => $positionData['x'],
                        'y_position' => $positionData['y'],
                        'width' => $positionData['width'],
                        'height' => $positionData['height'],
                        'z_index' => $positionData['z_index'],
                        'is_active' => true,
                    ]
                );
            }

            return response()->json([
                'success' => true,
                'message' => 'Table positions saved successfully'
            ]);
        } catch (\Exception $e) {
            \Log::error('Error saving table positions: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return response()->json([
                'success' => false,
                'message' => 'Error saving table positions: ' . $e->getMessage()
            ], 500);
        }
    }

    public function testSave(Request $request)
    {
        try {
            \Log::info('Test save request received');
            \Log::info('Request method:', ['method' => $request->method()]);
            \Log::info('Request headers:', $request->headers->all());
            \Log::info('Request body:', $request->all());
            
            return response()->json([
                'success' => true,
                'message' => 'Test save successful',
                'data' => $request->all()
            ]);
        } catch (\Exception $e) {
            \Log::error('Test save error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Test save error: ' . $e->getMessage()
            ], 500);
        }
    }
}
