<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    /**
     * Deduct stock after a successful order.
     *
     * @param int $quantity
     * @return void
     */
    public function deductStock($quantity)
    {
        $this->product_quantity -= $quantity;
        $this->save();
    }

    
}
