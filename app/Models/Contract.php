<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice_Num;

class Contract extends Model
{
    use HasFactory;

    // Table name (optional, if it differs from the plural form of the model name)
    protected $table = 'contracts';

    // Primary key (optional, if it differs from 'id')
    protected $primaryKey = 'ContractID';

    // Fields that can be mass assigned
    protected $fillable = [
        'SupplierID',
        'TotalValue',
        'TotalQuantity',
        'ContractAttachment',
        'StartDate',
        'EndDate',
    ];

    // Relationships

    /**
     * Get the supplier associated with the contract.
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }

    public function invoices()
    {
        return $this->hasMany(Invoice_Num::class, 'InvoiceID', 'InvoiceID');
    }

    /**
     * Get the purchases associated with the contract.
     */
    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'ContractID', 'ContractID');
    }
}
