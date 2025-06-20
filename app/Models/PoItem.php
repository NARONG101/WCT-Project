<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoItem extends Model
{
    protected $fillable = [
        'order_id',
        'inventory_id',
        'quantity',
        'price',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}
// This model represents the items in a purchase order, linking them to both the order and the inventory item.
// It includes relationships to the Order and Inventory models, allowing for easy access to related data.