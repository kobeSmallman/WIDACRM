<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomRequest extends Model
{
    // The table associated with the model.
    protected $table = 'requests'; // Ensure this is the correct table name for your custom requests

    // The primary key associated with the table.
    protected $primaryKey = 'id'; // Replace with your primary key if it's not 'id'

    // Indicates if the model should be timestamped.
    public $timestamps = true; // Set to false if you do not have 'created_at' and 'updated_at' columns

    // The attributes that are mass assignable.
    protected $fillable = [
        'Item_ID',
        'Order_ID',
        'Product_Name',
        'Quantity',
        'Vendor_ID',
        'Shipping_Status',
        'Shipped_Qty',
        'Product_Price',
        'Product_Status',
        'QA_Status',
        'Storage_Status',
        'Prod_Status',
        // ... Add any other columns you have in your requests table
    ];

    // Add any relationships, accessors, mutators, etc., if necessary.
    // For example, if a request belongs to a client:
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    // Similarly, if a request is related to a product:
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
