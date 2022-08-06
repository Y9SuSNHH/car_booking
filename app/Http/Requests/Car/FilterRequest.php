<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class FilterRequest extends FormRequest
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
            'address' => [
                'required',
                'string',
            ],
            'address2' => [
                'required',
                'string',
            ],
            'date_start' => [
                'required',
                'date',
                'after:yesterday',
            ],
            'date_end' => [
                'required',
                'date',
                'after:date_start',
            ],
        ];
    }
}
