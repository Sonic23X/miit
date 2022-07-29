<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            'telephone' => ['numeric', 'required'],
            'email' => ['email', 'required'],
            'birthdate' => ['date', 'required'],
            'credit1' => ['string', 'required'],
            'other_credit1' => ['string', 'nullable'],
            'civil_status' => ['string', 'required'],
            'have_children' => ['numeric', 'required'],
            'spouse_status' => ['string', 'nullable'],
            'spouse_credit' => ['string', 'nullable'],
            'credit2' => ['string', 'nullable']
        ];
    }
}
