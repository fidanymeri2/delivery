<x-app-layout>
<style>
.menu-items{width:20px;
    
}
.inp{
    height:25px;
    
}
.tree,
.tree ul {
  margin:0 0 0 1em; /* indentation */
  padding:0;
  list-style:none;
  color:#369;
  position:relative;
}

.tree ul {margin-left:.5em} /* (indentation/2) */

.tree:before,
.tree ul:before {
  content:"";
  display:block;
  width:0;
  position:absolute;
  top:0;
  bottom:0;
  left:0;
  border-left:1px solid;
}

.tree li {
  margin:0;
  padding:0 2em; /* indentation + .5em */
  line-height:2em; /* default list item's `line-height` */
  font-weight:bold;
  position:relative;
}

.tree li:before {
  content:"";
  display:block;
  width:25px; /* same with indentation */
  height:0;
  border-top:1px solid;
  margin-top:-1px; /* border top width */
  position:absolute;
  top:1em; /* (line-height/2) */
  left:0;
}

.tree li:last-child:before {
  background:white; /* same with body background */
  height:auto;
  top:1em; /* (line-height/2) */
  bottom:0;
}
.plus{
Background-color:#ddd;padding:3px 10px;
border-radius:25px;
}
.row{
Display:flex;gap:25px;
}
</style>
<form action="{{ route('menu.storeEdit') }}" method="POST">
                    <input type="hidden"  name="menu_id" value="{{ request()->id }}" required>

@csrf
@php
$product = \App\Models\Product::where('id',$menu->product_id )->first();

$productOption = \App\Models\ProductSize::select("description_categories.*")->where('product_id',$menu->product_id  )->join('description_categories',"description_categories.id","=","product_sizes.dimensions")->get();
@endphp
<h1 style="font-size:26px; font-weight:bold;"><a href="{{ route('products.edit',$menu->product_id) }}">❮</a> {{ $product->name }}<h1><br/>

<div class="row">       <!-- Menu name -->

@foreach($productOption as $desc)
@php

$price = \App\Models\MenuPrice::where("menu_id",request()->id)->where("desc_id",$desc->id)->first();
@endphp
<div class="col-md-4">
            <label for="{{ $desc->id }}">Price {{ $desc->name }} </label>
            <input type="number" step="any"  id="{{ $desc->id }}" name="price[{{ $desc->id }}]" value="{{ number_format($price ? $price->price : 0,2) }}" required>
</div>
@endforeach

        
</div>
        <hr>

        <!-- Menu Items --><br/>
<h2>Menu Items <button type="button" class="plus" onclick="addMenuItem()">&#43;</button></h2>
        <ul class="tree" id="menu-items">
            @foreach($menu->items as $item)
                @include('menu.menu-item', ['item' => $item, 'parentIndices' => []])
            @endforeach
        </ul>

        <!-- Add new menu item -->
        

        <!-- Submit --><br/><br/>
        <button type="submit">Save Menu</button>
    </form>

<script> 
let itemIndex = {{ $menu->items->count() }}; // Continue counting from existing items

function addMenuItem(parentIndices = []) {
    const newIndex = itemIndex++;
    const parentPath = parentIndices.length ? `[${parentIndices.join('][')}]` : '';
    const container = parentIndices.length ? `nested-items-${parentIndices.join('-')}` : 'menu-items';
    // Create the new item HTML
    const newItem = `
        <li id="menu-item-${[...parentIndices, newIndex].join('-')}">
            <div style='display:flex;gap:25px;'>
                <div>
                    <label for="items${parentPath}[${newIndex}][name]">Item Name:</label><br/>
                    <input class="inp" type="text" name="items${parentPath}[${newIndex}][name]" required>
                </div>
                <div class="sc"></div>
                <div><br/>          
                    <button type="button" onclick="addMenuItem([${[...parentIndices, newIndex].join(',')}]), addExToParent([${[...parentIndices, newIndex].join(',')}],'${parentPath}[${newIndex}]')">Add Option</button> | 
                    <button type="button" class="remove-button" onclick="removeMenuItem('${[...parentIndices, newIndex].join('-')}')">Remove</button>
                </div>
            </div>
            <ul id="nested-items-${[...parentIndices, newIndex].join('-')}"></ul>
        </li>
    `;

    // Insert the new item into the appropriate container
    document.getElementById(container).insertAdjacentHTML('beforeend', newItem);
}

function removeMenuItem(itemId) {
    const item = document.getElementById(`menu-item-${itemId}`);
    if (item) {
        item.remove();
    }
} 

function addExToParent(parentIndices,name) {
    const parentPath = parentIndices.length ? `[${parentIndices.join('][')}]` : '';
    const parentId = `menu-item-${parentIndices.join('-')}`;
    const parentElement = document.getElementById(parentId);
    
    // Ensure parent element exists
    if (parentElement) {
        // Check if the additional input already exists
        if (!parentElement.querySelector('.select')) {
            const exText = `
                <div class="select">
                    <label for="items${name}[select]">Select:</label><br/>
                    <input class="inp" type="number" value="1" name="items${name}[select]">
                </div>
            `;

            // Append the new input
            parentElement.querySelector('.sc').insertAdjacentHTML('beforeend', exText);
        }
    }
}


</script>
</x-app-layout>
