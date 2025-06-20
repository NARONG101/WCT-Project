<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'name',
        'sku',
        'category',
        'quantity',
        'price',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
