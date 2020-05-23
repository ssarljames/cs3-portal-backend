<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class StudentCreateRequest extends FormRequest
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
            'id_number' => 'required|max:50|unique:students,id_number', 
            'firstname' => 'required|max:100',
            'lastname' => 'required|max:100',
            'middlename' => 'nullable|max:100',
            'program_id' => 'required|exists:programs,id',
            'year_level' => 'required|numeric|min:1|max:6',
            'current_address' => 'nullable',
            'home_address' => 'nullable'
        ];
    }
    
    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'program_id.required' => 'Program enrolled in is required',
            'program_id.exists' => 'Program not exist',
            'year_level.min' => 'Year level is required'
        ];
    }
}
