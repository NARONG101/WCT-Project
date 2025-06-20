<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number', 'supplier_id', 'status', 'order_date',
        'expected_delivery_date', 'actual_delivery_date', 'total_amount',
        'notes', 'created_by'
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
        'total_amount' => 'decimal:2',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PoItem::class, 'po_id');
    }



    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePending($query)
    {
        return $query->whereIn('status', ['pending', 'approved', 'ordered']);
    }

    public function scopeOverdue($query)
    {
        return $query->where('expected_delivery_date', '<', now())
                    ->whereIn('status', ['pending', 'approved', 'ordered']);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($purchaseOrder) {
            if (!$purchaseOrder->order_number) {
                $purchaseOrder->order_number = 'PO-' . str_pad(
                    PurchaseOrder::count() + 1, 
                    6, 
                    '0', 
                    STR_PAD_LEFT
                );
            }
        });
    }
}
