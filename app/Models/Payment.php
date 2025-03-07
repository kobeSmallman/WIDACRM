<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'Payment'; // Replace with your actual table name
    protected $primaryKey = 'PMT_ID';
    protected $keyType = 'int';
    public $incrementing = true; // Set to true if 'PMT_ID' is auto-incrementing

    protected $casts = [
        'Date' => 'datetime:Y-m-d H:i:s', // Format according to your needs
        'Amount' => 'decimal:2', // or 'float' for Laraval lower than 7
        ];
        

    protected $fillable = [
        'Order_ID',
        'Invoice_Number',
        'Date',
        'PMT_Cat',
        'Amount',
        'PMT_Type_ID',
        'Remarks',
    ];

    // Define relationships
    public function order()
    {
        return $this->belongsTo(Order::class, 'Order_ID', 'Order_ID','Order_DATE','Order_Status','Remarks');
    }

    public function paymentType()
    {
        return $this->belongsTo(PaymentType::class, 'PMT_Type_ID', 'PMT_Type_ID');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Item_ID', 'Item_ID','Quantity','Product_Price');
    }

}
