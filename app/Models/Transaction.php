<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    // protected $primaryKey = 'TransactionID';
    
    protected $fillable = [
        'InvoiceNumber',
        'SupplierName',
        'TransactionType',
        'Amount',
        'TransactionDate',
        'PaymentMethod',
        'Status',
        'Description',
    ];

    
    protected $casts = [
        'TransactionDate' => 'datetime',
        'Amount' => 'decimal:2',
    ];

    protected static function boot()
     {
         parent::boot();
 
         static::creating(function ($transaction) {
             $transaction->InvoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
         });
 
         // Add logic for updating Invoice Table on creation
         static::created(function ($transaction) {
            Invoice_Num::create([
                 'InvoiceNumber' => $transaction->InvoiceNumber,
                 'Source' => 'Transaction',
             ]);
         });
     }
    /**
     * Get the transaction associated with the invoice.
     */
    
    public function invoice()
    {
        return $this->hasOne(Invoice_Num::class, 'InvoiceNumber', 'InvoiceNumber');
    }
    /**
     * Get the customer associated with the transaction.
     */
    
}
