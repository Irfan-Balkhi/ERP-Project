<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory;

    protected $table = "sales";

    protected $fillable = [
        'InvoiceNumber',
        'CustomerName',
        'CategoryID',
        'SaleDate',
        'Description',
        'PurchasedUnit',
        'Quantity',
        'PricePerUnit',
        'Total',
    ] ;

    protected static function boot()
     {
         parent::boot();
 
         static::creating(function ($sale) {
             $sale->InvoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
         });
 
         // Add logic for updating Invoice Table on creation
         static::created(function ($sale) {
            Invoice_Num::create([
                 'InvoiceNumber' => $sale->InvoiceNumber,
                 'Source' => 'Sale',
             ]);
         });
     }


    public function category()
    {
        return $this->belongsTo(Category::class, 'CategoryID');
    }

    public function invoice()
    {
        return $this->hasOne(Invoice_Num::class, 'InvoiceNumber', 'InvoiceNumber');
    }

}
