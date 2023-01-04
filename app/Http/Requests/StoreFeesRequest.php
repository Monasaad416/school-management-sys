<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFeesRequest extends FormRequest
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
            'title_en' => 'required|string',
            'title_ar' =>  'required|string',
            'amount' =>  'required|numeric',
            'grade_id' =>  'required|exists:grades,id',
            'level_id' =>  'required|exists:levels,id',
            'desciption' =>  'nullable|text',
            'fees_type' =>  'required',
            'academic_year' =>  'required',
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => trans('validation.required'),
            'title_ar.required' => trans('validation.required'),
            'amount.numeric' => trans('validation.numeric'),
            'grade_id.required' => trans('validation.required'),
            'level_id.required' => trans('validation.required'),
            'level_id.unique' => trans('validation.unique'),
            'academic_year.required' => trans('validation.unique'),
        ];
    }
}
