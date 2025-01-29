<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $primaryKey = 'CategoryID';

    protected $fillable = [
        'Name',
        'Description',
        'Status',
    ];

    /**
     * Relationship with Product model.
     * A category can have many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'CategoryID', 'CategoryID');
    }
    // public function purchases()
    // {
    //     return $this->hasMany(Purchase::class, 'CategoryID');
    // }
    public function sales()
    {
        return $this->hasMany(Sale::class, 'CategoryID');
    }

    public function contract()
    {
        return $this->hasOne(Contract::class, 'CategoryID', 'CategoryID');
    }


}

