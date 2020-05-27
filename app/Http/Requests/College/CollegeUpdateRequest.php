<?php

namespace App\Http\Requests\College;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CollegeUpdateRequest extends FormRequest
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
            'name' => [
                        'required',
                        'max:100',
                        Rule::unique('colleges', 'name')->ignore( $this->route('college') )
            ],
            'code' => [
                        'required',
                        'max:10',
                        Rule::unique('colleges', 'code')->ignore( $this->route('college') )
            ]
        ];
    }
}
