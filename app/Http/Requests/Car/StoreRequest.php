<?php

namespace App\Http\Requests\Car;

use App\Models\Car;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
            'name'             => [
                'required',
                'string',
            ],
            'photo'            => [
                'required',
                'image',
            ],
            'fullphoto'        => [
                'nullable',
            ],
            'address'          => [
                'required',
                'string',
            ],
            'address2'         => [
                'required',
                'string',
            ],
            'description'      => [
                'nullable',
            ],
            'type'             => [
                'required',
            ],
            'slot'             => [
                'required',
                'numeric',
            ],
            'transmission'     => [
                'required',
                'boolean',
            ],
            'fuel'             => [
                'required',
                'boolean',
            ],
            'fuel_comsumpiton' => [
                'required',
                'numeric',
            ],
            'price_1_day'      => [
                'required',
                'numeric',
                'min:1',
            ],
            'price_insure'     => [
                'required',
                'numeric',
                'min:1',
            ],
            'price_service'    => [
                'required',
                'numeric',
                'min:1',
            ],
            'slug'             => [
                'required',
                'string',
                'filled',
                'min:3',
                'max:255',
                Rule::unique(Car::class),
            ],
        ];
    }
}
