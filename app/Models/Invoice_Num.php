<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Num extends Model
{
    use HasFactory;

    protected $table = "invoices";

    // Primary key
    protected $primaryKey = 'InvoiceID';

    protected $fillable = [
        'InvoiceNumber',
        'InvoiceType',
        'Source',
        'Amount',
        'Quantity',
        'Description',
        'ContractID',
        'SaleID',
        'PurchaseID',
        'TransactionID',
    ];

    /**
     * Get the contract associated with the invoice.
     */
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'ContractID', 'ContractID');
    }
    
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
