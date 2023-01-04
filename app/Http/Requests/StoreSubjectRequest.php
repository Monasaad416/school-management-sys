<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubjectRequest extends FormRequest
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
            'name_ar' => 'required|string',
            'name_en' => 'required|string',
            'grade_id' =>'required|string|exists:grades,id',
            'level_id' => 'required|exists:levels,id',
            'teacher_id' => 'required|exists:teachers,id',
        ];
    }


    public function messages()
    {
        return [
            'name_ar.required' => trans('validation.required'),
            'name_en.required' => trans('validation.required'),
            'grade_id.required' => trans('validation.required'),
            'level_id.required' => trans('validation.required'),
            'teacher_id.required' => trans('validation.required'),
            'grade_id.exists' => trans('validation.required'),
            'level_id.exists' => trans('validation.required'),
            'techer_id.exists' => trans('validation.required'),
        ];
    }
}
