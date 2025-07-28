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
            display: block;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .form-grid input,
        .form-grid select,
        .form-grid textarea {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5rem;
            width: 100%;
            box-sizing: border-box;
        }

        .form-grid textarea {
            height: 100px;
        }

        .form-grid .full-width {
            grid-column: span 2;
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
            padding-left: 40px;
        }

        .checkbox-wrapper label::before {
            content: '';
            display: inline-block;
            width: 34px;
            height: 20px;
            background-color: #ddd;
            border-radius: 50px;
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            transition: background-color 0.3s;
        }

        .checkbox-wrapper label::after {
            content: '';
            display: block;
            width: 16px;
            height: 16px;
            background-color: #fff;
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 2px;
            transform: translateY(-50%);
            transition: transform 0.3s;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::before {
            background-color: #2854C5;
        }

        .checkbox-wrapper input[type="checkbox"]:checked + label::after {
            transform: translateX(14px) translateY(-50%);
        }
        .extra-products-section {
    padding: 20px;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Creates a 3-column grid */
    gap: 20px; /* Space between items */
}

.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 15px;
    text-align: center;
    background-color: #f9f9f9;
}

.product-card h4 {
    margin-top: 0;
    font-size: 1.2em;
}

.product-card p {
    font-size: 1em;
    margin: 10px 0;
}

.product-card input[type="checkbox"] {
    margin-right: 5px;
}

.product-card label {
    font-size: 0.9em;
}

.select-all {
    margin-bottom: 10px;
}

.select-all input[type="checkbox"] {
    margin-right: 5px;
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

    <div class="form-container">
        <h1>Create Product</h1>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data" >
            @csrf

            <div class="form-grid">
                <div>
                    <label for="category_id">Category:</label>
                    <select class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="category_id" id="category_id" required>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="name">{{ __('product.name') }}:</label>
                    <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="name" id="name" required>
                </div>

                <div class="full-width">
                    <label for="description">{{ __('product.description') }}:</label>
                    <textarea class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="description" id="description"></textarea>
                </div>
                <div>
                    <label for="allergies">{{ __('product.allergies') }}:</label>
                    <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" type="text" name="allergies" id="allergies" required>
                </div>

                <div>
    <label for="image">{{ __('product.upload_image') }}:</label>
    <input type="file" name="image" id="image">
</div>

                <div class="full-width">
    <div class="checkbox-wrapper">
        <input type="hidden" name="new_product" value="0">
        <input type="checkbox" name="new_product" id="new_product" value="1">
        <label for="new_product">{{ __('product.new_product') }}</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="hidden" name="new_offers" value="0">
        <input type="checkbox" name="new_offers" id="new_offers" value="1">
        <label for="new_offers">{{ __('product.new_offers') }}</label>
    </div>
</div>

<div class="full-width">
    <div class="checkbox-wrapper">
        <input type="hidden" name="suggested" value="0">
        <input type="checkbox" name="suggested" id="suggested" value="1">
        <label for="suggested">{{ __('product.suggested') }}</label>
    </div>
</div>

<!-- Stock Management Section -->
<div class="full-width">
    <h3 class="text-lg font-semibold text-gray-700 mb-4 mt-6">{{ __('product.stock_management') }}</h3>
    
    <div class="grid grid-cols-2 gap-4">
        <div>
            <div class="checkbox-wrapper">
                <input type="hidden" name="requires_stock" value="0">
                <input type="checkbox" name="requires_stock" id="requires_stock" value="1">
                <label for="requires_stock">{{ __('product.requires_stock_tracking') }}</label>
            </div>
        </div>
        
        <div>
            <div class="checkbox-wrapper">
                <input type="hidden" name="low_stock_alert" value="0">
                <input type="checkbox" name="low_stock_alert" id="low_stock_alert" value="1">
                <label for="low_stock_alert">{{ __('product.enable_low_stock_alerts') }}</label>
            </div>
        </div>
    </div>
    
    <div id="stock-fields" class="grid grid-cols-2 gap-4 mt-4" style="display: none;">
        <div>
            <label for="current_stock">{{ __('product.current_stock') }}:</label>
            <input type="number" name="current_stock" id="current_stock" min="0" value="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <div>
            <label for="stock_unit">{{ __('product.stock_unit') }}:</label>
            <select name="stock_unit" id="stock_unit" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                <optgroup label="Sasi (copë)">
                    <option value="copë">copë</option>
                    <option value="porcion">porcion</option>
                    <option value="artikull">artikull</option>
                </optgroup>
                <optgroup label="Peshë (masa)">
                    <option value="gram">gram (g)</option>
                    <option value="kilogram">kilogram (kg)</option>
                </optgroup>
                <optgroup label="Vëllim (lëngje)">
                    <option value="litër">litër (L)</option>
                    <option value="mililitër">mililitër (ml)</option>
                    <option value="decilitër">decilitër (dl)</option>
                </optgroup>
                <optgroup label="Njësi pakete">
                    <option value="shishe">shishe</option>
                    <option value="kuti">kuti</option>
                    <option value="thes">thes</option>
                </optgroup>
                <optgroup label="Njësi konsumi">
                    <option value="lugë">lugë</option>
                    <option value="filxhan">filxhan</option>
                    <option value="gotë">gotë</option>
                </optgroup>
            </select>
        </div>
        
        <div>
            <label for="min_stock_level">{{ __('product.min_stock_level') }}:</label>
            <input type="number" name="min_stock_level" id="min_stock_level" min="0" value="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        
        <div>
            <label for="max_stock_level">{{ __('product.max_stock_level') }} ({{ __('product.optional') }}):</label>
            <input type="number" name="max_stock_level" id="max_stock_level" min="0" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
    </div>
</div>

            </div>

            <div id="sizes-container" class="mt-4">
    <div class="grid grid-cols-2 gap-4 size-entry" data-index="0">
        <div>
            <label for="price-0" class="block">{{ __('product.price') }}:</label>
            <input type="number" name="sizes[0][price]" step="any" id="price-0" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
        </div>
        <div>
            <label for="dimensions-0" class="block">{{ __('product.description') }}:</label>
<select  name="sizes[0][dimensions]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    @foreach($desc as $de)
<option value="{{ $de->id }}">{{ $de->name }}</option>
@endforeach 
</select>
        </div>
    </div>
</div>


            <button type="button" id="add-size-button">{{ __('product.add_size') }}</button> <br>

       


            <button type="submit">{{ __('product.create_product') }}</button>
        </form>

<script>

    var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";
        
        document.addEventListener('DOMContentLoaded', function() {
            let index = 1; // Start with index 1 since index 0 is already in the form
            const sizesContainer = document.getElementById('sizes-container');
            const addSizeButton = document.getElementById('add-size-button');

            addSizeButton.addEventListener('click', function() {
                // Create a new size entry
                const newSizeEntry = document.createElement('div');
                newSizeEntry.classList.add('grid', 'grid-cols-2', 'gap-4', 'size-entry');
                newSizeEntry.setAttribute('data-index', index);

                newSizeEntry.innerHTML = `
                    <div>
                        <label for="price-${index}" class="block">{{ __('product.price') }}:</label>
                        <input type="number" name="sizes[${index}][price]" step="any" id="price-${index}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label for="dimensions-${index}" class="block">{{ __('product.description') }}</label>
                            <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                ${options}
                            </select>
                    </div>
                    
                `;

                sizesContainer.appendChild(newSizeEntry);
                index++;
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
    </div>
</x-app-layout>

<script>
    document.getElementById('image').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const img = new Image();

        // Check file size (not more than 1MB)
        const maxSizeInBytes = 1 * 1024 * 1024; // 1MB
        if (file.size > maxSizeInBytes) {
            alert('{{ __('product.image_size_error') }}');
            event.target.value = ''; // Reset the file input
            return;
        }

        img.onload = function() {
            const width = img.width;
            const height = img.height;

            // Check for specific resolution range
            if (width < 800 || width > 1000 || height < 800 || height > 1000) {
                alert('{{ __('product.image_resolution_error') }}');
                event.target.value = ''; // Reset the file input
            }
        };

        if (file) {
            img.src = URL.createObjectURL(file);
        }
    });
</script>