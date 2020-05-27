<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidNameRule implements Rule
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
        $pattern = "/^[a-zA-ZÑñ]+(([', -][a-zA-ZÑñ ])?[a-zA-ZÑñ]*)*$/";

        return preg_match($pattern,  trim($value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Not a valid name.';
    }
}
