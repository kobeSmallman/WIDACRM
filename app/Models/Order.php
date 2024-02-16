<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'Order'; // Ensure this matches your actual table name
    protected $primaryKey = 'Order_ID';
    protected $keyType = 'string'; // Indicate that the primary key is a string
    public $incrementing = false; // Indicate that the primary key is not auto-incrementing

    // Specify the actual format of your dates if different
    protected $casts = [
        'Request_DATE' => 'datetime:Y-m-d',
        'Order_DATE' => 'datetime:Y-m-d',
        'Quotation_DATE' => 'datetime:Y-m-d',
    ];

    protected $fillable = [
        'Order_ID',
        'Client_ID',
        'Created_By',
        'Request_DATE',
        'Request_Status',
        'Remarks',
        'Order_DATE',
        'Order_Status',
        'Quotation_DATE',
        'CSA_Path',
        'SSA_Path',
        // ...other fields
    ];
// Order.php
public function products()
{
    return $this->hasMany(Product::class, 'Order_ID', 'Order_ID');
}

    public function getOrderIDAttribute()
{
    return $this->attributes['Order_ID']; // Ensure this matches your database column name
}


    // Relationships and other model methods...
}
