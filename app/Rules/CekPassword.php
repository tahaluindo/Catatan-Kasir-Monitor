<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CekPassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $data, $val;
    public function __construct($data, $val)
    {
        $this->data = $data;
        $this->val = $val;
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
            if($this->val == $d->email && $value == $d->password) $valid = true;
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
        return 'Password incorrect';
    }
}
