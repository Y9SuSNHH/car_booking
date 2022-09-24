<?php

namespace App\Http\Requests\User;

use App\Enums\FileTypeEnum;
use App\Enums\UserRoleEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        $rule = [];
        if (auth()->user()->role === UserRoleEnum::ADMIN) {
            $rule = [
                'name'    => [
                    'required',
                    'string',
                ],
                'gender'  => [
                    'required',
                    'boolean',
                ],
                'phone'   => [
                    'required',
                    Rule::unique(User::class, 'phone'),
                    'numeric',
                    'min:8',
                ],
                'files'   => [
                    'required',
                    'array',
                ],
                'files.IDENTITY_FRONT' => [
                    'required',
                    'image',
                ],
                'files.IDENTITY_BACK' => [
                    'required',
                    'image',
                ],
                'files.LICENSE_CAR_FRONT' => [
                    'required',
                    'image',
                ],
                'files.LICENSE_CAR_BACK' => [
                    'required',
                    'image',
                ],
            ];
        }
        return $rule;
    }
}
