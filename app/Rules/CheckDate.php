<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class CheckDate implements Rule
{
    protected $customValue;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($customValue)
    {
        $this->customValue = $customValue;
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
        return $value <= $this->customValue;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The date is not valid! Please select a valid date.';
    }
}
