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

    

<div id="printable-receipt" style="display: none; padding: 20px; border: 1px solid #ccc; max-width: 400px; margin-top: 20px; font-family: Arial, sans-serif;">
    <h2>Sales Receipt</h2>
    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border-bottom: 1px solid #ccc; text-align: left;">Product</th>
                <th style="border-bottom: 1px solid #ccc; text-align: left;">Qty</th>
                <th style="border-bottom: 1px solid #ccc; text-align: left;">Price</th>
                <th style="border-bottom: 1px solid #ccc; text-align: left;">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lastReceipt as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>{{ number_format($item['price'], 2) }}</td>
                <td>{{ number_format($item['total'], 2) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3" style="font-weight: bold;">Total</td>
                <td style="font-weight: bold;">
                    {{ number_format(collect($lastReceipt)->sum('total'), 2) }}
                </td>
            </tr>
        </tfoot>
    </table>
</div>

@if (!empty($lastReceipt))
    <div id="receipt-printable" style="padding: 20px; max-width: 400px; border: 1px solid #ccc; margin-top: 20px;">
        <h2>Sales Receipt</h2>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="border: 1px solid #ddd; padding: 8px;">Product</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Qty</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Price</th>
                    <th style="border: 1px solid #ddd; padding: 8px;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lastReceipt as $item)
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['name'] }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ $item['quantity'] }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($item['price'], 2) }}</td>
                    <td style="border: 1px solid #ddd; padding: 8px;">{{ number_format($item['total'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">Total</td>
                    <td style="border: 1px solid #ddd; padding: 8px; font-weight: bold;">
                        {{ number_format(collect($lastReceipt)->sum('total'), 2) }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>

    <button onclick="printReceipt()" style="margin-top: 10px; padding: 10px 20px;">
        Print Receipt
    </button>

  
@endif

</x-filament::page>

  <script>
        function printReceipt() {
            let receiptContent = document.getElementById('receipt-printable').innerHTML;
            let originalContent = document.body.innerHTML;

            document.body.innerHTML = receiptContent;
            window.print();
            document.body.innerHTML = originalContent;
            location.reload(); // reload to restore event listeners and state
        }
    </script>
