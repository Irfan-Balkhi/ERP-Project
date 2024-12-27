<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";
    protected $primaryKey = 'PurchaseID'; // Define the custom primary key

    protected $fillable = [
        'InvoiceNumber', // Automatically generated
        'SellerName',
        'CategoryID', // Foreign key for categories
        'ProductID',
        'PurchaseDate',
        'Description',
        'Quantity',
        'PricePerUnit',
        'Total',

    ];

     // Generate unique InvoiceNumber before saving
     protected static function boot()
     {
         parent::boot();
 
        //for server side that invoice number generation

        //  static::creating(function ($purchase) {
        //      $purchase->InvoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        //  });
 
         // Add logic for updating Invoice Table on creation
         static::created(function ($purchase) {
            Invoice_Num::create([
                 'InvoiceNumber' => $purchase->InvoiceNumber,
                 'Source' => 'Purchase',
             ]);
         });
     }

     public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID', 'CategoryID');
    }

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_purchase', 'PurchaseID', 'ProductID')
    //                 ->withTimestamps();    // Include timestamps if present
    // }
    
        public function products()
    {
        return $this->belongsToMany(
            Product::class,
            'product_purchase',  // Pivot table name
            'PurchaseID',        // Foreign key in the pivot table for Purchase
            'ProductID'          // Foreign key in the pivot table for Product
        )->withTimestamps();
    }

    public function invoice()
    {
        return $this->hasOne(Invoice_Num::class, 'InvoiceNumber', 'InvoiceNumber');
    }
}
