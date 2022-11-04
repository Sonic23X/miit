<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class AmpiRequest extends FormRequest
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
            'telephone' => ['numeric', 'unique:canadevis', 'required', 'min:10'],
            'email' => ['email', 'unique:ampis', 'required'],
            'real_estate' => ['string', 'required'],
            'partner' => ['numeric', 'required'],
            'region' => ['string', 'nullable'],
            'coupon' => ['string', 'nullable']
        ];
    }
}
