<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $table = 'inventories';
    protected $primaryKey = 'InventoryID'; // Custom primary key

    protected $fillable = [
        'InvoiceID',
        'ExtraExpense',
        'Description',
    ];

    // Relationships
    public function invoice()
    {
        return $this->belongsTo(Invoice_Num::class, 'InvoiceID', 'InvoiceID');
    }
}

