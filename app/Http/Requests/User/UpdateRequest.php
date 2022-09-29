<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name'           => [
                'required',
                'string',
            ],
            'gender'         => [
                'required',
                'boolean',
            ],
            'phone'          => [
                'required',
                'numeric',
                'min:8',
                Rule::unique(User::class,'phone')->ignore($this->phone,'phone'),
            ],
            'files'          => [
                'array',
            ],
            'files.*'        => [
                'image',
            ],
        ];
    }
}
