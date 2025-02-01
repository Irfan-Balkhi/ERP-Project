<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice_Num extends Model
{
    use HasFactory;

    // Specify the correct table name
    protected $table = 'invoices';
    // Specify the primary key if it doesn't follow the default "id"
    protected $primaryKey = 'InvoiceID'; // Specify custom primary key

    // Define the attributes that can be mass-assigned
    protected $fillable = [
        'InvoiceNumber',
        'InvoiceType',
        'InvoiceSource',
        'Date',
        'TotalAmount',
        'PaymentMethod',
        'Amount',
        'Quantity',
        'Description',
        'ContractID',
        'SaleID',
        'TransactionID',
    ];

    // Define relationships
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'ContractID', 'ContractID');
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class, 'SaleID');
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'TransactionID');
    }
}
