<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';
    protected $primaryKey = 'SaleID';
    protected $fillable = [
        'InvoiceNumber',
        'CustomerName',
        'InvoiceID',
        'SaleDate',
        'Description',
        'PurchasedUnit',
        'Quantity',
        'PricePerUnit',
        'Total',
    ];

    /**
     * Sale → Invoice
     */
    public function invoice()
    {
        return $this->belongsTo(Invoice_Num::class, 'InvoiceID', 'InvoiceID');
    }
    /**
     * Sale → Inventory (via Invoice)
     */
    public function inventory()
    {
        return $this->hasOneThrough(
            Inventory::class,
            Invoice_Num::class,
            'InvoiceID',   // Foreign key in invoices
            'InvoiceID',   // Foreign key in inventories
            'InvoiceID',   // Local key in sales
            'InvoiceID'    // Local key in invoices
        );
    }

    /**
     * Sale → Product (via Inventory → Invoice → Contract)
     */
    public function product()
    {
        return $this->hasOneThrough(
            Product::class,
            Contract::class,
            'ContractID',  // Foreign key in contracts
            'ProductID',   // Foreign key in products
            'InvoiceID',   // Local key in sales (linked via invoice)
            'ContractID'   // Local key in contracts
        );
    }

    /**
     * Sale → Contract (via Invoice)
     */
    public function contract()
    {
        return $this->hasOneThrough(
            Contract::class,
            Invoice_Num::class,
            'InvoiceID',   // Foreign key in invoices
            'ContractID',  // Foreign key in contracts
            'InvoiceID',   // Local key in sales
            'ContractID'   // Local key in invoices
        );
    }

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::creating(function ($sale) {
    //         $sale->InvoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
    //     });

    //     // Add logic for updating Invoice Table on creation
    //     static::created(function ($sale) {
    //         Invoice_Num::create([
    //             'InvoiceNumber' => $sale->InvoiceNumber,
    //             'Source' => 'Sale',
    //         ]);
    //     });
    // }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($sale) {
            $sale->InvoiceNumber = 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(6));
        });

        static::created(function ($sale) {
            Invoice_Num::create([
                'InvoiceNumber' => $sale->InvoiceNumber,
                'InvoiceType' => 'internal', // Assuming sale invoices are internal
                'InvoiceSource' => 'Sale',
                'Date' => $sale->SaleDate,
                'TotalAmount' => $sale->Total,
                'Quantity' => $sale->Quantity,
                'Description' => $sale->Description,
                'SaleID' => $sale->SaleID, // Link invoice to sale
            ]);
        });
    }

}