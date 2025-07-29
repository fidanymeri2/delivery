<x-app-layout>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">
                            {{ __('product.edit_product') }}
                        </h2>
                        <div class="flex space-x-2">
                            @php
                            $checkIfHasMenu = \App\Models\Menu::where('product_id',$product->id)->first();
                            @endphp
                            @if($checkIfHasMenu)
                                <a href="{{ route('menu.edit',$checkIfHasMenu->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('product.view_menu') }}
                                </a>
                            @else
                                <a href="{{ route('menu.create',$product->id) }}"
                                   class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    {{ __('product.create_menu') }}
                                </a>
                            @endif
                            <a href="{{ route('products.index') }}"
                               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('product.back_to_products') }}
                            </a>
                        </div>
                    </div>

                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.category') }}:
                                </label>
                                <select name="category_id" id="category_id" required
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.name') }}:
                                </label>
                                <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="allergies" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.allergies') }}:
                                </label>
                                <input type="text" name="allergies" id="allergies" value="{{ old('allergies', $product->allergies) }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div>
                                <label for="product_code" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.product_code') }}:
                                </label>
                                <input type="text" name="product_code" id="product_code" value="{{ old('product_code', $product->product_code) }}" required
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <div class="md:col-span-2">
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.description') }}:
                                </label>
                                <textarea name="description" id="description" rows="4"
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('description', $product->description) }}</textarea>
                            </div>

                            <div class="md:col-span-2">
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.current_image') }}:
                                </label>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="{{ __('product.current_image') }}"
                                         class="max-w-xs h-auto mb-4 rounded-lg shadow-md">
                                @endif
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.replace_image') }}:
                                </label>
                                <input type="file" name="image" id="image"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Checkboxes -->
                            <div class="md:col-span-2">
                                <div class="space-y-4">
                                    <div class="flex items-center">
                                        <input type="hidden" name="new_product" value="0">
                                        <input type="checkbox" name="new_product" id="new_product" value="1" {{ old('new_product', $product->new_product) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="new_product" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.new_product') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="new_offers" value="0">
                                        <input type="checkbox" name="new_offers" id="new_offers" value="1" {{ old('new_offers', $product->new_offers) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="new_offers" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.new_offers') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="suggested" value="0">
                                        <input type="checkbox" name="suggested" id="suggested" value="1" {{ old('suggested', $product->suggested) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="suggested" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.suggested') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="isMenu" value="0">
                                        <input type="checkbox" name="isMenu" id="isMenu" value="1" {{ old('isMenu', $product->isMenu) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="isMenu" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.menu') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="status" value="0">
                                        <input type="checkbox" name="status" id="status" value="1" {{ old('status', $product->status) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="status" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.status') }}
                                        </label>
                                        <span class="ml-2 text-sm {{ $product->status == 1 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $product->status == 1 ? __('product.product_active') : __('product.product_inactive') }}
                                        </span>
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
                                        <input type="checkbox" name="requires_stock" id="requires_stock" value="1" {{ old('requires_stock', $product->requires_stock) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="requires_stock" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.requires_stock_tracking') }}
                                        </label>
                                    </div>

                                    <div class="flex items-center">
                                        <input type="hidden" name="low_stock_alert" value="0">
                                        <input type="checkbox" name="low_stock_alert" id="low_stock_alert" value="1" {{ old('low_stock_alert', $product->low_stock_alert) ? 'checked' : '' }}
                                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="low_stock_alert" class="ml-2 block text-sm text-gray-900">
                                            {{ __('product.enable_low_stock_alerts') }}
                                        </label>
                                    </div>
                                </div>

                                <div id="stock-fields" class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: {{ old('requires_stock', $product->requires_stock) ? 'grid' : 'none' }};">
                                    <div>
                                        <label for="current_stock" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.current_stock') }}:
                                        </label>
                                        <input type="number" name="current_stock" id="current_stock" min="0" value="{{ old('current_stock', $product->current_stock ?? 0) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="stock_unit" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.stock_unit') }}:
                                        </label>
                                        <select name="stock_unit" id="stock_unit"
                                                class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
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
                                        <label for="min_stock_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.min_stock_level') }}:
                                        </label>
                                        <input type="number" name="min_stock_level" id="min_stock_level" min="0" value="{{ old('min_stock_level', $product->min_stock_level ?? 0) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>

                                    <div>
                                        <label for="max_stock_level" class="block text-sm font-medium text-gray-700 mb-2">
                                            {{ __('product.max_stock_level') }} ({{ __('product.optional') }}):
                                        </label>
                                        <input type="number" name="max_stock_level" id="max_stock_level" min="0" value="{{ old('max_stock_level', $product->max_stock_level) }}"
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="deleted-options" name="deleted_options" value="">

                        <!-- Product Sizes Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                {{ __('product.product_sizes') }}
                            </h3>

                            <div id="sizes-container">
                                @foreach ($product->sizes as $index => $size)
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 size-entry mb-4" data-index="{{ $index }}">
                                        <div>
                                            <label for="price-{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ __('product.price') }}:
                                            </label>
                                            <input type="number" name="sizes[{{ $index }}][price]" id="price-{{ $index }}" value="{{ $size->price }}" step="0.01" required
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div class="relative">
                                            <label for="dimensions-{{ $index }}" class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ __('product.description') }}:
                                            </label>
                                            <select name="sizes[{{ $index }}][dimensions]" id="dimensions-{{ $index }}"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                @foreach($desc as $de)
                                                    <option value="{{ $de->id }}" {{ $size->dimensions == $de->id ? 'selected' : '' }}>{{ $de->name }}</option>
                                                @endforeach
                                            </select>
                                            <button type="button" class="remove-size absolute top-0 right-0 mt-8 px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                                Remove
                                            </button>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-size-button"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('product.add_size') }}
                            </button>
                        </div>

                        <!-- Product Options Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                {{ __('product.product_options') }}
                            </h3>

                            <div class="mb-4">
                                <label for="max_checked" class="block text-sm font-medium text-gray-700 mb-2">
                                    {{ __('product.option_max_select') }}:
                                </label>
                                <input type="text" name="max_checked" value="{{ $product->max_checked }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="{{ __('product.option_max_select') }}">
                            </div>

                            @php
                                $options = App\Models\ProductOptionOptional::where('product_id', $product->id)->get();
                                $opts = App\Models\ProductSize::select('description_categories.*')->where('product_id', $product->id)->leftJoin('description_categories','description_categories.id','=','product_sizes.dimensions')->get();
                            @endphp

                            <div id="inputs-container">
                                @foreach ($options as $index => $option)
                                    <div class="input-group mb-3 flex gap-2 items-end">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ __('product.option_name') }}:
                                            </label>
                                            <input type="text" name="options[{{ $index }}][name]" value="{{ $option->name }}"
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                                   placeholder="{{ __('product.option_name') }}">
                                        </div>
                                        <input type="hidden" name="options[{{ $index }}][id]" value="{{ $option->id }}">
                                        <div class="flex-1">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                                {{ __('product.description') }}:
                                            </label>
                                            <select name="options[{{ $index }}][desc_id]"
                                                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                                @foreach($opts as $opt)
                                                    <option value="{{ $opt->id }}" {{ $option->desc_id == $opt->id ? 'selected' : '' }}>{{ $opt->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="button" class="remove-input px-3 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                                            {{ __('product.remove') }}
                                        </button>
                                    </div>
                                @endforeach
                            </div>

                            <button type="button" id="add-input-btn"
                                    class="mt-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('product.add_new_option') }}
                            </button>
                        </div>

                        <!-- Extra Products Section -->
                        <div class="mt-8">
                            <h3 class="text-lg font-semibold text-gray-700 mb-4">
                                {{ __('product.extra_products_by_category') }}
                            </h3>

                            @php
                                $categories = \App\Models\ExtraCategory::with('extraProducts')->get();
                            @endphp

                            @foreach ($categories as $category)
                                <div class="mb-6">
                                    <h4 class="text-md font-medium text-gray-700 mb-2">{{ $category->name }}</h4>
                                    <div class="mb-2">
                                        <div class="flex items-center">
                                            <input type="checkbox" id="select_all_{{ $category->id }}" class="select-all-checkbox h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                            <label for="select_all_{{ $category->id }}" class="ml-2 block text-sm text-gray-900">
                                                {{ __('product.select_all') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full divide-y divide-gray-200 border border-gray-200 rounded-lg">
                                            <thead class="bg-gray-50">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ __('product.product_name') }}
                                                    </th>
                                                    @foreach($opts as $de)
                                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                            {{ __('product.price') }} - {{ $de->name }}
                                                        </th>
                                                    @endforeach
                                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                        {{ __('product.select') }}
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white divide-y divide-gray-200">
                                                @foreach ($category->extraProducts as $extraProduct)
                                                    <tr>
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            {{ $extraProduct->name }}
                                                        </td>
                                                        @foreach($opts as $de)
                                                            @php $deprice = \App\Models\ExtraProductPrice::where('desc_id',$de->id)->where('extra_product_id',$extraProduct->id)->first(); @endphp
                                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                                {{ number_format($deprice->price,2) }} €
                                                            </td>
                                                        @endforeach
                                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                            <input type="checkbox" name="extra_products[]" value="{{ $extraProduct->id }}"
                                                                   id="extra_product_{{ $category->id }}_{{ $extraProduct->id }}"
                                                                   {{ in_array($extraProduct->id, $product->extraProducts->pluck('id')->toArray()) ? 'checked' : '' }}
                                                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('product.update_product') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            let inputCount = {{ $options->count() }};
            var opts = "<?php foreach($opts as $de){ echo "<option value='".$de->id."'>".$de->name."</option>";  }  ?>";

            $('#add-input-btn').click(function(e) {
                e.preventDefault();

                inputCount++;
                let newInput = `<div class="input-group mb-3 flex gap-2 items-end">
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('product.option_name') }}:</label>
                        <input type="text" name="options[${inputCount}][name]" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500" placeholder="{{ __('product.option_name') }}">
                    </div>
                    <div class="flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">{{ __('product.description') }}:</label>
                        <select name="options[${inputCount}][desc_id]" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">${opts}</select>
                    </div>
                    <button type="button" class="remove-input px-3 py-2 bg-red-600 text-white text-sm rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">{{ __('product.remove') }}</button>
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
                newSizeEntry.classList.add('grid', 'grid-cols-1', 'md:grid-cols-2', 'gap-4', 'size-entry', 'mb-4');
                newSizeEntry.setAttribute('data-index', index);

                newSizeEntry.innerHTML = `
                    <div>
                        <label for="price-${index}" class="block text-sm font-medium text-gray-700 mb-2">{{ __('product.price') }}:</label>
                        <input type="number" name="sizes[${index}][price]" id="price-${index}" step="0.01" required class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="relative">
                        <label for="dimensions-${index}" class="block text-sm font-medium text-gray-700 mb-2">{{ __('product.description') }}:</label>
                        <select name="sizes[${index}][dimensions]" id="dimensions-${index}" class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            ${options}
                        </select>
                        <button type="button" class="remove-size absolute top-0 right-0 mt-8 px-3 py-1 bg-red-600 text-white text-xs rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">Remove</button>
                    </div>
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
