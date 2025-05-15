<?php
namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Product;
use App\Models\Sale;
class POS extends Page
{
    protected static string $view = 'filament.pages.p-o-s';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    public $products = [];
    public $cart = [];
    public $selectedProductId;
    public $total = 0;

    public $lastReceipt = [];


    public function mount(): void
    {
        $this->products = Product::all();
        $this->cart = [];
        $this->total = 0;
    }

    


    public function addToCart()
    {
        $product = Product::find($this->selectedProductId);

        if (!$product) return;

        if (isset($this->cart[$product->id])) {
            $this->cart[$product->id]['quantity']++;
        } else {
            $this->cart[$product->id] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        $this->updateTotal();
    }

    public function removeFromCart($productId)
    {
        unset($this->cart[$productId]);
        $this->updateTotal();
    }

    public function updateTotal()
    {
        $this->total = collect($this->cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });
    }

  public function checkout()
{
    $receipt = [];

    foreach ($this->cart as $id => $item) {
        $product = Product::find($id);

        if ($product) {
            if ($product->stock >= $item['quantity']) {
                $product->stock -= $item['quantity'];
                $product->save();

                Sale::create([
                    'product_id' => $id,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ]);

                // Add to receipt
                $receipt[] = [
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'total' => $item['price'] * $item['quantity'],
                ];
            } else {
                session()->flash('error', "Insufficient stock for product: {$product->name}");
                return;
            }
        } else {
            session()->flash('error', "Product not found.");
            return;
        }
    }

    $this->lastReceipt = $receipt;

    $this->cart = [];
    $this->total = 0;

    session()->flash('message', 'Order has been placed successfully!');
}


public function increaseQuantity($productId)
{
    if (isset($this->cart[$productId])) {
        $this->cart[$productId]['quantity'] += 1;
        $this->updateTotal();
    }
}

public function decreaseQuantity($productId)
{
    if (isset($this->cart[$productId]) && $this->cart[$productId]['quantity'] > 1) {
        $this->cart[$productId]['quantity'] -= 1;
        $this->updateTotal();
    }
}


public function clearCart()
{
    $this->cart = [];
    $this->total = 0;
    $this->selectedProductId = null;
    $this->lastReceipt = [];
}





}




