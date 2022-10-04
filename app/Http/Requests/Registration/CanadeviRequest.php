<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class CanadeviRequest extends FormRequest
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
            'telephone' => ['numeric', 'unique:canadevis', 'required'],
            'email' => ['email', 'unique:canadevis', 'required'],
            'birthdate' => ['date', 'required'],
            'company' => ['string', 'required'],
            'position' => ['string', 'required'],
            'mode' => ['numeric', 'required']
        ];
    }
}
