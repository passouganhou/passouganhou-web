<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ValidTaxStructure implements Rule
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
        // Verifique se $value contém apenas as propriedades desejadas
        $allowedProperties = ['master', 'visa', 'elo'];

        return is_array($value)
            && count($value) === count($allowedProperties)
            && empty(array_diff_key(array_flip($allowedProperties), $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'O atributo :attribute deve ter somente as propriedades master, visa e elo.';
    }
}
