<?php

namespace App\Http\Requests\Car;

use App\Enums\CarStatusEnum;
use App\Enums\CarTypeEnum;
use App\Models\Car;
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
            'name'             => [
                'required',
                'string',
            ],
            'image'            => [
                'nullable',
                'image',
            ],
            'fullphoto'        => [
                'nullable',
            ],
            'city'             => [
                'required',
                'string',
            ],
            'district'         => [
                'required',
                'string',
            ],
            'description'      => [
                'nullable',
            ],
            'type'             => [
                'required',
                'numeric',
                Rule::in(CarTypeEnum::getValues()),
            ],
            'slot'             => [
                'required',
                'numeric',
                Rule::in([4, 5, 7]),
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
            'status'           => [
                'required',
                'numeric',
                Rule::in(CarStatusEnum::getValues()),
            ],
            'slug'             => [
                'required',
                'string',
                'filled',
                'min:3',
                'max:255',
            ],
        ];
    }
}
