<x-app-layout>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9fafb;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            font-size: 1.5rem;
            color: #2854C5;
            margin: 1rem;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        input, select, textarea {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5rem;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
        }

        button {
            background-color: #2854C5;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 1rem;
        }

        button:hover {
            background-color: #1e3a8a;
        }
        .active-status {
            color: green;
        }
        .inactive-status {
            color: red;
        }
        .form-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .form-grid label {
            margin-bottom: 0.25rem;
        }

        .form-grid input, .form-grid select, .form-grid textarea {
            width: 100%;
        }

        .form-grid textarea {
            grid-column: span 2;
        }

        .form-grid .full-width {
            grid-column: span 2;
        }

        /* Custom Checkbox Styles */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
        }

        .checkbox-wrapper input[type="checkbox"] {
            display: none;
        }

        .checkbox-wrapper label {
            position: relative;
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .checkbox-wrapper label::before {
            content: '';
            display: inline-block;
            width: 34px;
            height: 20px;
            background-color: #ddd;
            border-radius: 50px;
            position: relative;
            transition: background-color 0.3s;
            margin-right: 10px;
        }

        .checkbox-wrapper label::after {
            content: '';
            display: block;
            width: 16px;
            height: 16px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 2px;
            left: 2px;
            transition: transform 0.3s;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::before {
            background-color: #2854C5;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::after {
            transform: translateX(14px);
        }

        .size-entry {
            position: relative;
        }

        .remove-size {
            position: absolute;
            top: 0;
            right: 0;
            background: #ff5c5c;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 0.25rem 0.5rem;
            cursor: pointer;
        }

        .remove-size:hover {
            background: #e04b4b;
        }
        .go-back-button {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ccc;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
            cursor: pointer;
            border-radius: 4px;
            margin-top: 1rem;
            text-decoration: none;
            display: inline-block;
        }

        .go-back-button:hover {
            background-color: #e0e0e0;
        }
        .extra-products-section {
            margin-top: 20px;
        }

        .extra-products-section label {
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .extra-products-section input[type="checkbox"] {
            margin-right: 10px;
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
        }

        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }
    </style>
@php 
$checkIfHasMenu  = \App\Models\Menu::where('product_id',$product->id)->first();

@endphp
<div class="form-container">
<h1>{{ __('product.edit_product') }}  @if($checkIfHasMenu) <button type="button"><a href="{{ route('menu.edit',$checkIfHasMenu->id) }}">{{ __('product.view_menu') }}</a></button>  @else <button type="button"><a href="{{ route('menu.create',$product->id) }}">{{ __('product.create_menu') }}</a></button> @endif</h1>



        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-grid">
        <div>
            <label for="category_id">{{ __('product.category') }}:</label>
            <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="category_id" id="category_id" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="name">{{ __('product.name') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required>
        </div>
  <div>
            <label for="allergies">{{ __('product.allergies') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="allergies" id="allergies" value="{{ old('allergies', $product->allergies) }}" >
</div>
  <div>
            <label for="product_code">{{ __('product.product_code') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="product_code" id="product_code" value="{{ old('product_code', $product->product_code) }}" required>
        </div>
        
        <div class="full-width">
            <label for="description">{{ __('product.description') }}:</label>
            <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="description" id="description">{{ old('description', $product->description) }}</textarea>
        </div>

        <div>
            <label for="image">{{ __('product.current_image') }}:</label>
            @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ __('product.current_image') }}" style="max-width: 100%; height: auto; margin-bottom: 1rem;">
            @endif
            <label for="image">{{ __('product.replace_image') }}:</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="new_product" id="new_product" value="1" {{ old('new_product', $product->new_product) ? 'checked' : '' }}>
        <label for="new_product">{{ __('product.new_product') }}</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="new_offers" id="new_offers" value="1" {{ old('new_offers', $product->new_offers) ? 'checked' : '' }}>
        <label for="new_offers">{{ __('product.new_offers') }}</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="suggested" id="suggested" value="1" {{ old('suggested', $product->suggested) ? 'checked' : '' }}>
        <label for="suggested">{{ __('product.suggested') }}</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="isMenu" id="isMenu" value="1" {{ old('isMenu', $product->isMenu) ? 'checked' : '' }}>
        <label for="isMenu">{{ __('product.menu') }}</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="checkbox" name="status" id="status" value="1" {{ old('status', $product->status) ? 'checked' : '' }}>
        <label for="status">{{ __('product.status') }}</label>
    </div>
    <div class="status-text" style="color: {{ $product->status == 1 ? 'green' : 'red' }};">
        {{ $product->status == 1 ? __('product.product_active') : __('product.product_inactive') }}
    </div>
</div>

<!-- Stock Management Section -->
<div class="full-width">
    <h3 class="text-lg font-semibold text-gray-700 mb-4 mt-6">Stock Management</h3>
    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="requires_stock" id="requires_stock" value="1" {{ old('requires_stock', $product->requires_stock) ? 'checked' : '' }}>
                <label for="requires_stock">Requires Stock Tracking</label>
            </div>
        </div>
        
        <div>
            <div class="checkbox-wrapper">
                <input type="checkbox" name="low_stock_alert" id="low_stock_alert" value="1" {{ old('low_stock_alert', $product->low_stock_alert) ? 'checked' : '' }}>
                <label for="low_stock_alert">Enable Low Stock Alerts</label>
            </div>
        </div>
    </div>
    
    <div id="stock-fields" class="grid grid-cols-2 gap-4 mt-4" style="display: {{ old('requires_stock', $product->requires_stock) ? 'grid' : 'none' }};">
        <div>
            <label for="current_stock">Current Stock:</label>
            <input type="number" name="current_stock" id="current_stock" min="0" value="{{ old('current_stock', $product->current_stock ?? 0) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <div>
            <label for="stock_unit">Stock Unit:</label>
            <select name="stock_unit" id="stock_unit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <optgroup label="Sasi (copë)">
                    <option value="copë" {{ old('stock_unit', $product->stock_unit) == 'copë' ? 'selected' : '' }}>copë</option>
                    <option value="porcion" {{ old('stock_unit', $product->stock_unit) == 'porcion' ? 'selected' : '' }}>porcion</option>
                    <option value="artikull" {{ old('stock_unit', $product->stock_unit) == 'artikull' ? 'selected' : '' }}>artikull</option>
                </optgroup>
                <optgroup label="Peshë (masa)">
                    <option value="gram" {{ old('stock_unit', $product->stock_unit) == 'gram' ? 'selected' : '' }}>gram (g)</option>
                    <option value="kilogram" {{ old('stock_unit', $product->stock_unit) == 'kilogram' ? 'selected' : '' }}>kilogram (kg)</option>
                </optgroup>
                <optgroup label="Vëllim (lëngje)">
                    <option value="litër" {{ old('stock_unit', $product->stock_unit) == 'litër' ? 'selected' : '' }}>litër (L)</option>
                    <option value="mililitër" {{ old('stock_unit', $product->stock_unit) == 'mililitër' ? 'selected' : '' }}>mililitër (ml)</option>
                    <option value="decilitër" {{ old('stock_unit', $product->stock_unit) == 'decilitër' ? 'selected' : '' }}>decilitër (dl)</option>
                </optgroup>
                <optgroup label="Njësi pakete">
                    <option value="shishe" {{ old('stock_unit', $product->stock_unit) == 'shishe' ? 'selected' : '' }}>shishe</option>
                    <option value="kuti" {{ old('stock_unit', $product->stock_unit) == 'kuti' ? 'selected' : '' }}>kuti</option>
                    <option value="thes" {{ old('stock_unit', $product->stock_unit) == 'thes' ? 'selected' : '' }}>thes</option>
                </optgroup>
                <optgroup label="Njësi konsumi">
                    <option value="lugë" {{ old('stock_unit', $product->stock_unit) == 'lugë' ? 'selected' : '' }}>lugë</option>
                    <option value="filxhan" {{ old('stock_unit', $product->stock_unit) == 'filxhan' ? 'selected' : '' }}>filxhan</option>
                    <option value="gotë" {{ old('stock_unit', $product->stock_unit) == 'gotë' ? 'selected' : '' }}>gotë</option>
                </optgroup>
            </select>
        </div>
        
        <div>
            <label for="min_stock_level">Minimum Stock Level:</label>
            <input type="number" name="min_stock_level" id="min_stock_level" min="0" value="{{ old('min_stock_level', $product->min_stock_level ?? 0) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <div>
            <label for="max_stock_level">Maximum Stock Level (Optional):</label>
            <input type="number" name="max_stock_level" id="max_stock_level" min="0" value="{{ old('max_stock_level', $product->max_stock_level) }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    </div>
</div>


<input type="hidden" id="deleted-options" name="deleted_options" value="">


    </div>

    <div id="sizes-container">

    @foreach ($product->sizes as $index => $size)
                <div class="grid grid-cols-2 gap-4 size-entry" data-index="{{ $index }}">

        <div  >
      
            <label for="price-{{ $index }}">Price:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="number" name="sizes[{{ $index }}][price]" id="price-{{ $index }}" value="{{ $size->price }}" step="0.01" required></div>
                    <div >

            <label for="dimensions-{{ $index }}" class="block">Description:</label>
<select   name="sizes[{{ $index }}][dimensions]" id="dimensions-{{ $index }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @foreach($desc as $de)
<option @if($size->dimensions == $de->id) selected @endif value="{{ $de->id }}">{{ $de->name }}</option>
@endforeach 
</select>

         
                        <button type="button" class="remove-size">Remove</button>

            </div>
            </div>

    @endforeach
    </div>

    <button type="button" id="add-size-button">Add Another Size</button>



<br/><br/>
@php
    $options = App\Models\ProductOptionOptional::where('product_id', $product->id)->get();
    $opts = App\Models\ProductSize::select('description_categories.*')->where('product_id', $product->id)->leftJoin('description_categories','description_categories.id','=','product_sizes.dimensions')->get();

@endphp
<div id="inputs-container">
<label>Option Max Select</label>
    <input type="text" name="max_checked" value="{{ $product->max_checked }}" class="form-control" placeholder="Option Max Select"><br/><br/>
    @foreach ($options as $index => $option)
        <div class="input-group mb-3" style="display:flex;gap:5px;">
            <input type="text" name="options[{{ $index }}][name]" value="{{ $option->name }}" class="form-control" placeholder="Option Name">
<input type="hidden" name="options[{{ $index }}][id]" value="{{ $option->id }}">
<select name="options[{{ $index }}][desc_id]">
@foreach($opts as $opt)
<option @if($option->desc_id ==  $opt->id) selected @endif  value="{{ $opt->id }}">{{ $opt->name }}</option>
@endforeach
</select>
                       
            <button class="btn btn-danger remove-input">Remove</button>
        </div>
    @endforeach
</div>

<button id="add-input-btn">Add New Product Option</button>
    <div class="extra-products-section">
    <h3>Extra Products by Category</h3>

    @php
        $categories = \App\Models\ExtraCategory::with('extraProducts')->get();
    @endphp

    @foreach ($categories as $category)
        <h4>{{ $category->name }}</h4>
          <div class="select-all">
            <input type="checkbox" id="select_all_{{ $category->id }}" class="select-all-checkbox">
            <label for="select_all_{{ $category->id }}">Select All</label>
        </div>
        <div class="table-responsive text-center">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Product Name</th>
@foreach($opts as $de)
<th>Price - {{ $de->name }}</th>
@endforeach 

<th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->extraProducts as $extraProduct)
                        <tr>
                            <td>{{ $extraProduct->name }}</td>
                                                        @foreach($opts as $de)
<?php $deprice = \App\Models\ExtraProductPrice::where('desc_id',$de->id)->where('extra_product_id',$extraProduct->id)->first(); ?>
                            <td>{{ number_format($deprice->price,2) }} € </td>
                            @endforeach 
                            <td>
                                <input type="checkbox" name="extra_products[]" value="{{ $extraProduct->id }}" id="extra_product_{{ $category->id }}_{{ $extraProduct->id }}"
                                    {{ in_array($extraProduct->id, $product->extraProducts->pluck('id')->toArray()) ? 'checked' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</div>



    <button type="submit">Update Product</button>
    <a href="{{ route('products.index') }}" class="go-back-button">Go Back</a>
</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>

$(document).ready(function() {
    let inputCount = {{ $options->count() }};
            var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";
            var opts = "<?php foreach($opts as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

    $('#add-input-btn').click(function(e) {
        e.preventDefault();

        inputCount++;
        let newInput = `<div class="input-group  mb-3" style="display:flex;gap:5px;">
<input type="text" name="options[${inputCount}][name]" class="form-control" placeholder="Option Name">
    
<select name="options[${inputCount}][desc_id]">${opts}</select>
                            <button class="btn btn-danger remove-input">Remove</button>
                        </div>`;
        $('#inputs-container').append(newInput);
    });

    // Remove input field
      $(document).on('click', '.remove-input', function(e) {
        e.preventDefault();
        let inputGroup = $(this).closest('.input-group');
        let optionId = inputGroup.find('input[name*="[id]"]').val();

        if (optionId) {
            let deletedOptions = $('#deleted-options').val();
            $('#deleted-options').val(deletedOptions + optionId + ',');
        }

        inputGroup.remove();
    });
});
            var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

            document.addEventListener('DOMContentLoaded', function() {
                let index = {{ count($product->sizes) }}; 
                const sizesContainer = document.getElementById('sizes-container');
                const addSizeButton = document.getElementById('add-size-button');

                addSizeButton.addEventListener('click', function() {
                    // Create a new size entry
                    const newSizeEntry = document.createElement('div');
                    newSizeEntry.classList.add('size-entry');
                    newSizeEntry.classList.add('grid');
                    newSizeEntry.classList.add('grid-cols-2');
                    newSizeEntry.classList.add('gap-4');
                    newSizeEntry.setAttribute('data-index', index);

                    newSizeEntry.innerHTML = `
                      <div
                        <label for="price-${index}">Price:</label>
                        <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="number" name="sizes[${index}][price]" id="price-${index}" step="0.01" required></div>

                <div>
                    <label for="dimensions-${index}" class="block">Description </label>
                            <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                ${options}
                            </select>
                    
                        <button type="button" class="remove-size">Remove</button></div>
                    `;

                    sizesContainer.appendChild(newSizeEntry);
                    index++;
                });

                sizesContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-size')) {
                        const sizeEntry = event.target.closest('.size-entry');
                        sizesContainer.removeChild(sizeEntry);
                    }
                });
            });
            
            
        document.addEventListener('DOMContentLoaded', function () {
    // Attach event listeners to each "Select All" checkbox
    document.querySelectorAll('.select-all-checkbox').forEach(selectAllCheckbox => {
        selectAllCheckbox.addEventListener('change', function () {
            // Get the category ID from the checkbox ID
            const categoryId = this.id.split('_').pop();

            // Select or deselect all checkboxes in the table rows under this category
            document.querySelectorAll(`input[type="checkbox"][id^="extra_product_${categoryId}_"]`).forEach(productCheckbox => {
                productCheckbox.checked = this.checked;
            });
        });
    });
    
    // Stock management toggle
    const requiresStockCheckbox = document.getElementById('requires_stock');
    const stockFields = document.getElementById('stock-fields');
    
    if (requiresStockCheckbox && stockFields) {
        requiresStockCheckbox.addEventListener('change', function() {
            if (this.checked) {
                stockFields.style.display = 'grid';
            } else {
                stockFields.style.display = 'none';
            }
        });
    }
});

        </script>
<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const img = new Image();

        // Check file size (not more than 1MB)
        const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
        if (file.size > maxSizeInBytes) {
            alert('The uploaded image must not exceed 1MB.');
            event.target.value = ''; // Reset the file input
            return;
        }

        img.onload = function() {
            const width = img.width;
            const height = img.height;

            // Check for specific resolution range
            if (width < 800 || width > 1000 || height < 800 || height > 1000) {
                alert('The image resolution must be between 800x800 and 1000x1000 pixels.');
                event.target.value = ''; // Reset the file input
            }
        };

        if (file) {
            img.src = URL.createObjectURL(file);
        }
    });
</script>



    </div>
</x-app-layout>
