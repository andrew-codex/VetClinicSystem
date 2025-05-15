<x-filament::page>
    <style>
        select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            color: #000;
            background-color: white;
            border: 1px solid #ddd;
            padding: 8px;
            border-radius: 4px;
        }

        option {
            color: black;
            background-color: white;
        }
    </style>

    @if (session('error'))
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

@if (session('message'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ session('message') }}
    </div>
@endif


    <div>
        <h2 class="text-xl font-bold mb-4">Products</h2> 
        <div class="flex justify-end mb-4">
    <x-filament::button wire:click="clearCart" color="gray">Clear All</x-filament::button>
</div>

        <select wire:model="selectedProductId" class="w-full mb-4 border rounded p-2 bg-white text-black">
            <option value="">-- Select a product --</option>
            @foreach ($products as $product)
                <option value="{{ $product->id }}" class="text-black bg-white">
                    {{ $product->name }} - ₱{{ number_format($product->price, 2) }}
                </option>
            @endforeach
        </select>
         

        <x-filament::button wire:click="addToCart">Add to Cart</x-filament::button>
       

       <h2 class="text-xl font-bold mb-4">Cart</h2>
<div class="space-y-2">
    @foreach ($cart as $id => $item)
        <div class="flex justify-between items-center border p-2 rounded">
            <div>
                <p class="font-semibold">{{ $item['name'] }}</p>
                <div class="flex items-center space-x-2">
                    <x-filament::button color="gray" size="xs" wire:click="decreaseQuantity({{ $id }})">−</x-filament::button>
                    <span>{{ $item['quantity'] }}</span>
                    <x-filament::button color="gray" size="xs" wire:click="increaseQuantity({{ $id }})">+</x-filament::button>
                    <span>× ₱{{ number_format($item['price'], 2) }}</span>
                </div>
            </div>
            <x-filament::button color="danger" size="sm" wire:click="removeFromCart({{ $id }})">Remove</x-filament::button>
        </div>
    @endforeach
</div>

<div class="mt-4 text-lg font-bold">
    Total: ₱{{ number_format($total, 2) }}
    </div>


    <x-filament::button wire:click="checkout" class="w-full">Checkout</x-filament::button>
  

 

    </div>

    @if (!empty($lastReceipt))
    <div class="mt-6 p-4 border border-gray-300 rounded">
        <h2 class="text-xl font-bold mb-4">Receipt</h2>
        <ul class="space-y-2">
            @foreach ($lastReceipt as $item)
                <li class="flex justify-between">
                    <div>
                        {{ $item['quantity'] }} × {{ $item['name'] }}
                    </div>
                    <div>
                        ₱{{ number_format($item['total'], 2) }}
                    </div>
                </li>
            @endforeach
        </ul>
        <div class="mt-4 font-bold text-right">
            Total: ₱{{ number_format(collect($lastReceipt)->sum('total'), 2) }}
        </div>
    </div>
@endif

</x-filament::page>
