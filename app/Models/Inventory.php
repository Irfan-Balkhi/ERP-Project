<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
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
        return $this->belongsTo(Purchase::class, 'PurchaseID');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID');  // Ensure the foreign key is correct
    }
}

