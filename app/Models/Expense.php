<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
     // Table associated with the model
     protected $table = 'expenses';

     // Primary key for the table
     protected $primaryKey = 'ExpensesID';
     
    protected $fillable = [
        'ExpenseCategory',
        'Amount',
        'Description',
        'Date'
    ];
}
