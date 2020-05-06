<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AllBoolean implements Rule
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
        $truthy = ["true", true, 1, "1"];
        $falsy = ["false", false, 0, "0", ""];

        if (in_array($value, $truthy)) {
            return true;
        } elseif (in_array($value, $falsy)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute field must be boolean.';
    }
}
