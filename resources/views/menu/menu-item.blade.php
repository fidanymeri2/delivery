<li id="menu-item-{{ implode('-', array_merge($parentIndices, [$item->id])) }}">
    <div style='display:flex;gap:25px;'>
        <div>
            <label for="items[{{ implode('][', array_merge($parentIndices, [$item->id])) }}][name]">Item Name:</label><br/>
            <input class="inp" type="text" name="items[{{ implode('][', array_merge($parentIndices, [$item->id])) }}][name]" value="{{ old('items.'.implode('.', array_merge($parentIndices, [$item->id])).'.name', $item->item_name) }}" required>
</div>

        <div class="sc">
             @if($item->item_select)
                <div class="select">
                    <label for="items[{{ implode('][', array_merge($parentIndices, [$item->id])) }}][select]">Select:</label><br/>
                    <input class="inp" type="text" name="items[{{ implode('][', array_merge($parentIndices, [$item->id])) }}][select]" value="{{ old('items.'.implode('.', array_merge($parentIndices, [$item->id])).'.select', $item->item_select) }}">
                </div>
            @endif
        </div>

        <div><br/>
            <button type="button" onclick="addMenuItem([{{ implode(',', array_merge($parentIndices, [$item->id])) }}]), addExToParent([{{ implode(',', array_merge($parentIndices, [$item->id])) }}])">Add Option</button> | 
            <button type="button" class="remove-button" onclick="removeMenuItem('{{ implode('-', array_merge($parentIndices, [$item->id])) }}')">Remove</button>
        </div>
    </div>
    <ul id="nested-items-{{ implode('-', array_merge($parentIndices, [$item->id])) }}">
        @foreach($item->children as $child)
            @include('menu.menu-item', ['item' => $child, 'parentIndices' => array_merge($parentIndices, [$item->id])])
        @endforeach
    </ul>
</li>