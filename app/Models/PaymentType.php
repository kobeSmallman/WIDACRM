<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentType extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Payment_Type'; 
    protected $primaryKey = 'PMT_Type_ID'; 
    protected $keyType = 'int';
    public $incrementing = true; 

    protected $fillable = [
        'PMT_Type_ID',
        'PMT_Type_Name',
        'Active_Status',
        // ...other fields if necessary
    ];

    // Define relationships, if any
    // For example, if you have payments associated with this type:
    public function payments()
    {
        return $this->hasMany(Payment::class, 'PMT_Type_ID', 'PMT_Type_ID');
    }

    // Other model methods...
}
