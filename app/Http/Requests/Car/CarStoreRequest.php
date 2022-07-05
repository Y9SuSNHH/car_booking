<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class CarStoreRequest extends FormRequest
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
            'name' => 'required',
            'image' => 'nullable',
            'address' =>'required',
            'description' => 'required',
            'type' => 'required',
            'slot' => ['required','numeric'],
            'transmission' => ['required', 'boolean'],
            'fuel' => ['required','boolean'],
            'fuel_comsumpiton' => ['required','numeric'],
            'price_1_day' => ['required','numeric'],
            'price_insure' => ['required','numeric'],
            'price_service' => ['required','numeric'],
            'status' => ['required', 'boolean'],
            'slug' => 'nullable',
        ];
    }
}
