<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    protected $table = 'Notes'; // Explicitly defining the table name

    protected $primaryKey = 'Note_ID'; // Explicitly defining the primary key

    public $incrementing = true; // Set to false if 'Note_ID' is not auto-incrementing

    public $timestamps = true; // Set to false if your table does not have 'created_at' and 'updated_at'

    // Fillable attributes for mass assignment
    protected $fillable = [
        'Client_ID', // Assuming 'Client_ID' is correctly set to allow mass assignment
        'Interaction_Type',
        'Created_By',
        'Description',
    ];

    // Relationship with Client
    public function client()
    {
        return $this->belongsTo(Client::class, 'Client_ID', 'Client_ID');
    }

    // Relationship with Employee
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Created_By', 'Employee_ID');
    }

    // Relationship with Note
    public function images()
    {
        return $this->hasMany(Note::class, 'Note_ID', 'Note_ID');
    }

    // Add any other model properties or methods you might need
}
