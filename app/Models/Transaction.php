<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transactions';
    protected $primaryKey = 'TransactionID';
    protected $fillable = [
        'CustomerName',
        'amount',
        'transaction_type',
        'source',
        'description',
        'transaction_date',
        'SupplierID',
        'accountID',
    ];

    protected $dates = ['transaction_date', 'deleted_at'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID', 'SupplierID');
    }

    public function account()
    {
        return $this->belongsTo(Account::class, 'accountID', 'accountID');
    }
}
