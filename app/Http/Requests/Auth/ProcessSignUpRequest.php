<?php

namespace App\Http\Requests\Auth;

use App\Enums\UserRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProcessSignUpRequest extends FormRequest
{
    /**
     * Determine if the users is authorized to make this request.
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
            'name'=>[
                'bail',
                'required',
                'string',
                'min:0',
                'max:255',
            ],
            'gender'=>[
                'bail',
                'required|in:0,1',
            ],
            'phone'=>[
                'bail',
                'required',
                'numeric',
                'min:11',
            ],
            'address'=>[
                'bail',
                'required',
                'string',
                'min:0',
                'max:255',
            ],
            'password'=>[
                'bail',
                'required',
                'string',
                'min:0',
                'max:255',
            ],
            'username'=>[
                'bail',
                'required',
                'string',
                'min:0',
                'max:255',
                'unique:App\Models\User,username',
            ],
            'role'=>[
                'required',
                Rule::in([
                    UserRoleEnum::CUSTOMER,
                ])
            ]
        ];
    }
}
