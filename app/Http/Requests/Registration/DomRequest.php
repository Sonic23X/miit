<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class DomRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['string', 'required'],
            'first_surname' => ['string', 'required'],
            'second_surname' => ['string', 'required'],
            'telephone' => ['numeric', 'unique:doms', 'required', 'min:10'],
            'email' => ['email', 'unique:doms', 'required'],
            'type_visit' => ['string', 'required'],
            'bank' => ['string', 'nullable'],
            'other' => ['string', 'nullable']
        ];
    }
}
