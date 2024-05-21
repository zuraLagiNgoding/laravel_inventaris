<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxAmount implements Rule
{
    protected $qty;

    /**
     * Create a new rule instance.
     *
     * @param int $qty
     */
    public function __construct(int $qty)
    {
        $this->qty = $qty;
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
        return $value <= $this->qty;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The amount of pemakaian must not be greater than ' . $this->qty . '.';
    }
}
