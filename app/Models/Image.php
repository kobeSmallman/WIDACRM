<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'Image'; // Explicitly defining the table name

    protected $primaryKey = 'Image_ID'; // Explicitly defining the primary key

    public $incrementing = true; // Set to false if 'Note_ID' is not auto-incrementing

    

    // Fillable attributes for mass assignment
    protected $fillable = [
        'Note_ID',
        'IMG_MIME',
        'IMG_data', 
    ];
    

    // Relationship with Client
    public function note()
    {
        return $this->belongsTo(Note::class, 'Note_ID', 'Note_ID');
    }

}
