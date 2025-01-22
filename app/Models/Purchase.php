<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    // Table name (optional, if it differs from the plural form of the model name)
    protected $table = 'purchases';

    // Primary key (optional, if it differs from 'id')
    protected $primaryKey = 'PurchaseID';

    // Fields that can be mass assigned
    protected $fillable = [
        'SupplierID',
        'ContractID',
        'PurchaseDate',
        'Description',
    ];

    // Relationships

    /**
     * Get the supplier associated with the purchase.
     */
    // public function supplier()
    // {
    //     return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    // }

    /**
     * Get the contract associated with the purchase.
     */
    // public function contract()
    // {
    //     return $this->belongsTo(Contract::class, 'ContractID', 'ContractID');
    // }

    /**
     * Get the purchase details associated with the purchase.
     */
    // public function Purchase_Details()
    // {
    //     return $this->hasMany(Purchase_Details::class, 'Purchase_DetailID', 'Purchase_DetailID');
    // }
}
