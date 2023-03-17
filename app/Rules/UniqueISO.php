<?php

namespace App\Rules;

use App\Models\Country;
use Illuminate\Contracts\Validation\Rule;

class UniqueISO implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $userId = auth()->id();
        $country = new Country();

        $countries = $country->getAllCountries($userId);

        foreach($countries as $country) {
            if (strtolower($country->iso) === strtolower($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'ISO already exists';
    }
}
