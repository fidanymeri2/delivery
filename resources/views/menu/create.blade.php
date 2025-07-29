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

<div class="py-12">
    <div class="mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-md">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-green-800">
                                    {{ session('success') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('menu.store') }}" method="POST">
                    <input type="hidden"  name="product_id" value="{{ request()->id }}" required>

                    @csrf
                    @php
                    $product = \App\Models\Product::where('id',request()->id )->first();
                    $productOption = \App\Models\ProductSize::select("description_categories.*")->where('product_id',request()->id )->join('description_categories',"description_categories.id","=","product_sizes.dimensions")->get();
                    @endphp

                    <!-- Header Card -->
                    <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center space-x-4">
                            <a href="{{ route('products.edit',request()->id) }}"
                               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Back
                            </a>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $product->name }}</h1>
                        </div>
                    </div>

                    <!-- Price Configuration Card -->
                    <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-6">Price Configuration</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($productOption as $desc)
                            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <label for="{{ $desc->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                    Price {{ $desc->name }}
                                </label>
                                <input type="number"
                                       step="any"
                                       id="{{ $desc->id }}"
                                       name="price[{{ $desc->id }}]"
                                       required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Menu Items Card -->
                    <div class="mb-8 bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-semibold text-gray-900">Menu Items</h2>
                            <button type="button"
                                    class="plus inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition ease-in-out duration-150"
                                    onclick="addMenuItem()">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Add Menu Item
                            </button>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <ul class="tree" id="menu-items"></ul>
                        </div>
                    </div>

                    <!-- Submit Button Card -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition ease-in-out duration-150">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Create Menu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let itemIndex = 0;

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
