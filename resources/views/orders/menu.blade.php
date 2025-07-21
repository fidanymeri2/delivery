@php
$item = (object) ($item);
@endphp
@if($item->checked)
<li>
<label><span>&#10003;</span> {{ $item->name }} </label>
        <ul >
        @foreach($item->children as $child)
            @include('orders.menu', ['item' => $child])
        @endforeach
    </ul>
    
</li>
@endif