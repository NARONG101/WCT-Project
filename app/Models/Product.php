<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category',
        'quantity',
        'price',
        'low_stock_threshold',
        'cost_price',
        'status',
        'min_stock_level',
        'max_stock_level',
        'reorder_level',
        'current_quantity',
        'attributes',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'cost_price' => 'decimal:2',
        'attributes' => 'array',
    ];

    // Relationships
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function poItems()
    {
        return $this->hasMany(PoItem::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeLowStock($query)
    {
        return $query->whereColumn('quantity', '<=', 'min_stock_level');
    }

    public function scopeOutOfStock($query)
    {
        return $query->where('quantity', 0);
    }

    // Accessors
    public function getStockStatusAttribute()
    {
        if ($this->quantity == 0) {
            return 'out_of_stock';
        } elseif ($this->quantity <= $this->min_stock_level) {
            return 'low_stock';
        }
        return 'in_stock';
    }

    public function getStockPercentageAttribute()
    {
        if (empty($this->max_stock_level) || $this->max_stock_level == 0) {
            return 0;
        }

        return min(100, ($this->quantity / $this->max_stock_level) * 100);
    }

    // Logic Methods
    public function isLowStock()
    {
        return $this->quantity <= ($this->reorder_level ?? 0);
    }
}
