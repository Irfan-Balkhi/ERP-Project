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
        'CategoryID',
        'ProductID',
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
        // return $this->hasMany(Invoice_Num::class, 'InvoiceID', 'InvoiceID');
        return $this->hasMany(Invoice_Num::class, 'ContractID', 'ContractID');

    }

    /**
     * Get the purchases associated with the contract.
     */
    // public function purchases()
    // {
    //     return $this->hasMany(Purchase::class, 'ContractID', 'ContractID');
    // }

    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }
    // Relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }
}
