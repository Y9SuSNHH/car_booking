<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\RequiredIf;

class SignUpRequest extends FormRequest
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
            'name'     => [
                'required',
                'string',
            ],
            'gender'   => [
                'required',
                'boolean',
            ],
            'phone'    => [
                'required',
                'numeric',
                'min:8',
            ],
            'email'    => [
                new RequiredIf(!auth()->check()),
                'email',
            ],
            'password' => [
                'required',
                'password',
            ],
        ];
    }
}
