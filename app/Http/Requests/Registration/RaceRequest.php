<?php

namespace App\Http\Requests\Registration;

use Illuminate\Foundation\Http\FormRequest;

class RaceRequest extends FormRequest
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
            'telephone' => ['numeric', 'unique:races', 'required'],
            'email' => ['email', 'unique:races', 'required'],
            'birthdate' => ['date', 'required'],
            'gender' => ['numeric', 'required'],
            'size' => ['string', 'required'],
            'state' => ['numeric', 'required'],
            'city' => ['numeric', 'required'],
            'event' => ['numeric', 'required']
        ];
    }
}
