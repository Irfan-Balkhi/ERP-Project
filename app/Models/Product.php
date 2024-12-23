<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
        use HasFactory;
    
        protected $table = 'products';    
        /**
         * The attributes that are mass assignable.
         */
         //@var array
        
        protected $fillable = [
            'ProductName',
            'CategoryID',
            'Description',
        ];
    
        public function category()
        {
            return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
        }
        public function purchase()
        {
            return $this->belongsToMany(Purchase::class, 'purchase_product', 'product_id', 'purchase_id');
        }
        public function sale()
        {
            return $this->belongsToMany(Sale::class, 'sale_product', 'product_id', 'sale_id');
        }

}
    
