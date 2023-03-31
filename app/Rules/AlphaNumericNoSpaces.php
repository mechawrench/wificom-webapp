<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaNumericNoSpaces implements Rule
{
    public function passes($attribute, $value)
    {
        return preg_match('/^[a-zA-Z0-9]+$/', $value);
    }

    public function message()
    {
        return 'The :attribute may only contain alphanumeric characters and no spaces.';
    }
}
