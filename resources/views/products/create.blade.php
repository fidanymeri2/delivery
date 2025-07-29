<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ __('product.create_product') }}
                        </h2>
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{ __('product.back_to_products') }}
                        </a>
                    </div>

                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.category') }}:
                                </label>
                                <select name="category_id" id="category_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.name') }}:
                                </label>
                                <input type="text" name="name" id="name" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.description') }}:
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>

                            <div>
                                <label for="allergies" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.allergies') }}:
                                </label>
                                <input type="text" name="allergies" id="allergies" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.upload_image') }}:
                                </label>
                                <input type="file" name="image" id="image"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Checkboxes -->
                            <div class="md:col-span-2">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="hidden" name="new_product" value="0">
                                        <input type="checkbox" name="new_product" id="new_product" value="1"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="new_product" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.new_product') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="new_offers" value="0">
                                        <input type="checkbox" name="new_offers" id="new_offers" value="1"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="new_offers" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.new_offers') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="suggested" value="0">
                                        <input type="checkbox" name="suggested" id="suggested" value="1"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="suggested" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.suggested') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Stock Management Section -->
                            <div class="md:col-span-2">
                                <h3 class="text-lg font-semibold text-gray-700 mb-4 mt-6">
                                    {{ __('product.stock_management') }}
                                </h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div class="flex items-center">
                                        <input type="hidden" name="requires_stock" value="0">
                                        <input type="checkbox" name="requires_stock" id="requires_stock" value="1"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="requires_stock" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.requires_stock_tracking') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="low_stock_alert" value="0">
                                        <input type="checkbox" name="low_stock_alert" id="low_stock_alert" value="1"
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="low_stock_alert" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.enable_low_stock_alerts') }}
                                        </label>
                                    </div>
                                </div>

                                <div id="stock-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: none;">
                                    <div>
                                        <label for="current_stock" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.current_stock') }}:
                                        </label>
                                        <input type="number" name="current_stock" id="current_stock" min="0" value="0"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="stock_unit" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.stock_unit') }}:
                                        </label>
                                        <select name="stock_unit" id="stock_unit"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                                        <label for="min_stock_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.min_stock_level') }}:
                                        </label>
                                        <input type="number" name="min_stock_level" id="min_stock_level" min="0" value="0"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="max_stock_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.max_stock_level') }} ({{ __('product.optional') }}):
                                        </label>
                                        <input type="number" name="max_stock_level" id="max_stock_level" min="0"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Product Sizes Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                {{ __('product.product_sizes') }}
                            </h3>

                            <div id="sizes-container">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 size-entry" data-index="0">
                                    <div>
                                        <label for="price-0" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.price') }}:
                                        </label>
                                        <input type="number" name="sizes[0][price]" step="any" id="price-0" required
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label for="dimensions-0" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.description') }}:
                                        </label>
                                        <select name="sizes[0][dimensions]" id="dimensions-0"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                            @foreach($desc as $de)
                                                <option value="{{ $de->id }}">{{ $de->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <button type="button" id="add-size-button"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('product.add_size') }}
                            </button>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('product.create_product') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var options = "<?php foreach($desc as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

        document.addEventListener('DOMContentLoaded', function() {
            let index = 1; // Start with index 1 since index 0 is already in the form
            const sizesContainer = document.getElementById('sizes-container');
            const addSizeButton = document.getElementById('add-size-button');

            addSizeButton.addEventListener('click', function() {
                // Create a new size entry
                const newSizeEntry = document.createElement('div');
                newSizeEntry.classList.add('grid', 'grid-cols-1', 'md:grid-cols-2', 'gap-4', 'size-entry');
                newSizeEntry.setAttribute('data-index', index);

                newSizeEntry.innerHTML = `
                    <div>
                        <label for="price-${index}" class="block text-sm font-medium text-gray-700 mb-2">{{ __('product.price') }}:</label>
                        <input type="number" name="sizes[${index}][price]" step="any" id="price-${index}" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="dimensions-${index}" class="block text-sm font-medium text-gray-700 mb-2">{{ __('product.description') }}</label>
                        <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
</x-app-layout>
