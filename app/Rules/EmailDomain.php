<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class EmailDomain implements Rule
{
    public function passes($attribute, $value)
    {
        return str_ends_with($value, '@yazaki-europe.com');
    }

    public function message()
    {
        return 'The email must end with @yazaki-europe.com';
    }
}
