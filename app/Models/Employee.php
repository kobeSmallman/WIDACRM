<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    use HasFactory, Notifiable;
    public $timestamps = false;
    // Explicitly defining the table name
    protected $table = 'Employee';

    // Explicitly defining the primary key if it's not 'id'
    protected $primaryKey = 'Employee_ID';

    // Disabling auto-incrementing if the primary key is not auto-incrementing
    public $incrementing = false;

    // Defining fillable fields to allow mass assignment
    protected $fillable = [
        'Employee_ID',
        'Last_Name',
        'First_Name',
        'Department',
        'Position',
        'Employee_Status',
        'Role_ID',
        'Password',
        'profile_image', // Add this line
    ];
    


    // Laravel expects the password field to be named 'password'.
    // If your field is named 'PASSWORD', you need to override the getAuthPassword method
    public function getAuthPassword()
{
    return $this->attributes['Password']; // Match your database column case
}
    

    // If you have a different name for the remember token, specify it here
    protected $rememberTokenName = 'remember_token';

    // Determine if the employee has an admin role.
    public function isAdmin()
    //different numbers mean different Roles which means different permissions and views
    {
        return $this->Role_ID === 1; // 1 is the admin
    }
    
    public function isEmployee()
    {
        return $this->Role_ID === 2; // 2 means Employee 
    }
    
    

    // Add any other model properties or methods you might need
}
