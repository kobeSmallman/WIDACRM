<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // If your permissions table uses a different name, specify it here
    protected $table = 'Permissions';
    protected $primaryKey = 'Permission_ID';
    protected $fillable = [
        'Employee_ID', 'Page_ID', 'Full_Access', 'Read'
    ];
 
}
