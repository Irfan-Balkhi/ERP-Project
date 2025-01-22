<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'suppliers';
    protected $primaryKey = 'SupplierID';
    protected $fillable = [
        'CompanyName',
        'CompanyEmail',
        'CompanyContactNumber',
        'Address',
        
    ];
//     - Company Name
// - ⁠Company Address
// - ⁠Company Email Address
// - ⁠Company Contact Number
// - ⁠Purchased Commodity 
// - ⁠Contracts (چند قرارداد که با این شرکت داریم شماره وار ثبت گردد مثلآ قرارداد شماره ۱۰ تاریخ ۱۰/۰۱/۲۰۲۵ قرارداد شماره ۵ تاریخ ۲۰/۰۷/۲۰۲۴)
// - ⁠Invoices (تعداد انوایس‌های که این شرکت به ما میدهد باید با شماره انوایس، تاریخ انوایس و مبلغ انوایس از طرف همین شرکت ثبت گردد)
// هر انوایس شامل معلومات ذیل می باشد
//          - Item
//          - Quantity
//          - Price
//          - Total Price




 /**
     * Define a relationship with the Contract model.
     * One Supplier can have multiple Contracts.
     */
    // public function contracts()
    // {
    //     return $this->hasMany(Contract::class, 'SupplierID', 'SupplierID');
    // }
}
