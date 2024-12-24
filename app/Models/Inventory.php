<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventory';
    protected $primaryKey = 'InventoryID';

    protected $fillable = [
        'PurchaseID',
        'ProductID',
        'ProductName',
        'Quantity',
        'TotalPurchasedPrice',
    ];

    // Relationships
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'PurchaseID', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'id');
    }
}

