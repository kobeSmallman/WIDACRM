<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $table = 'Page';
    public function permissions()
{
    return $this->hasMany(Permission::class, 'Page_ID', 'id');
}

}

