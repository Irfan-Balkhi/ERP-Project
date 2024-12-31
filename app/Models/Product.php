<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
        use HasFactory;
    
        protected $table = 'products';    
        protected $primaryKey = 'ProductID'; 
        
        protected $fillable = [
            'ProductName',
            'CategoryID',
            'Description',
        ];
    
        public function category()
        {
            return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
        }
        // public function purchases()
        // {
        //     return $this->belongsToMany(Purchase::class, 'product_purchase', 'ProductID', 'PurchaseID')
        //                 ->withTimestamps();    // Include timestamps if present
        // }
            public function purchases()
        {
            return $this->belongsToMany(
                Purchase::class,
                'product_purchase',  // Pivot table name
                'ProductID',         // Foreign key in the pivot table for Product
                'PurchaseID'         // Foreign key in the pivot table for Purchase
            )->withTimestamps();
        }

        public function sale()
        {
            return $this->belongsToMany(Sale::class,
            'sale_product',
            'ProductID',
            'SaleID');
        }

        public function inventory()
    {
        return $this->hasOne(Inventory::class, 'ProductID', 'ProductID');
    }
        
}
    
