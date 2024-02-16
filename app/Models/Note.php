<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Note extends Model
{
    protected $table = 'Notes'; // This should match the table name in the database

    // Fillable attributes for mass assignment
    protected $fillable = [
        'Note_ID',
        'Client_ID',
        'Interaction_Type',
        'Created_By',
        'Date_Time',
        'Description',
    ];

    public static function list($id) {
        $notes = DB::select(['select * from Notes where Client_ID = ?', [$id]]);

        return $notes;
    }
      
    
        // Relationships
        public function client()
        {
            return $this->belongsTo(Client::class, 'Client_ID', 'Client_ID');
        }
    
        public function employee()
        {
            return $this->belongsTo(Employee::class, 'Created_By', 'Employee_ID');
        }
    }
    
    // Add any other model properties or methods you might need

