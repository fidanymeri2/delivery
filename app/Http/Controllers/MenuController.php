<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Product;
use App\Models\MenuItem;
use App\Models\MenuPrice;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    
public function index()
{
        $menu = Menu::with(['items' => function($query) {
            $query->whereNull('item_parent_id');
        }, 'items.children'])->findOrFail(1);

        return $this->buildMenuTree($menu->items);
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
                'children' => $this->buildMenuTree($children)
            ];
        }
        return $tree;
    }


    public function edit(Request $request)
    {
        $menu = Menu::with(['items' => function($query) {
            $query->whereNull('item_parent_id');
        }, 'items.children'])->findOrFail($request->id);
        return view('menu.edit',compact('menu'));
    }


    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'product_id' => 'required',
        ]);
        
        $menu = Menu::create(['product_id' => $request->product_id]);
        Product::where('id',$request->product_id)->update(['isMenu'=>1]);
    
        foreach($request->price as $key => $price){
            MenuPrice::create(['menu_id'=>$menu->id,'desc_id'=>$key,'price'=>$price]);
        }
        
 
        $this->saveMenuItems($menu->id, $request->items);

        return redirect()->route('menu.edit',$menu->id)->with('success', 'Menu created successfully.');
    }



    public function storeEdit(Request $request)
    {
         $request->validate([
            'menu_id' => 'required',
        ]);
        
        //$menu = Menu::create(['product_id' => $request->product_id]);
        
        
        $id = $request->menu_id;
        
        $menu = Menu::findOrFail($id);


        $existingItems = $menu->items->pluck('id')->toArray();

        $submittedItems = $this->processMenuItems($menu->id, $request->items, null);

        $itemsToDelete = array_diff($existingItems, $submittedItems);

        if (!empty($itemsToDelete)) {
            MenuItem::destroy($itemsToDelete);
        }
    
    
        foreach($request->price as $key => $price){
            MenuPrice::where('menu_id',$request->menu_id)->where('desc_id',$key)->update(['price'=>$price]);
        }
        
 
        //$this->saveMenuItems($menu->id, $request->items);

        return redirect()->route('menu.edit',$request->menu_id)->with('success', 'Menu updated successfully.');
    }




private function processMenuItems($menuId, $items, $parentId = null)
{
    $processedItemIds = [];
if($items){
foreach ($items as $key => $item) {
        // Check if the item already exists (i.e., it's an update)
        if (isset($item['id'])) {
            $menuItem = MenuItem::findOrFail($item['id']);
            $menuItem->update([
                'item_name' => $item['name'],
                'item_select' => $item['select'] ?? 0,
                'item_parent_id' => $parentId,
            ]);
        } else {
            // Create a new item if it doesn't exist
            $menuItem = MenuItem::create([
                'menu_id' => $menuId,
                'item_name' => $item['name'],
                'item_select' => $item['select'] ?? 0,
                'item_parent_id' => $parentId,
            ]);
        }

        // Add the current item's ID to the processed list
        $processedItemIds[] = $menuItem->id;

         foreach ($item as $subKey => $subItem) {
                        if (is_array($subItem) && $subKey !== 'name') {
                           $childItemIds = $this->processMenuItems($menuId, [$subItem], $menuItem->id);
                                        $processedItemIds = array_merge($processedItemIds, $childItemIds);
                        }
             }
                    
     
    }
}
    return $processedItemIds;
}



    private function saveMenuItems($menuId, $items, $parentId = null)
{
    
        foreach ($items as $key => $item) {
            if (is_array($item)) {
                if (isset($item['name'])) {
                    // Create the menu item
                    $menuItem = MenuItem::create([
                        'menu_id' => $menuId,
                        'item_name' => $item['name'],
                        'item_select' => $item['select'] ?? 0,
                        'item_parent_id' => $parentId,
                    ]);

                    // Recursively process children if they exist
                    foreach ($item as $subKey => $subItem) {
                        if (is_array($subItem) && $subKey !== 'name') {
                            $this->saveMenuItems($menuId, [$subItem], $menuItem->id);
                        }
                    }
                }
            }
        }
    }

}
