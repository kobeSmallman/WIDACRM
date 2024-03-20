<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
 
    protected $table = 'Permissions';
    protected $primaryKey = 'Permission_ID';
    protected $fillable = [
        'Employee_ID', 'Page_ID', 'Full_Access', 'Read'
    ]; 
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'Employee_ID', 'Employee_ID');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'Page_ID', 'Page_ID');
    }

 
}
