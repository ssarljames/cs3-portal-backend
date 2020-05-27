<?php

namespace App\Rules;

use App\Models\Program;
use Illuminate\Contracts\Validation\Rule;

class StudentYearLevelRule implements Rule
{
    private $program = null;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($program_id)
    {
        $this->program = Program::find($program_id);
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
        return $this->program != null 
                    && $value >= 1 
                    && $value <= $this->program->no_of_years;
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->program
                    ? "Invalid year level for {$this->program->code}"
                    : 'Program enrolled in is require.';
    }
}
