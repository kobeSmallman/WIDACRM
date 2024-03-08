<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Employee;

class UniqueEmployeeName implements Rule
{
    protected $lastName;
    protected $firstName;

    public function __construct($lastName, $firstName)
    {
        $this->lastName = $lastName;
        $this->firstName = $firstName;
    }

    public function passes($attribute, $value)
    {
        // Check if the combination of last name and first name already exists
        $count = Employee::whereRaw('LOWER(CONCAT(Last_Name, " ", First_Name)) = ?', [strtolower($this->lastName . ' ' . $this->firstName)])->count();

        // Return true if no matching records found, indicating uniqueness
        return $count === 0;
    }

    public function message()
    {
        $existingEmployee = Employee::whereRaw('LOWER(CONCAT(Last_Name, " ", First_Name)) = ?', [strtolower($this->lastName . ' ' . $this->firstName)])->first();

        if ($existingEmployee) {
            return 'An employee named ' . $existingEmployee->First_Name . ' ' . $existingEmployee->Last_Name . ' already exists.';
        }

        return 'The employee name already exists.';
    }
}

