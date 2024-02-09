<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    // If your vendor table name is different, set it here
    protected $table = 'Vendor';

    // Column names as they appear in your database
    protected $fillable = [
        'Vendor_ID',       // Assuming 'Vendor_ID' is auto-incrementing
        'Vendor_Name',
        'Active_Status',
        'Remarks'
    ];

    // Disable timestamps if not present in your table
    public $timestamps = false;

    // If Vendor_ID is not auto-incrementing, you'll need to set the following properties
    // public $incrementing = false;
    // protected $keyType = 'string';

    // Define any relationships here
    // ...

}
