<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Num extends Model
{
    use HasFactory;

    protected $table = "invoices";
    protected $fillable = [
        'InvoiceNumber',
        'InvoiceType',
        'Source',
        'Amount',
        'Description',
        'SaleID',
        'PurchaseID',
        'TransactionID',
    ];

    
    // Relationship: Belongs to Sale
    public function sale()
    {
        return $this->belongsTo(Sale::class, 'SaleID');
    }

    // Relationship: Belongs to Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'PurchaseID');
    }

    // Relationship: Belongs to Transaction
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'TransactionID');
    }
}
