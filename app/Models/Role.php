<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // If your roles table uses a different name, specify it here
    protected $table = 'Roles';

    // Add any other properties or methods you need here
}
