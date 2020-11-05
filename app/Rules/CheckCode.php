<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Department;

class CheckCode implements Rule
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
        $departments= Department::all();

        foreach ($departments as $department) {
            if ($department->lec_code == $value) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No Department has found with your code!!';
    }
}
