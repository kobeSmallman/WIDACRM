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
        'Password', // Ensure the case matches the column name in your database
    ];


    // Laravel expects the password field to be named 'password'.
    // If your field is named 'PASSWORD', you need to override the getAuthPassword method
    public function getAuthPassword()
    {
        return $this->PASSWORD;
    }
    

    // If you have a different name for the remember token, specify it here
    protected $rememberTokenName = 'remember_token';

    // Determine if the employee has an admin role.
    public function isAdmin()
    {
        // Replace 'admin_role_id' with the actual ID of the admin role in your roles table
        return $this->Role_ID === 'admin_role_id';
    }
    //do this; fix this**
    public function isEmployee()
    {
        // Replace 'employee_role_id' with the actual ID of the employee role in your roles table
        return $this->Role_ID === 'employee_role_id';
    }
    

    // Add any other model properties or methods you might need
}
