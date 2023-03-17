<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'iso' => 'required|string|size:2',
        ];
    }


    /**
     * ISO to uppercase
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'iso' => strtoupper($this->iso),
        ]);
    }
}
