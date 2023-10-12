<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class EmailValidation implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $domainPart = explode('@', $value)[1] ?? null;

        if (!$domainPart) {
            return false;
        }

        return $domainPart === 'smktelkom-bjb.sch.id';
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute harus menggunakan domain dari smktelkom-bjb.sch.id.';
    }
}
