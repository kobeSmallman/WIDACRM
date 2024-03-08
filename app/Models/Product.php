<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'Product'; // Replace with your actual table name

    protected $primaryKey = 'Item_ID'; // Replace with your actual primary key column name

    public $timestamps = true; // Set to false if you don't have timestamps

    protected $fillable = [
        'Item_ID',
        'Order_ID',//TODO MAKE THE ADD NEW PRODUCT HAVE ALL OF THE FIELDS.
        'Product_Name',
        'Quantity',
        'Vendor_ID',
        'Shipping_Status',
        'Shipped_Qty',
        'Product_Price',
        'Product_Status',
        'QA_Status',
        'Storage_Status',
        // Add other fields as necessary
    ];

    public function order()
    {
        // This assumes that 'Order_ID' is the name of the foreign key column in the 'Product' table.
        return $this->belongsTo(Order::class, 'Order_ID', 'Order_ID');
    }

    // Add other necessary model methods and properties
}
