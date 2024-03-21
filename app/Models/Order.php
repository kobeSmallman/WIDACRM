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

public function client()
{
    return $this->belongsTo(Client::class, 'Client_ID', 'Client_ID');
}
// In your Order model
public function payments()
{
    return $this->hasMany(Payment::class, 'Order_ID', 'Order_ID');
}

public function creator() // Assuming 'creator' represents the 'Created_By' user
{
    return $this->belongsTo(Employee::class, 'Created_By'); // Adjust User::class as needed
}

    public function getOrderIDAttribute()
{
    return $this->attributes['Order_ID']; // Ensure this matches your database column name
}


    // Relationships and other model methods...
}
