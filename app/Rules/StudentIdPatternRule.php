<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class StudentIdPatternRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $pattern = "/^(\d{2})-(\d)-(\d{5})$/";

        return preg_match($pattern,  trim($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid ID, must follow ##-#-##### pattern';
    }
}
