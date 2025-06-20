<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'contact',         // <-- Add this line
        'contact_person',
        'email',
        'phone',
        'address',
        'item_type',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }

    public function communications()
    {
        return $this->hasMany(SupplierCommunication::class);
    }
}