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

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'CategoryID');
    }
}
