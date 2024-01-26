<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'Order'; // Replace with your actual table name

    protected $primaryKey = 'Order_ID';
    public $timestamps = true; // Set to false if you don't have timestamps

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
        // Add other fields as necessary
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'Client_ID', 'Client_ID');
    }

    public function products()
    {
        // Assuming the foreign key in the products table is 'Order_ID'
        return $this->hasMany(Product::class, 'Order_ID', 'Order_ID');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Created_By', 'Employee_ID');
    }
    public function getOrderID()
    {
        return $this->attributes['Order_ID']; // Ensure this matches your database column name
    }

    // Add other necessary model methods and properties
}
