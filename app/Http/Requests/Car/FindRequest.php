<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class FindRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'city' => [
                'required',
                'string',
            ],
            'date_start' => [
                'required',
                'date',
                'after:today',
            ],
            'date_end' => [
                'required',
                'date',
                'after:date_start',
            ],
        ];
    }
}
