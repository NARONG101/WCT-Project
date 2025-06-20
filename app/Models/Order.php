<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'supplier_id',
        'order_number',
        'order_date',
        'expected_delivery',
        'status',
        'total',
    ];

    // Cast order_date and expected_delivery as Carbon date instances automatically
    protected $casts = [
        'order_date' => 'datetime',
        'expected_delivery' => 'datetime',
    ];

    /**
     * An Order belongs to a Supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * An Order has many PoItems
     * Make sure your po_items table has an order_id column (foreign key)
     */
    public function items()
    {
        return $this->hasMany(PoItem::class, 'order_id');
    }
}
