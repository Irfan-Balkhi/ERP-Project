<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Purchase extends Model
{
    use HasFactory;

    protected $table = "purchases";

    protected $fillable = [
        // 'PurchaseID',
        'InvoiceNumber', // Automatically generated
        'SellerName',
        'CategoryID', // Foreign key for categories
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
 
         static::creating(function ($purchase) {
             $purchase->InvoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
         });
 
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
        return $this->belongsTo(Category::class, 'CategoryID', 'id');
    }
    public function invoice()
    {
        return $this->hasOne(Invoice_Num::class, 'InvoiceNumber', 'InvoiceNumber');
    }
}
