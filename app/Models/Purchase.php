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
        'ProductID',
        'CategoryID',
        'PurchaseDate',
        'Description',
    ];
    
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }
    
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'ContractID', 'ContractID');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'ProductID', 'ProductID');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }
    
}
