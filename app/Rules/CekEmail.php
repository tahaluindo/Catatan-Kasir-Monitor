<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CekEmail implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
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
        $valid = false;
        foreach ($this->data as $d) {
            if($value == $d->email) $valid = true;
        }
        return $valid;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Email not found';
    }
}
