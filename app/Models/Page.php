<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'Page';
   // Page.php
public function permissions()
{
    return $this->hasMany(Permission::class, 'Page_ID', 'Page_ID');
}

// Page.php

public function employees()
{
    return $this->hasManyThrough(Employee::class, Permission::class, 'Page_ID', 'Employee_ID', 'Page_ID', 'Employee_ID');
}


}

