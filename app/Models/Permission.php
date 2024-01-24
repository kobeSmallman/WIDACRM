<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    // If your permissions table uses a different name, specify it here
    protected $table = 'Permission';

    // Add any other properties or methods you need here
}
