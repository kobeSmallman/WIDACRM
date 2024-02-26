<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'Client'; // Confirm this matches your actual table name
    protected $primaryKey = 'Client_ID';

    // Adjust based on your actual database structure
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true; // Enable if you have created_at and updated_at columns

    protected $fillable = [
        'Lead_Status',
        'Buyer_Status',
        'Company_Name',
        'Shipping_Address',
        'Billing_Address',
        'Phone_Number',
        'Email',
        'Main_Contact',
        'Created_By',
    ];

    public function orders()
    {
        return $this->hasMany(Order::class, 'Client_ID', 'Client_ID');
    }

    public function notes()
    {
        // Ensure method names are in camelCase
        return $this->hasMany(Note::class, 'Client_ID', 'Client_ID');
    }

    // You might not need the products relationship if it's not used
    public function products()
    {
        return $this->hasManyThrough(Product::class, Order::class, 'Client_ID', 'Order_ID', 'Client_ID', 'Order_ID');
    }
}
