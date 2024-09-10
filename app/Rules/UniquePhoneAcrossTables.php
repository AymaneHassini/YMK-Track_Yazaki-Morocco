<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniquePhoneAcrossTables implements Rule
{
    protected $exceptId;

    public function __construct($exceptId = null)
    {
        $this->exceptId = $exceptId;
    }

    public function passes($attribute, $value)
    {
        // Check uniqueness in the employees table
        $existsInEmployees = DB::table('employees')
            ->where('phone', $value)
            ->where('id', '!=', $this->exceptId)
            ->exists();

        return !$existsInEmployees;
    }

    public function message()
    {
        return 'This phone number is already in use.';
    }
}
