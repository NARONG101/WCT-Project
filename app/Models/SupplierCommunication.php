<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierCommunication extends Model
{
    protected $fillable = ['supplier_id', 'notes', 'document_path'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
