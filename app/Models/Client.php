<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client'; // Make sure this matches your actual table name

    protected $primaryKey = 'Client_ID';

    // If you don't have created_at and updated_at columns, set this to false
    public $timestamps = true;

    // Fillable attributes for mass assignment
    protected $fillable = [
        'Client_ID',
        'Lead_Status',
        'Buyer_Status',
        'Company_Name',
        'Shipping_Address',
        'Billing_Address',
        'Phone_Number',
        'Email',
        'Main_Contact',
        'Created_By',
        // Add any other fillable fields as necessary
    ];

    // Define relationships here if there are any
    // Example: If a Client has many Orders
    /*
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    */
// In Client model
public function orders()
    {
        return $this->hasMany(Order::class, 'Client_ID', 'Client_ID');
    }
public function products()
{
    return $this->hasManyThrough(Product::class, Order::class, 'Client_ID', 'Order_ID', 'Client_ID', 'Order_ID');
}

// Client.php
public function Notes()
{
    return $this->hasMany(Note::class, 'Client_ID', 'Client_ID');
}


}
